<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Response;
use PDF;

class ReleaseController extends Controller
{
    
	public function create(){

		$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];
        return view('admin.release')->with(array('return'=>$return));
	}

	public function getTrans(){

		$rows = DB::select('select lpad(t.trans_id,8,"0") as trans_id, re.request_id, concat(r.resident_fname," ",COALESCE(r.resident_mname, "")," ",r.resident_lname) as name, c.clearance_type,t.trans_date, re.request_status from tbl_resident r join tbl_trans t on t.trans_resident = r.resident_id join tbl_request re on re.request_transaction = t.trans_id join tbl_clearance c on c.clearance_id = re.request_clearance where re.request_status = "For Release" order by trans_id');

		return response()->json($rows);
	}

	public function dl($id){

		$file = public_path().'/clearances/'.$id;
		return Response::make(file_get_contents($file), 200, [
    		'Content-Type' => 'application/pdf',
		    'Content-Disposition' => 'inline; filename="'.$id.'"'
		]);
	}

	public function createdoc($id){

		$request = DB::select('select request_resident, request_clearance, request_purpose from tbl_request where request_id = '.$id);

		$head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

        $body = DB::select('select clearance_type,clearance_content from tbl_clearance where clearance_id = '.$request[0]->request_clearance);

        $tocheck = array("@name", "@date", "@address", '@brgyaddress', '@purpose', '@residency');

        $details = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,""),r.resident_lname) as name, concat(r.resident_hno," ",s.street_name," ",a.area_name) as address, r.resident_yearstayed from tbl_resident r join tbl_street s on r.resident_street = s.street_id join tbl_area a on s.street_area = a.area_id where r.resident_id = "'.$request[0]->request_resident.'"');


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
                $body[0]->clearance_content = str_replace($check, $request[0]->request_purpose, $body[0]->clearance_content);
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
                            font-size: 14pt;
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
                        <div style="margin: 150px 50px 50px 50px;">
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
                $pdf = PDF::loadHTML($html)->setPaper('letter', 'portrait');
                return $pdf->stream();
               
	}
}
