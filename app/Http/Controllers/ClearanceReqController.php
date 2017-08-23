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

                $head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

                $body = DB::select('select clearance_content from tbl_clearance where clearance_id = '.$clearances["clearance"][$x]);

                $tocheck = array("@name", "@date", "@address", '@brgyaddress', '@purpose', '@residency');

                $details = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,""),r.resident_lname) as name, concat(r.resident_hno," ",s.street_name," ",a.area_name) as address, r.resident_yearstayed from tbl_resident r join tbl_street s on r.resident_street = s.street_id join tbl_area a on s.street_area = a.area_id where r.resident_id = "'.$request->resid.'"');


                foreach($tocheck as $check){
                    if($check=="@name"){
                        $body[0]->clearance_content = str_replace($check, $details[0]->name, $body[0]->clearance_content);
                    }   
                    else if($check=="@date"){
                        $body[0]->clearance_content = str_replace($check, date('jS \of F Y'), $body[0]->clearance_content);
                    }
                    else if($check=="@address"){
                        $body[0]->clearance_content = str_replace($check, $details[0]->address, $body[0]->clearance_content);
                    }
                    else if($check=="@brgyaddress"){
                        $body[0]->clearance_content = str_replace($check, $head[0]->brgyinfo_name." ".$head[0]->brgyinfo_city.", ".$head[0]->brgyinfo_region  , $body[0]->clearance_content);
                    }
                    else if($check=="@purpose"){
                        $body[0]->clearance_content = str_replace($check, $clearances["purpose"][$x], $body[0]->clearance_content);
                    }
                    else if($check=="@residency"){
                        $body[0]->clearance_content = str_replace($check, $details[0]->resident_yearstayed, $body[0]->clearance_content);
                    }
                }

                $foot = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, p.position_name from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_position p on p.position_id = o.position_id where p.position_id = 1');

                $html = '<html>
                    <head>
                        <style>
                        @font-face {
                            font-family: "RobotoRegular";
                            src: url("{{public_path()}}/Roboto/Roboto-Regular.ttf")  format("truetype")
                        }
                        body{
                            font-family: "RobotoRegular", sans-serif;
                            font-size: 12pt;
                        }
                        @page { margin: 0in 0in 0in 0in;} 
                        </style>
                    </head>
                    <body>
                        <div style="margin: 50px 50px 0px 50px;">
                        <span><img src="'.$head[0]->brgyinfo_logo.'" style="width:130px; height: 130px; float:left;">
                        <img src="'.$head[0]->brgyinfo_citylogo.'" style="width:130px; height: 130px; margin-left: 566px; float:right;">
                        <center><p><strong>'.$head[0]->brgyinfo_name.'</strong><br>'.$head[0]->brgyinfo_city.', '.$head[0]->brgyinfo_region.'<br>
                        Email: '.$head[0]->brgyinfo_email.'<br>Website: '.$head[0]->brgyinfo_website.'<br>Facebook: '.$head[0]->brgyinfo_fb.'</p></center>
                        </span>
                        </div>
                        <div style="margin: 50px 50px 0px 50px;">'.$body[0]->clearance_content.'</div>
                        <div style="margin: 100px 50px 50px 50px;">
                            <div style="width:250px; float:left;">
                                <p style="width: 250px;"><hr style="color:solid black 1px;"></p>
                                <br><p style="width: 250px;"><center>'.$details[0]->name.'<br><strong>Applicant</strong></center></p>
                            </div>
                            <div style="width:250px; float:right; margin-left:196px;">
                            <p style="width: 250px;"><hr style="color:solid black 1px;"></p>
                            <br><p style="width: 250px;"><center>'.$foot[0]->name.'<br><strong>'.$foot[0]->position_name.'</strong></center></p>
                            </div>
                        </div>
                    </body>
                </html>';
                $pdf = PDF::loadHTML($html)->setPaper('letter', 'portrait')->save("clearances/".$clearances["clearance"][$x]."".str_replace(" ","",$details[0]->name)."".date('Ymd').".pdf");
                $req->request_doc = "clearances/".$clearances["clearance"][$x]."".str_replace(" ","",$details[0]->name)."".date('Ymd').".pdf";
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
