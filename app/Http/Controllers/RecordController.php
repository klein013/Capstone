<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\TblCaseallocation;
use App\Models\TblHearing;
use PDF;

class RecordController extends Controller
{
    public function create()
    {

     $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];
	    return view('admin.record', compact('return'));
    }

    public function show(){
    	
    	$records = DB::select('select lpad(c.case_id,8,"0") as case_id, concat(r.resident_fname," ",r.resident_lname) as name, p.personinvolve_type, k.caseskp_name, c.case_status from tbl_case c join tbl_personinvolve p on c.case_id = p.personinvolve_case join tbl_resident r on p.personinvolve_resident = r.resident_id join tbl_caseskp k on c.case_caseskp = k.caseskp_id where c.case_exists = 1');

    	return response()->json($records);

    }

    public function getcase(Request $request){

        if($request->stat=="Lupon"){
            $luponid = DB::select('select position_id from tbl_position where position_name = "Lupon"');
            $countcaseallocs = DB::select('select count(ca.caseallocation_case) as number, lpad(ca.caseallocation_official,8,"0") as caseallocation_official, concat(r.resident_fname," ",r.resident_lname) as name from tbl_caseallocation ca join tbl_case c on c.case_id = ca.caseallocation_case join tbl_official o on o.official_id = ca.caseallocation_official join tbl_resident r on r.resident_id = o.resident_id where DATE(c.case_filed) <= DATE_ADD(NOW(), INTERVAL -1 MONTH) group by ca.caseallocation_official order by 1 asc');

            if(empty($countcaseallocs)){

                $case = DB::select('select o.official_id from tbl_official o join tbl_resident r on o.resident_id = r.resident_id join tbl_personinvolve pi on pi.personinvolve_resident = r.resident_id join tbl_case c on c.case_id = pi.personinvolve_case where c.case_id = '.$request->id.' and o.position_id = '.$luponid[0]->position_id);

                $offs = "";
                foreach($case as $off){
                    $offs .= $off->official_id.",";
                }
                $offs= rtrim($offs,',');

                $lupons = DB::select('select lpad(o.official_id,8,"0") as official_id, concat(r.resident_fname," ",r.resident_lname) as name from tbl_official o join tbl_resident r on r.resident_id = o.resident_id where o.position_id = '.$luponid[0]->position_id. ' and o.official_id not in ('.$offs.') and o.official_exists = 1 order by o.official_id');

                $return = [];
                
                foreach($lupons as $lupon){
                    array_push($return, ['count'=> 0, 'id' => $lupon->official_id, 'name' => $lupon->name]);
                }

                return response()->json($return);
            }
            else{

                $newlupons="";
                foreach($countcaseallocs as $count){
                    $newlupons .= $count->caseallocation_official.","; 
                }

                $newlupons = rtrim($newlupons, ',');

                $case = DB::select('select o.official_id from tbl_official o join tbl_resident r on o.resident_id = r.resident_id join tbl_personinvolve pi on pi.personinvolve_resident = r.resident_id join tbl_case c on c.case_id = pi.personinvolve_case where c.case_id = '.$request->id.' and o.position_id = '.$luponid[0]->position_id);

                $offs = "";
                foreach($case as $off){
                    $offs .= $off->official_id.",";
                }
                $offs= rtrim($offs,',');

                $countcaseallocs = DB::select('select count(ca.caseallocation_case) as number, lpad(ca.caseallocation_official,8,"0") as caseallocation_official, concat(r.resident_fname," ",r.resident_lname) as name from tbl_caseallocation ca join tbl_case c on c.case_id = ca.caseallocation_case join tbl_official o on o.official_id = ca.caseallocation_official join tbl_resident r on r.resident_id = o.resident_id where DATE(c.case_filed) <= DATE_ADD(NOW(), INTERVAL -1 MONTH) and ca.caseallocation_official not in ('.$offs.') group by ca.caseallocation_official order by 1 asc');


                $lupons = DB::select('select lpad(o.official_id,8,"0") as official_id, concat(r.resident_fname," ",r.resident_lname) as name from tbl_official o join tbl_resident r on r.resident_id = o.resident_id where o.position_id = '.$luponid[0]->position_id. ' and o.official_exists = 1 and o.official_id not in('.$newlupons.') order by o.official_id');

                $return = [];
                foreach($lupons as $lupon){
                    array_push($return, ['count'=> 0, 'id' => $lupon->official_id, 'name' => $lupon->name]);
                }

                foreach($countcaseallocs as $count){
                    $return[$ctr]->count = $count->number;
                    $return[$ctr]->id = $count->caseallocation_official;
                    $return[$ctr]->name = $count->name;
                    array_push($return, ['count'=> $count->number, 'id' => $count->caseallocation_official, 'name' => $count->name]);
                }

                return response()->json($return);
            }
          }
           else if($request->stat=="Barangay Captain"){

            }
            else{

            }
      

    }

    public function allocate(Request $request){

        DB::table('tbl_case')->where('case_id',$request->id)->update(['case_status'=>'Mediation']);

        $alloc = new TblCaseallocation;

        $alloc->caseallocation_case = $request->id;
        $alloc->caseallocation_official = $request->offid;
        $alloc->save();

         $brgytime = DB::select('select brgyinfo_opening, brgyinfo_closing from tbl_brgyinfo limit 1');

          $open = strtotime($brgytime[0]->brgyinfo_opening);
          $close = strtotime($brgytime[0]->brgyinfo_closing);

          $hearing = DB::select('select h.hearing_sched from tbl_hearing h join tbl_caseallocation c on h.hearing_case = c.caseallocation_case where c.caseallocation_official = '.$request->offid.' and h.hearing_sched = curdate() + interval 3 day');

          $det = [];

          if(empty($hearing->hearing_sched)){

            $newhearing = new TblHearing;

            $heardate = date("Y-m-d", strtotime("+3 days"));
            $heartime = date("H:i", strtotime('+30 minutes', $open));
            $newhearing->hearing_case = $request->id;
            $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $heartime"));
            $newhearing->hearing_type = 1;
            $newhearing->save();

            array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $heartime")), 'case'=>$newhearing->hearing_case]);

          }
          else{

            $heartime = "";
            foreach($hearing as $hear){
              $heardate = $hearing->hearing_sched;
              $heardate->format('Y-m-d');
              $time = $hearing->hearing_sched;
              $time->format('H:i');
            }

            $newtime = date("H:i", strtotime('+240 minutes'), strtotime($time));
            if(strtotime($newtime) <= strtotime('09:30')){
              
              $newhearing = new TblHearing;

              $newhearing->hearing_case = $request->id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 1;
              $newhearing->save();
              array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case]);
            }
            else if(strtotime($newtime) <= $close){
              
              $newhearing = new TblHearing;

              $newhearing->hearing_case = $request->id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 1;
              $newhearing->save();
              array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case]);
            }
            else if(strtotime($newtime) > $close){

              $newhearing = new TblHearing;

              $date = date("Y-m-d", strtotime("+3 days"), strtotime($heardate));
              $heartime = date("H:i", strtotime('+30 minutes', $open));
              $newhearing->hearing_case = $request->id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$date $heartime"));
              $newhearing->hearing_type = 1;
              $newhearing->save();
              array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$date $heartime")), 'case'=>$newhearing->hearing_case]);
            }
            else{

              $newhearing = new TblHearing;

              $newhearing->hearing_case = $request->id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 1;
              $newhearing->save();
              array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case]);
            }
        }
        return response()->json($det);
    }

    public function delete($id){

        DB::table('tbl_case')->where('case_id',$id)->update(['case_exists'=>0]);
        return response("success");
    }

    public function mediation($id){

        $yes = DB::select('select h.hearing_id, h.hearing_sched, concat(cs.casestage_name,"-",cs.casestage_no) as type from tbl_hearing h join tbl_casestage cs on cs.casestage_id = h.hearing_type where cs.casestage_id between 1 and 3 and h.hearing_case = '.$id);
        return response()->json($yes);

    }

    public function concillation($id){

        $yes = DB::select('select h.hearing_id, h.hearing_sched, concat(cs.casestage_name,"-",cs.casestage_no) as type from tbl_hearing h join tbl_casestage cs on cs.casestage_id = h.hearing_type where cs.casestage_id between 4 and 6 and h.hearing_case = '.$id);
        return response()->json($yes);
    }

    public function arbitration($id){

        $yes = DB::select('select h.hearing_id, h.hearing_sched, concat(cs.casestage_name,"-",cs.casestage_no) as type from tbl_hearing h join tbl_casestage cs on cs.casestage_id = h.hearing_type where cs.casestage_id = 7 and h.hearing_case = '.$id);
        return response()->json($yes);
    }

    public function printmres($id){

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
                        <div style="margin: 20px 50px 0px 50px;"><center><p><strong>SUMMON</strong><br>Mediation Proceedings</p></center></div>
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

    public function printmcom($id){
        
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
                        <div style="margin: 20px 50px 0px 50px;"><center><p><strong>NOTICE OF HEARING</strong><br>Mediation Proceedings</p></center></div>
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

