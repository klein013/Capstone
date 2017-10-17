<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\TblCaseallocation;
use App\Models\TblHearing;
use App\Models\TblHearingletter;
use PDF;
use Carbon;

class PrintController extends Controller
{
 
    public function summon($id){

       $requestresident = explode('_', $id);
       $head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

        $hearing = DB::select('select hearing_case, hearing_sched from tbl_hearing where hearing_id = '.$requestresident[1]);

        $foot = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, p.position_name from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_position p on p.position_id = o.position_id where p.position_id = 1');

        $res = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name from tbl_resident r where r.resident_id = "'.$requestresident[0].'"');

        DB::table('tbl_hearingletter')->where([['hl_hearing','=',$requestresident[1]], ['hl_personinvolve','=',$requestresident[0]], ['hl_lettertype','=','Summon']])->update(['hl_printdate'=>date('Y-m-d H:i:s'), 'hl_datereceive'=>null]);

        $return = "";
        foreach($res as $resident){
            $return .= $resident->name.";<br>";
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
                        <div style="margin: 20px 50px 0px 50px;"><center><p><strong>SUMMON</strong><br>Mediation Proceedings</p></center></div>
                        <div style="margin: 20px 50px 0px 50px;"><p>To: '.$return.'</p></div>
                        <div style="margin: 20px 50px 0px 70px;">
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;You are hereby summoned to appear before me in person, together with your witnesses on '.$hearing[0]->hearing_sched.' ,then and there to answer to a complaint made before me, copy of which is attached hereto, for mediation of your dispute with complainant/s.<br><br>&nbsp;&nbsp;&nbsp;&nbsp;You are hereby warned that if you refuse or wilfully fail to appear in obidience to this summons, you may be barred from filing any counterclaim arising from said complaint.<br><br>&nbsp;&nbsp;&nbsp;&nbsp;FAIL NOT or else face punishment as for contempt of court.<br><br>&nbsp;&nbsp;&nbsp;&nbsp;Issued this '.date('jS \of F Y').'</p>
                        </div>
                        <div style="margin: 150px 50px 50px 50px;">
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

    public function noticemed($id){
        
        $request = explode('_', $id);
        $head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

        $hearing = DB::select('select hearing_case, hearing_sched from tbl_hearing where hearing_id = '.$request[1]);

        $foot = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, p.position_name from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_position p on p.position_id = o.position_id where p.position_id = 1');

        $res = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name from tbl_resident r where r.resident_id = "'.$request[0].'"');

        $return = "";
        foreach($res as $resident){
            $return .= $resident->name.";<br>";
        }

         DB::table('tbl_hearingletter')->where([['hl_hearing','=',$request[1]], ['hl_personinvolve','=',$request[0]], ['hl_lettertype','=','Notice of Hearing - Mediation Proceedings']])->update(['hl_printdate'=>date('Y-m-d H:i:s'), 'hl_datereceive'=>null]);

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
                        <div style="margin: 20px 50px 0px 50px;"><center><p><strong>NOTICE OF HEARING</strong><br>Mediation Proceedings</p></center></div>
                        <div style="margin: 20px 50px 0px 50px;"><p>To: '.$return.'</p></div>
                        <div style="margin: 20px 50px 0px 70px;">
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;You are hereby required to appear before me on '.$hearing[0]->hearing_sched.' for the mediation proceedings of your case.<br><br>&nbsp;&nbsp;&nbsp;&nbsp; Issued this '.date('jS \of F Y').'</p>
                        </div>
                        <div style="margin: 150px 50px 50px 50px;">
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

    public function printmwit($id){
        
        $head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

        $hearing = DB::select('select hearing_case, hearing_sched from tbl_hearing where hearing_id = '.$id);

        $foot = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, p.position_name from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_position p on p.position_id = o.position_id where p.position_id = 1');

        $res = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id where p.personinvolve_type = "W" and p.personinvolve_case = '.$hearing[0]->hearing_case);

        $return = "";
        foreach($res as $resident){
            $return .= $resident->name.";<br>";
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
                        <div style="margin: 20px 50px 0px 50px;"><center><p><strong>SUBPOENA</strong><br>Mediation Proceedings</p></center></div>
                        <div style="margin: 20px 50px 0px 50px;"><p>To: '.$return.'</p></div>
                        <div style="margin: 20px 50px 0px 70px;">
                            <p>&nbsp;&nbsp;You are hereby required to appear before me on '.$hearing[0]->hearing_sched.' for the mediation proceedings of your case.<br>&nbsp; Issued this '.date('jS \of F Y').'</p>
                        </div>
                        <div style="margin: 150px 50px 50px 50px;">
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

     public function printcres($id){

       $head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

        $hearing = DB::select('select hearing_case, hearing_sched from tbl_hearing where hearing_id = '.$id);

        $foot = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, p.position_name from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_position p on p.position_id = o.position_id where p.position_id = 1');

        $res = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id where p.personinvolve_type = "R" and p.personinvolve_case = '.$hearing[0]->hearing_case);

        $return = "";
        foreach($res as $resident){
            $return .= $resident->name.";<br>";
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
                        <div style="margin: 20px 50px 0px 50px;"><center><p><strong>SUMMON</strong><br>Concillation Proceedings</p></center></div>
                        <div style="margin: 20px 50px 0px 50px;"><p>To: '.$return.'</p></div>
                        <div style="margin: 20px 50px 0px 70px;">
                            <p>&nbsp;&nbsp;You are hereby required to appear before me on '.$hearing[0]->hearing_sched.' for the mediation proceedings of your case.<br>&nbsp; Issued this '.date('jS \of F Y').'</p>
                        </div>
                        <div style="margin: 150px 50px 50px 50px;">
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

    public function printccom($id){
        
        $head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

        $hearing = DB::select('select hearing_case, hearing_sched from tbl_hearing where hearing_id = '.$id);

        $foot = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, p.position_name from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_position p on p.position_id = o.position_id where p.position_id = 1');

        $res = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id where p.personinvolve_type = "C" and p.personinvolve_case = '.$hearing[0]->hearing_case);

        $return = "";
        foreach($res as $resident){
            $return .= $resident->name.";<br>";
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
                        <div style="margin: 20px 50px 0px 50px;"><center><p><strong>NOTICE OF HEARING</strong><br>Concillation Proceedings</p></center></div>
                        <div style="margin: 20px 50px 0px 50px;"><p>To: '.$return.'</p></div>
                        <div style="margin: 20px 50px 0px 70px;">
                            <p>&nbsp;&nbsp;You are hereby required to appear before me on '.$hearing[0]->hearing_sched.' for the mediation proceedings of your case.<br>&nbsp; Issued this '.date('jS \of F Y').'</p>
                        </div>
                        <div style="margin: 150px 50px 50px 50px;">
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

    public function printcwit($id){
        
        $head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

        $hearing = DB::select('select hearing_case, hearing_sched from tbl_hearing where hearing_id = '.$id);

        $foot = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, p.position_name from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_position p on p.position_id = o.position_id where p.position_id = 1');

        $res = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id where p.personinvolve_type = "W" and p.personinvolve_case = '.$hearing[0]->hearing_case);

        $return = "";
        foreach($res as $resident){
            $return .= $resident->name.";<br>";
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
                        <div style="margin: 20px 50px 0px 50px;"><center><p><strong>SUBPOENA</strong><br>Concillation Proceedings</p></center></div>
                        <div style="margin: 20px 50px 0px 50px;"><p>To: '.$return.'</p></div>
                        <div style="margin: 20px 50px 0px 70px;">
                            <p>&nbsp;&nbsp;You are hereby required to appear before me on '.$hearing[0]->hearing_sched.' for the mediation proceedings of your case.<br>&nbsp; Issued this '.date('jS \of F Y').'</p>
                        </div>
                        <div style="margin: 150px 50px 50px 50px;">
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
