<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\TblHearing;
use App\Models\TblHearingattendance;
use App\Models\TblMinute;
use PDF;
use App\Models\TblSettlement;

class SettlementController extends Controller
{
    public function create($id){

    	$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];


    	$case = DB::select('select lpad(ca.case_id,8,"0") as case_id , h.hearing_id, concat(lpad(o.official_id,8,"0")," - ",r.resident_fname," ",r.resident_lname) as official, kp.caseskp_name, ca.case_filed, concat(cs.casestage_name," - ",cs.casestage_no) as hearing_type, h.hearing_sched from tbl_case ca join tbl_caseallocation cl on ca.case_id = cl.caseallocation_case join tbl_official o on o.official_id = cl.caseallocation_official join tbl_resident r on o.resident_id = r.resident_id join tbl_hearing h on h.hearing_case = cl.caseallocation_case join tbl_caseskp kp on kp.caseskp_id = ca.case_caseskp join tbl_casestage cs on cs.casestage_id = h.hearing_type where h.hearing_id = '.$id);

    	 $cresidents = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, r.resident_id, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "C"');

    	 $rresidents = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, r.resident_id, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "R"');

    	 $wresidents = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, r.resident_id, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "W" union select "","",""');

    	 return view('admin.settlement')->with(array('return'=>$return,'case'=>$case,'cresident'=>$cresidents, 'rresident'=>$rresidents, 'wresident'=>$wresidents));

    }

    public function store(Request $request){

    	$settled = new TblSettlement;

    	$settled->settlement_hearing = $request->id;
    	$settled->settlement_details = $request->minutes;
    	$settled->settlement_datetime = date('Y-m-d H:i:s');
    	$settled->save();

    	DB::table('tbl_case')->where('case_id',$request->case)->update(['case_status'=>'Settled']);

    	DB::table('tbl_hearing')->where([['hearing_case','=',$request->case],['hearing_exists','=',1], ['hearing_sched','>=',date('Y-m-d H:i:s')]])->update(['hearing_status'=>'Voided']);

    	return response("success");

    }

    public function printsettle($id){

       $head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

        $foot = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, p.position_name from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_position p on p.position_id = o.position_id where p.position_id = 1');

        $settlement = DB::select('select s.settlement_details, s.settlement_datetime from tbl_settlement s join tbl_hearing h on h.hearing_id = s.settlement_hearing where h.hearing_case ='.$id );

        $involvenames = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id where p.personinvolve_case = '.$id);

        $case = DB::select('select k.caseskp_name from tbl_caseskp k join tbl_case c on c.case_caseskp = k.caseskp_id where c.case_id = '.$id);

        $comp = "";
        $res = "";
        $wit = "";

        foreach($involvenames as $names){
          if($names->personinvolve_type=='C'){
            $comp .= $names->name.'<br>';
          }
          else if($names->personinvolve_type=='R'){
            $res .= $names->name.'<br>';
          }
          else{
            $wit .= $names->name.'<br>'; 
          }
        }

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
                        <div style="margin: 10px 50px 0px 50px;"><center><p><strong>AMMICABLE SETTLEMENT</strong></p><p><strong>Case : '.$case[0]->caseskp_name.'</p></strong></center></div>
                        <div style="margin: 10px 50px 0px 50px;"><p>To Complaint/s: '.$comp.'<br>Respondent/s : '.$res.'</p></div>
                        <div style="margin: 20px 50px 0px 70px;">
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;We, Complainant/s and Respondent/s in the above-mentioned case, do hereby agree to settle our dispute as follows: </p>
                            <center><p>'.$settlement[0]->settlement_details.'</p></center>
                            <p>&nbsp;&nbsp;and bind ourselves to comply honestly and faithfully with the above terms of settlement</p>
                            <p>&nbsp;&nbsp;Entered this '.$settlement[0]->settlement_datetime.'</p>
                            <center><p>ATTESTATION</p></center>
                            <p>I hereby certify that the foregoing ammicable statement was entered into by the parties freely and voluntarily, after I had explained to them the nature and consequence of such settlement.</p>
                        </div>
                        <div style="margin: 80px 50px 50px 50px;">
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
