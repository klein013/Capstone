<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblPersoninvolve;
use App\Models\TblCase;
use App\Models\TblCaseallocation;
use App\Models\TblHearing;
use Response;
use Session;
use PDF;

class ComplaintController extends Controller
{
    public function create()
    {
        $cases = DB::select("select caseskp_id, caseskp_name from tbl_caseskp where caseskp_exists = 1 order by caseskp_name");
        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

        return view('admin.complaint')->with(['cases'=>$cases, 'return'=>$return]);
    }

   public function com(Request $req){

      if(!empty($req->used)){
        $com = DB::select('select r.resident_id, concat(r.resident_fname," ",r.resident_lname) as name, r.resident_bdate, concat(r.resident_hno," ",s.street_name," Street ",a.area_name) as address from tbl_resident r join tbl_street s on r.resident_street = s.street_id join tbl_area a on a.area_id = s.street_area where r.resident_id not in (select r.resident_id from tbl_resident r join tbl_official o on o.resident_id = r.resident_id where o.official_exists = 1 and o.position_id in(0,1,2)) and r.resident_id not in('.$req->used.') and r.resident_exists = 1 and  TIMESTAMPDIFF(year,r.resident_bdate, now() ) >=18 and r.resident_non =0');

        return response()->json($com);
      }
      else{
        $com = DB::select('select r.resident_id, concat(r.resident_fname," ",r.resident_lname) as name, r.resident_bdate, concat(r.resident_hno," ",s.street_name," Street ",a.area_name) as address from tbl_resident r join tbl_street s on r.resident_street = s.street_id join tbl_area a on a.area_id = s.street_area where r.resident_id not in ((select r.resident_id from tbl_resident r join tbl_official o on o.resident_id = r.resident_id where o.official_exists = 1 and o.position_id in(0,1,2)), and r.resident_exists = 1 and  TIMESTAMPDIFF(year,r.resident_bdate, now() ) >=18  and r.resident_non =0');

        return response()->json($com);
      }

   }

   public function process(Request $request){

      if($request->turnover=="Lupon"){

        $info = DB::select('select brgyinfo_case from tbl_brgyinfo limit 1');

        $case = new TblCase();

        $case->case_caseskp = $request->case;
        $case->case_statement = $request->statement;
        $case->case_status = "".$info[0]->brgyinfo_case;
        $case->case_exists = 1;

        $case->save();
        $res = explode(",", $request->res);

        foreach($res as $res1){
          $resp = new TblPersoninvolve();

          $resp->personinvolve_resident = str_replace('"','',$res1);
          $resp->personinvolve_case = $case->case_id;
          $resp->personinvolve_type = 'R';
          $resp->save();

        }

        $com = explode(",", $request->com);

        foreach($com as $com1){
          $comp = new TblPersoninvolve();

          $comp->personinvolve_resident = str_replace('"','',$com1);
          $comp->personinvolve_case = $case->case_id;
          $comp->personinvolve_type = 'C';
          $comp->save();
        
        }

        if($request->wit!=null){
            $wit = explode(",", $request->wit);
            foreach($wit as $wit1){

                $witn = new TblPersoninvolve();

                $witn->personinvolve_resident = str_replace('"','',$wit1);
                $witn->personinvolve_case = $case->case_id;
                $witn->personinvolve_type = 'W';
                $witn->save();

                }
        }

        $involvenames = DB::select('select r.resident_mname, r.resident_lname, r.resident_street from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id join tbl_case c on c.case_id = p.personinvolve_case where c.case_id = '.$case->case_id);

        $mnames = "";
        $lnames = "";
        $street = "";

        if(!empty($involvenames)){
          foreach ($involvenames as $name) {
            if($name->resident_mname!=null){
              $mnames .= '"'.$name->resident_mname.'",';
            }
          }
          if($mnames==""){
            $mnames = rtrim($mnames, ",");
          }

          foreach ($involvenames as $name) {
            if($name->resident_lname!=null){
              $mnames .= '"'.$name->resident_lname.'",';
            }
          }
          $mnames = rtrim($mnames, ",");

          foreach ($involvenames as $name) {
            $street .= '"'.$name->resident_street .'",';
          }
          $street = rtrim($street, ',');
        }
        else{
          $mnames = '""';
          $lnames = '""';
          $street = '""';
        }
        
        if($info[0]->brgyinfo_case=="Lupon"){
          $luponid = DB::select('select position_id from tbl_position where position_name = "Lupon"');
          $lupons = DB::select('select o.official_id from tbl_official o join tbl_resident r on r.resident_id = o.resident_id where o.position_id = '.$luponid[0]->position_id. ' and o.official_exists = 1 and (r.resident_mname in ('.$mnames.') or r.resident_lname not in ('.$mnames.') or r.resident_street not in ('.$street.')) ');
          if(!empty($lupons)){

            $newlupons = "";

            if($lupons > 1){
              foreach($lupons as $lupon){
                $newlupons .= $lupon->official_id.",";
              }
              $newlupons = rtrim($newlupons, ',');

              $countcaseallocs = DB::select('select count(caseallocation_case) as number, caseallocation_official from tbl_caseallocation where caseallocation_official in ('.$newlupons.') group by caseallocation_official');

              if(!empty($countcaseallocs)){
                
                $array1 = [];
                $array2 = [];
                foreach($countcaseallocs as $countcasealloc){
                  array_push($array1, $countcasealloc->number) ;
                  array_push($array2, $countcasealloc->caseallocation_official) ;
                }

                foreach($lupons as $newlupon){
                  if(!in_array($newlupon->official_id, $array2)){
                    array_push($array1, 0) ;
                    array_push($array2, $newlupon->official_id);
                    var_dump($newlupon->official_id);
                  }
                }

                $min_value_key=array_keys($array1, min($array1));

                $casealloc = new TblCaseallocation;

                $casealloc->caseallocation_case = $case->case_id;
                $casealloc->caseallocation_official = $array2[$min_value_key[0]];
                $casealloc->save();
              }
              else{
                $casealloc = new TblCaseallocation;

                $casealloc->caseallocation_case = $case->case_id;
                $casealloc->caseallocation_official = $lupons[0]->official_id;
                $casealloc->save();
              }

            }
            else{

              $casealloc = new TblCaseallocation;

              $casealloc->caseallocation_case = $case->case_id;
              $casealloc->caseallocation_official = $lupons[0]->official_id;
              $casealloc->save();

            }

          }
          else{
            
          }

          $brgytime = DB::select('select brgyinfo_opening, brgyinfo_closing from tbl_brgyinfo limit 1');

          $open = strtotime($brgytime[0]->brgyinfo_opening);
          $close = strtotime($brgytime[0]->brgyinfo_closing);

          $hearing = DB::select('select h.hearing_sched from tbl_hearing h join tbl_caseallocation c on h.hearing_case = c.caseallocation_case where c.caseallocation_official = '.$casealloc->caseallocation_official.' and h.hearing_sched = curdate() + interval 3 day');

          if(empty($hearing->hearing_sched)){

            $newhearing = new TblHearing;

            $heardate = date("Y-m-d", strtotime("+3 days"));
            $heartime = date("H:i", strtotime('+30 minutes', $open));
            $newhearing->hearing_case = $case->case_id;
            $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $heartime"));
            $newhearing->hearing_type = 1;
            $newhearing->save();

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

              $newhearing->hearing_case = $case->case_id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 1;
              $newhearing->save();
            }
            else if(strtotime($newtime) <= $close){
              
              $newhearing = new TblHearing;

              $newhearing->hearing_case = $casealloc->caseallocation_case;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 1;
              $newhearing->save();
            }
            else if(strtotime($newtime) > $close){

              $newhearing = new TblHearing;

              $date = date("Y-m-d", strtotime("+3 days"), strtotime($heardate));
              $heartime = date("H:i", strtotime('+30 minutes', $open));
              $newhearing->hearing_case = $casealloc->caseallocation_case;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$date $heartime"));
              $newhearing->hearing_type = 1;
              $newhearing->save();
            }
            else{

              $newhearing = new TblHearing;

              $newhearing->hearing_case = $casealloc->caseallocation_case;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 1;
              $newhearing->save();
            }
          }

        }
        else{

        }

        return response("success");
      }
      else if($request->turnover=="PS6"){


        $case = new TblCase();

        $case->case_caseskp = $request->case;
        $case->case_statement = $request->statement;
        $case->case_status = "Police Station";
        $case->case_exists = 1;

        $case->save();
        $res = explode(",", $request->res);

        foreach($res as $res1){
          $resp = new TblPersoninvolve();

          $resp->personinvolve_resident = str_replace('"','',$res1);
          $resp->personinvolve_case = $case->case_id;
          $resp->personinvolve_type = 'R';
          $resp->save();

        }

        $com = explode(",", $request->com);

        foreach($com as $com1){
          $comp = new TblPersoninvolve();

          $comp->personinvolve_resident = str_replace('"','',$com1);
          $comp->personinvolve_case = $case->case_id;
          $comp->personinvolve_type = 'C';
          $comp->save();
        
        }

        if($request->wit!=null){
            $wit = explode(",", $request->wit);
            foreach($wit as $wit1){

                $witn = new TblPersoninvolve();

                $witn->personinvolve_resident = str_replace('"','',$wit1);
                $witn->personinvolve_case = $case->case_id;
                $witn->personinvolve_type = 'W';
                $witn->save();

                }
        }

        return response("success");
        

      }
      else if($request->turnover=="VAWC"){


        $case = new TblCase();

        $case->case_caseskp = $request->case;
        $case->case_statement = $request->statement;
        $case->case_status = "Violence Against Women and Children";
        $case->case_exists = 1;

        $case->save();
        $res = explode(",", $request->res);

        foreach($res as $res1){
          $resp = new TblPersoninvolve();

          $resp->personinvolve_resident = str_replace('"','',$res1);
          $resp->personinvolve_case = $case->case_id;
          $resp->personinvolve_type = 'R';
          $resp->save();

        }

        $com = explode(",", $request->com);

        foreach($com as $com1){
          $comp = new TblPersoninvolve();

          $comp->personinvolve_resident = str_replace('"','',$com1);
          $comp->personinvolve_case = $case->case_id;
          $comp->personinvolve_type = 'C';
          $comp->save();
        
        }

        if($request->wit!=null){
            $wit = explode(",", $request->wit);
            foreach($wit as $wit1){

                $witn = new TblPersoninvolve();

                $witn->personinvolve_resident = str_replace('"','',$wit1);
                $witn->personinvolve_case = $case->case_id;
                $witn->personinvolve_type = 'W';
                $witn->save();

                }
        }

        return response("success");

      }
      else{

        $case = new TblCase();

        $case->case_caseskp = $request->case;
        $case->case_statement = $request->statement;
        $case->case_status = $request->turnover;
        $case->case_exists = 1;

        $case->save();

        $res = explode(",", $request->res);

        foreach($res as $res1){
          $resp = new TblPersoninvolve();

          $resp->personinvolve_resident = str_replace('"','',$res1);
          $resp->personinvolve_case = $case->case_id;
          $resp->personinvolve_type = 'R';
          $resp->save();

        }

        $com = explode(",", $request->com);

        foreach($com as $com1){
          $comp = new TblPersoninvolve();

          $comp->personinvolve_resident = str_replace('"','',$com1);
          $comp->personinvolve_case = $case->case_id;
          $comp->personinvolve_type = 'C';
          $comp->save();
        
        }

        return response("success");

      }
   }

   public function printps($id){

      $case = DB::select('select * from tbl_case where case_id = '.$id);

      $involvenames = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id join tbl_case c on c.case_id = p.personinvolve_case where c.case_id = '.$id);

        $comp = "";
        $res = "";
        $wit = "";

        foreach($involvenames as $names){
          if($names->personinvolve_type=='C'){
            $comp .= $names->name.';';
          }
          else if($names->personinvolve_type=='R'){
            $res .= $names->name.';';
          }
          else{
            $wit .= $names->name.';'; 
          }
        }


        $head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');


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
                        <div style="margin: 20px 50px 0px 50px;"><center><p><strong>RECOMMENDATION</strong><br></p></center></div>
                        <div style="margin: 20px 50px 0px 50px;"><p>To whom it may concern: </p></div>
                        <div style="margin: 20px 50px 0px 70px;">
                            <p>&nbsp;&nbsp;We received a complaint in our barangay and this complaint is a case that a barangay cant handle and your organization is the right fit to handle this case.</p><br>
                            <p>&nbsp;&nbsp;The person involved in this case is/are the complainant/s : '.$comp.' , the respondents : '.$res.' and the witness/es (if any) : '.$wit.'</p><br>
                            <p>This is the statement of the complainant/s : </p>
                            <p><center>"'.$case[0]->case_statement.'"</center></p><br>
                            <p>&nbsp;&nbsp;We hope that this case will be settled as soon as possible.</p>
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

   public function printvawc($id){

    $case = DB::select('select * from tbl_case where case_id = '.$id);

      $involvenames = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id join tbl_case c on c.case_id = p.personinvolve_case where c.case_id = '.$id);

        $comp = "";
        $res = "";
        $wit = "";

        foreach($involvenames as $names){
          if($names->personinvolve_type=='C'){
            $comp .= $names->name.';';
          }
          else if($names->personinvolve_type=='R'){
            $res .= $names->name.';';
          }
          else{
            $wit .= $names->name.';'; 
          }
        }


        $head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');


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
                        <div style="margin: 20px 50px 0px 50px;"><center><p><strong>RECOMMENDATION</strong><br></p></center></div>
                        <div style="margin: 20px 50px 0px 50px;"><p>To whom it may concern: </p></div>
                        <div style="margin: 20px 50px 0px 70px;">
                            <p>&nbsp;&nbsp;We received a complaint in our barangay and this complaint is a case that a barangay cant handle and your organization is the right fit to handle this case.</p><br>
                            <p>&nbsp;&nbsp;The person involved in this case is/are the complainant/s : '.$comp.' , the respondents : '.$res.' and the witness/es (if any) : '.$wit.'</p><br>
                            <p>This is the statement of the complainant/s : </p>
                            <p><center>"'.$case[0]->case_statement.'"</center></p><br>
                            <p>&nbsp;&nbsp;We hope that this case will be settled as soon as possible.</p>
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
