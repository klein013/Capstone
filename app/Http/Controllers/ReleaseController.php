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

		$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

        $check = DB::select('select official_id from tbl_official where position_id = 1 and official_exists =1');


        return view('admin.release')->with(array('return'=>$return, 'check'=>$check));
	}

	public function getTrans(){

		$rows = DB::select('select lpad(t.trans_id,8,"0") as trans_id, re.request_id, concat(r.resident_fname," ",COALESCE(r.resident_mname, "")," ",r.resident_lname) as name, c.clearance_name as clearance_type,t.trans_date, re.request_status from tbl_resident r join tbl_trans t on t.trans_resident = r.resident_id join tbl_request re on re.request_transaction = t.trans_id join tbl_clearancevalidity v on v.validity_id = re.request_validity join tbl_clearance c on c.clearance_id = v.clearance_id where re.request_status = "For Release" or re.request_status = "Released" order by trans_id');

		return response()->json($rows);
	}

    public function getTransForRelease(){

        $rows = DB::select('select lpad(t.trans_id,8,"0") as trans_id, re.request_id, concat(r.resident_fname," ",COALESCE(r.resident_mname, "")," ",r.resident_lname) as name, c.clearance_name as clearance_type,t.trans_date, re.request_status from tbl_resident r join tbl_trans t on t.trans_resident = r.resident_id join tbl_request re on re.request_transaction = t.trans_id join tbl_clearancevalidity v on v.validity_id = re.request_validity join tbl_clearance c on c.clearance_id = v.clearance_id where re.request_status = "For Release" order by trans_id');

        return response()->json($rows);
    }

    public function getTransRelease(){

        $rows = DB::select('select lpad(t.trans_id,8,"0") as trans_id, re.request_id, concat(r.resident_fname," ",COALESCE(r.resident_mname, "")," ",r.resident_lname) as name, c.clearance_name as clearance_type,t.trans_date, re.request_status from tbl_resident r join tbl_trans t on t.trans_resident = r.resident_id join tbl_request re on re.request_transaction = t.trans_id join tbl_clearancevalidity v on v.validity_id = re.request_validity join tbl_clearance c on c.clearance_id = v.clearance_id where re.request_status = "Released" order by trans_id');

        return response()->json($rows);
    }

	public function dl($id){

		$file = public_path().'/clearances/'.$id;
		return Response::make(file_get_contents($file), 200, [
    		'Content-Type' => 'application/pdf',
		    'Content-Disposition' => 'inline; filename="'.$id.'"'
		]);
	}

    public function checkdeficiency($id){

        $deficient = DB::select('select r.requirement_name, r.requirement_id from tbl_requirement r join tbl_submittedrequirements s on s.sr_cr = r.requirement_id where s.sr_request = '.$id.' and s.sr_stat = 0');

        if(!empty($deficient[0]->requirement_name)){
            return response()->json($deficient);
        }
        else{
            return response(null);
        }
    }

    public function deficiency(Request $request){

        foreach($request->sr as $sr){

            $word = explode('|', $sr);

            DB::table('tbl_submittedrequirements')->where([['sr_request','=',$word[0]],['sr_cr','=',$word[1]]])->update(['sr_stat'=>$word[2]]);

        }

        $deficient = DB::select('select r.requirement_name, r.requirement_id from tbl_requirement r join tbl_submittedrequirements s on s.sr_cr = r.requirement_id where s.sr_request = '.$request->id.' and s.sr_stat = 0');

        if(!empty($deficient[0]->requirement_name)){
            return response("failed");
        }
        else{
            return response("success");
        }

    }

	public function createdoc($id){

        $exists = DB::select('select request_issuedate from tbl_request where request_id = '.$id);

        if(empty($exists[0]->request_issuedate)){

            $wala = DB::select('select o.official_id from tbl_official o join tbl_request r on r.request_captain = o. official_id where o.official_exists = 0 and r.request_id = '.$id);

            if(empty($wala[0]->official_id)){

                $newcap = DB::select('select official_id from tbl_official where position_id = 1 and official_exists=1');

                DB::table('tbl_request')->where('request_id',$id)->update(['request_captain'=>$newcap[0]->official_id]);
            }


            DB::table('tbl_request')->where('request_id',$id)->update(['request_issuedate'=>date('Y-m-d H:i:s'), 'request_status'=>'Released']);


        }


		$request = DB::select('select re.request_resident,re.request_captain, v.clearance_id, v.validity_no, v.validity_unit, re.request_purpose, DATE(re.request_issuedate) as request_issuedate from tbl_request re join tbl_clearancevalidity v on v.validity_id = re.request_validity where re.request_id = '.$id);

		$head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

        $body = DB::select('select c.clearance_name,cc.content as clearance_content from tbl_clearance c join tbl_clearancecontent cc on c.clearance_id = cc.clearance_id join tbl_request r on r.request_content = cc.content_id where r.request_id = '.$id.' and c.clearance_id = '.$request[0]->clearance_id);

        $tocheck = array("@name", "@date", "@address", '@brgyaddress', '@brgyname', '@purpose', '@residency', '@validity', '@bdate');

        $details = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,""),r.resident_lname) as name, r.resident_bdate, concat(r.resident_hno," ",s.street_name," ",a.area_name) as address, r.resident_yearstayed from tbl_resident r join tbl_street s on r.resident_street = s.street_id join tbl_area a on s.street_area = a.area_id where r.resident_id = "'.$request[0]->request_resident.'"');

        $stringtoadd = "";

        if($request[0]->validity_no!=1){
            $request[0]->validity_unit .= 's';
        }

        $stringtoadd = "+".$request[0]->validity_no." ".$request[0]->validity_unit;

        foreach($tocheck as $check){
            if($check=="@name"){
                $body[0]->clearance_content = str_replace($check, $details[0]->name, $body[0]->clearance_content);
            }   
            else if($check=="@date"){
                $body[0]->clearance_content = str_replace($check, date('jS \of F Y', strtotime($request[0]->request_issuedate)), $body[0]->clearance_content);
            }
            else if($check=='@bdate'){
                $body[0]->clearance_content = str_replace($check, $details[0]->resident_bdate, $body[0]->clearance_content);
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
            else if($check=='@brgyname'){
               $body[0]->clearance_content = str_replace($check, $head[0]->brgyinfo_name,  $body[0]->clearance_content);
            }
            else if ($check=="@validity"){
                $body[0]->clearance_content = str_replace($check, date('F d, Y', strtotime($stringtoadd, strtotime($request[0]->request_issuedate))), $body[0]->clearance_content);
            }
        }


                $foot = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, "Barangay Captain" as position_name from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_request re on re.request_captain=o.official_id where o.official_id ='.$request[0]->request_captain);

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
                            <br><br>
                            <p style="font-size: 11px;">This document is valid until '.date('F d, Y', strtotime($stringtoadd, strtotime($request[0]->request_issuedate))).'</p>
                            </div>
                            
                        </div>
                    </body>
                </html>';
                $pdf = PDF::loadHTML($html)->setPaper('letter', 'portrait');
                return $pdf->download(str_replace(' ','',$details[0]->name)."".str_replace(' ','',$body[0]->clearance_name)."".".pdf");
               
	}
}
