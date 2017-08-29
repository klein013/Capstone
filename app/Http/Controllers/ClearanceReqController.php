<?php

namespace App\Http\Controllers;

use DB;
use App\Models\TblRequest;
use App\Models\TblTran;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;
use PDF;

class ClearanceReqController extends Controller
{
 
    public function create(){

        $clearance = DB::select('select lpad(c.clearance_id,4,"0") as clearance_id, c.clearance_type, p.price_id, p.price_amt from tbl_clearance c join tbl_price p on p.price_id = c.clearance_price where c.clearance_exists = 1 order by 2 asc');

        // $requirements = DB::select('')

        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];
        return view('admin.clearance')->with(array('clearances'=>$clearance, 'return'=>$return));
    }

    public function getResidents($id){

        $residents = DB::select('select r.resident_id as resident_id, concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, r.resident_bdate, concat(r.resident_hno," ",s.street_name," ",a.area_name) as address, coalesce(r.resident_contact,"") as contact from tbl_resident r join tbl_street s on r.resident_street = s.street_id join tbl_area a on a.area_id = s.street_area where r.resident_exists = 1 and r.resident_id != "'.$id.'"' );

        return response()->json($residents);
    }

    public function getClearances(){

        $rows = DB::select('select lpad(t.trans_id,8,"0") as trans_id, re.request_id, concat(r.resident_fname," ",COALESCE(r.resident_mname, "")," ",r.resident_lname) as name, c.clearance_type, t.trans_date, re.request_status from tbl_resident r join tbl_trans t on t.trans_resident = r.resident_id join tbl_request re on re.request_transaction = t.trans_id join tbl_clearance c on c.clearance_id = re.request_clearance where re.request_status = "Unpaid" order by trans_id');

        return response()->json($rows);
    }

    public function storeClearance(Request $request){

        $check = DB::select('select r.resident_id from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on c.case_id = p.personinvolve_case where p.personinvolve_type="R" and c.case_status != "Settled" and r.resident_id = "'.$request->resid.'"');
        if(empty($check[0]->resident_id)){
        $trans = new TblTran;

        $trans->trans_resident = $request->resid;
        $trans->save();

        // return response()->json($request->clearance);
        // foreach($request[0]->clearance as $clearances){
            for ($x = 0; $x < count($request->clearance[0]["clearance"]); $x++) {
                
                $clearances = $request->clearance[0];
                // return response()->json($clearances["clearance"][$x]);
                $req = new TblRequest;

                $req->request_resident = $request->resid;
                $req->request_clearance = $clearances["clearance"][$x];
                $req->request_purpose = $clearances["purpose"][$x];
                $req->request_expiry = date('Y-m-d', strtotime('+1 years'));
                $req->request_status = "Unpaid";
                $req->request_transaction = $trans->trans_id;
                $req->save();
                
            } 
            return response("success");
        }
        else{
            return response("The Person has an on-going case, Please settle the case before requesting for clearance");
        }        

    }
}
