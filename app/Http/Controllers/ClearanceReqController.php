<?php

namespace App\Http\Controllers;

use DB;
use App\Models\TblRequest;
use App\Models\TblTran;
use App\Models\TblClearancerequirement;
use App\Models\TblClearancevalidity;
use App\Models\TblSubmittedrequirement;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;
use PDF;

class ClearanceReqController extends Controller
{
 
    public function create(){

        $clearance = DB::select('select lpad(c.clearance_id,4,"0") as clearance_id, c.clearance_name as clearance_type, p.price_id, p.price_amt from tbl_clearance c join tbl_price p on p.clearance_id = c.clearance_id where c.clearance_exists = 1 and now() between p.created_at and COALESCE(p.updated_at, now()) order by 2 asc');

        // $requirements = DB::select('')

        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];
        return view('admin.clearance')->with(array('clearances'=>$clearance, 'return'=>$return));
    }

    public function getResidents($id){

        $residents = DB::select('select r.resident_id as resident_id, concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, r.resident_bdate, concat(r.resident_hno," ",s.street_name," ",a.area_name) as address, coalesce(r.resident_contact,"") as contact from tbl_resident r join tbl_street s on r.resident_street = s.street_id join tbl_area a on a.area_id = s.street_area where r.resident_exists = 1 and r.resident_id != "'.$id.'"' );

        return response()->json($residents);
    }

    public function getClearances(){

        $rows = DB::select('select lpad(t.trans_id,8,"0") as trans_id, re.request_id, concat(r.resident_fname," ",COALESCE(r.resident_mname, "")," ",r.resident_lname) as name, group_concat(c.clearance_name SEPARATOR "<br>") as clearance_type, t.trans_date, re.request_status from tbl_resident r join tbl_trans t on t.trans_resident = r.resident_id join tbl_request re on re.request_transaction = t.trans_id join tbl_clearancevalidity v on v.validity_id = re.request_validity join tbl_clearance c on c.clearance_id = v.clearance_id where re.request_status = "Unpaid" group by trans_id order by trans_id');

        return response()->json($rows);
    }

    public function storeClearance(Request $request){

        $check = DB::select('select r.resident_id from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on c.case_id = p.personinvolve_case where p.personinvolve_type="R" and c.case_status != "Settled" and r.resident_id = "'.$request->resid.'"');
        if(empty($check[0]->resident_id)){

            $secondcheck = DB::select('select r.request_id from tbl_request r join tbl_trans t on t.trans_id = r.request_transaction join tbl_price p on p.price_id = r.request_price where DATE(t.trans_date) = curdate() and r.request_resident = "'.$request->resid.'" and p.clearance_id in(select p.clearance_id from tbl_price p join tbl_request re on re.request_price = p.price_id join tbl_trans t on re.request_transaction=t.trans_id where DATE(t.trans_date) = curdate() and re.request_resident = "'.$request->resid.'")');

            if(empty($secondcheck[0]->request_id)){
        $trans = new TblTran;

        $trans->trans_resident = $request->resid;
        $trans->save();


        $captain = DB::select('select o.official_id from tbl_resident r join tbl_official o on o.resident_id = r.resident_id where o.position_id = 1');

            for ($x = 0; $x < count($request->clearance[0]["clearance"]); $x++) {
                
                $clearances = $request->clearance[0];

                $price = DB::select('select p.price_id, p.price_amt from tbl_price p , tbl_trans t where t.trans_id = '.$trans->trans_id.' and t.trans_date between p.created_at and coalesce(p.updated_at,now()) and p.clearance_id = '.$clearances["clearance"][$x] );

                $content = DB::select('select c.content_id from tbl_clearancecontent c , tbl_trans t where t.trans_id = '.$trans->trans_id.' and t.trans_date between c.created_at and coalesce(c.updated_at, now()) and c.clearance_id = '.$clearances["clearance"][$x]);

                $validity = DB::select('select v.validity_id from tbl_clearancevalidity v ,tbl_trans t where v.clearance_id = '.$clearances["clearance"][$x].' and t.trans_id = '.$trans->trans_id.' and t.trans_date between v.created_at and coalesce(v.updated_at,now()) order by v.validity_id asc limit 1') ;
                // return response()->json($clearances["clearance"][$x]);
                $req = new TblRequest;

                $req->request_resident = $request->resid;
                $req->request_validity = $validity[0]->validity_id;
                $req->request_purpose = $clearances["purpose"][$x];
                if($price[0]->price_amt==0){
                    $req->request_status = "For Release";
                }
                else{                    
                    $req->request_status = "Unpaid";
                }
                $req->request_transaction = $trans->trans_id;
                $req->request_price = $price[0]->price_id;
                $req->request_content = $content[0]->content_id;
                $req->request_captain = $captain[0]->official_id;
                $req->save();



                foreach ($request->clearance[0]['submittedreq'] as $srs) {
                    
                    $sr = explode('|', $srs);

                    if($sr[0]==(int)$clearances["clearance"][$x]){
                    
                    $submitted = new TblSubmittedrequirement;

                    $submitted->sr_request = $req->request_id;
                    $submitted->sr_cr = $sr[1];
                    $submitted->sr_stat = $sr[2];

                    $submitted->save();
                }

                }
            } 
            return response("success");
            }
            else{
            return response("There is a duplicate request please try another day");
        }
        }
        else{
            return response("The Person has an on-going case, Please settle the case before requesting for clearance");
        }        

    }

    public function getRequirements($id){

        $reqs=DB::select('select cr.cr_requirement, r.requirement_name from tbl_clearancerequirement cr join tbl_requirement r on r.requirement_id = cr.cr_requirement where cr.cr_clearance = '.$id);
        return response()->json($reqs); 
    }


    public function getClearancesDetails($id){

        $clearances = DB::select('select lpad(r.request_id,4,"0") as request_id, c.clearance_name, lpad(c.clearance_id,4,"0") as clearance_id, p.price_amt, p.price_id from tbl_request r join tbl_clearancevalidity v on v.validity_id = r.request_validity join tbl_clearance c on c.clearance_id = v.clearance_id join tbl_price p on p.clearance_id = c.clearance_id join tbl_trans t on t.trans_id = r.request_transaction where t.trans_date between p.created_at and coalesce(p.updated_at, now()) and r.request_transaction = '.$id);

        return response()->json($clearances);
    }

    public function removeRequest($id){

        
        $trans = DB::select('select t.trans_id from tbl_trans t join tbl_request r on r.request_transaction=t.trans_id');


        DB::delete('DELETE FROM tbl_submittedrequirements where sr_request = '.$id);

        DB::delete('DELETE FROM tbl_request WHERE request_id = '.$id);

        $checkingrequest = DB::select('select * from tbl_request where request_transaction ='.$trans[0]->trans_id);

        if(empty($checkingrequest[0])){
            DB::delete('DELETE FROM tbl_trans where trans_id = '.$trans[0]->trans_id);
            return response("success and empty");
        }
        else{
            return response("success");
        }
    }

    public function removeTransaction($id){

        

        $requests = DB::select('select request_id from tbl_request where request_transaction = '.$id);

        if(!empty($requests)){
            foreach ($requests as $request) {
                DB::delete('DELETE FROM tbl_submittedrequirements where sr_request = '.$request->request_id);
            }
        }
        DB::delete('DELETE FROM tbl_request where request_transaction = '.$id);

        DB::delete('DELETE FROM tbl_trans where trans_id = '.$id);

        return response("success");
    }

    public function getClearanceRequirement($id){

        $reqs = DB::select('select r.requirement_name, r.requirement_id, c.cr_clearance from tbl_requirement r join tbl_clearancerequirement c on c.cr_requirement=r.requirement_id where c.cr_clearance ='.$id);

        return response()->json($reqs);
    }
}

