<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\TblHearing;
use App\Models\TblHearingattendance;
use App\Models\TblMinute;

class HearingController extends Controller
{
    //

    public function processhearing($id){

    	 $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

    	 $case = DB::select('select lpad(ca.case_id,8,"0") as case_id , h.hearing_id, concat(lpad(o.official_id,8,"0")," - ",r.resident_fname," ",r.resident_lname) as official, kp.caseskp_name, ca.case_filed, concat(cs.casestage_name," - ",cs.casestage_no) as hearing_type, h.hearing_sched from tbl_case ca join tbl_caseallocation cl on ca.case_id = cl.caseallocation_case join tbl_official o on o.official_id = cl.caseallocation_official join tbl_resident r on o.resident_id = r.resident_id join tbl_hearing h on h.hearing_case = cl.caseallocation_case join tbl_caseskp kp on kp.caseskp_id = ca.case_caseskp join tbl_casestage cs on cs.casestage_id = h.hearing_type where h.hearing_id = '.$id);

    	 $cresidents = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, r.resident_id, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "C"');

    	 $rresidents = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, r.resident_id, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "R"');

    	 $wresidents = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, r.resident_id, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "W" union select "","",""');

       $attendance = DB::select('select distinct(r.resident_id) as resident_id, concat(r.resident_fname," ",r.resident_lname) as name, p.personinvolve_type, h.ha_attented from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id join tbl_hearingattendance h on h.ha_personinvolve = r.resident_id where h.ha_hearing = '.$id);

       if(empty($attendance[0]->resident_id)){
          $attendance = DB::select('select distinct(r.resident_id) as resident_id, concat(r.resident_fname," ",r.resident_lname) as name, p.personinvolve_type, 0 as ha_attented from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident=r.resident_id where p.personinvolve_case = '.$case[0]->case_id);
       }

    	 return view('admin.hearing')->with(array('return'=>$return,'case'=>$case,'cresident'=>$cresidents, 'rresident'=>$rresidents, 'wresident'=>$wresidents, 'attendance'=>$attendance));
    }

    public function addminutes(Request $request){


    	DB::table('tbl_minutes')->where('minutes_hearing',$request->id)->update(['minutes_end'=>date('Y-m-d H:i:s'),'minutes_timerendered'=>$request->rendered, 'minutes_details'=>$request->minutes]);

    	DB::table('tbl_hearing')->where('hearing_id', $request->id)->update(['hearing_status'=>'Done']);
    	
    	return response("success");
    
    }

    public function startminutes(Request $request){

      DB::delete('delete from tbl_minutes where minutes_end is null and minutes_timerendered is null');

    	$minutes = new TblMinute;

    	$minutes->minutes_hearing = $request->id;
    	$minutes->minutes_official = $request->official;

    	$minutes->save();

    	return response($minutes->minutes_id);
    }

    public function attendance(Request $request){

        foreach($request->yown as $resident){

          $resid = explode('|', $resident)[0];
          $check = explode('|', $resident)[1];

          $row = DB::select('select * from tbl_hearingattendance where ha_personinvolve = "'.$resid.'" and ha_hearing = '.$request->id);

          if(empty($row[0]->ha_hearing)){

            $insertnew = new TblHearingattendance;

            $insertnew->ha_personinvolve = $resid;
            $insertnew->ha_hearing = $request->id;
            $insertnew->ha_attented = $check;

            $insertnew->save();
          }
          else{
            DB::table('tbl_hearingattendance')->where([['ha_hearing','=',$request->id],['ha_personinvolve','=',$resid]])->update(['ha_attented'=>$check]);
          }
        }

        $check = DB::select('select * from tbl_hearingattendance where ha_hearing = '.$request->id.' and ha_attented = 0');

        if(empty($check[0]->ha_attented)){
          return response("success");
        }
        else{
          return response("failed"); 
        }

    }


    public function schedNext(Request $request){

    }

    public function schedCon(Request $request){

        $case = $request->case;

        DB::table('tbl_case')->where('case_id',$case)->update(['case_status'=>'Concillation']);
    }

    public function settlement(Request $request){

        $case - $request->case;

        DB::table('tbl_case')->where('case_id',$case)->update(['case_status'=>'Settled']);
    }

    public function showhearing($id){

      $row = DB::select('select h.hearing_id, h.hearing_sched, concat(s.casestage_name,"-",coalesce(s.casestage_no,"")) as casestage, m.minutes_details, m.minutes_start, m.minutes_end, m.minutes_timerendered from tbl_minutes m join tbl_hearing h on h.hearing_id = m.minutes_hearing join tbl_casestage s on s.casestage_id = h.hearing_type where h.hearing_id = '.$id );

      $attendance = DB::select('select distinct(r.resident_id),h.ha_personinvolve, concat(r.resident_fname," ", r.resident_lname) as name, h.ha_attented, p.personinvolve_type from tbl_personinvolve p join tbl_hearingattendance h on h.ha_personinvolve = p.personinvolve_resident join tbl_resident r on r.resident_id = p.personinvolve_resident where h.ha_hearing = '.$id);

      $involve = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id join tbl_hearing h on h.hearing_case = p.personinvolve_case where h.hearing_id = '.$id);

      $residents = DB::select('select r.resident_id, concat(r.resident_fname," ",r.resident_lname)  as name , p.personinvolve_type from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident=r.resident_id join tbl_hearing h on h.hearing_case = p.personinvolve_case where h.hearing_id = '.$id);

      return response()->json(['rows'=>$row, 'attendances'=>$attendance, 'involves'=>$involve, 'residents'=>$residents]);
    }

    public function arb($id){

      DB::table('tbl_case')->where('case_id',$id)->update(['case_status'=>'Arbitration']);
      $hearing = new TblHearing;

      $hearing->hearing_case = $id;
      $hearing->hearing_sched = date('Y-m-d H:i:s');
      $hearing->hearing_status = 'For Process';
      $hearing->hearing_type = 7;
      $hearing->hearing_exists = 1;
      $hearing->save();

      $minutes = new TblMinute;

      $minutes->minutes_hearing = $hearing->hearing_id;
      $minutes->minutes_start = date('Y-m-d H:i:s');
      $minutes->minutes_official = Session::get('official');
      $minutes->minutes_details = "";
      $minutes->minutes_end = null;
      $minutes->minutes_timerendered = null;

      $minutes->save();

       $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

       $case = DB::select('select lpad(ca.case_id,8,"0") as case_id , h.hearing_id, concat(lpad(o.official_id,8,"0")," - ",r.resident_fname," ",r.resident_lname) as official, kp.caseskp_name, ca.case_filed, concat(cs.casestage_name," - ",cs.casestage_no) as hearing_type, h.hearing_sched from tbl_case ca join tbl_caseallocation cl on ca.case_id = cl.caseallocation_case join tbl_official o on o.official_id = cl.caseallocation_official join tbl_resident r on o.resident_id = r.resident_id join tbl_hearing h on h.hearing_case = cl.caseallocation_case join tbl_caseskp kp on kp.caseskp_id = ca.case_caseskp join tbl_casestage cs on cs.casestage_id = h.hearing_type where h.hearing_id = '.$hearing->hearing_id);

       $cresidents = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, r.resident_id, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "C"');

       $rresidents = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, r.resident_id, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "R"');

       $wresidents = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, r.resident_id, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "W" union select "","",""');

       $attendance = DB::select('select distinct(r.resident_id) as resident_id, concat(r.resident_fname," ",r.resident_lname) as name, p.personinvolve_type, h.ha_attented from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id join tbl_hearingattendance h on h.ha_personinvolve = r.resident_id where h.ha_hearing = '.$id);

       if(empty($attendance[0]->resident_id)){
          $attendance = DB::select('select distinct(r.resident_id) as resident_id, concat(r.resident_fname," ",r.resident_lname) as name, p.personinvolve_type, 0 as ha_attented from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident=r.resident_id where p.personinvolve_case = '.$case[0]->case_id);
       }

       return view('admin.arbitration')->with(array('return'=>$return,'case'=>$case,'cresident'=>$cresidents, 'rresident'=>$rresidents, 'wresident'=>$wresidents, 'attendance'=>$attendance, 'minutes'=>$minutes));

    }

    public function arbdelete($id){

        $word = explode('_',$id);
        DB::delete('DELETE from tbl_minutes where minutes_id = '.$word[0]);

        DB::delete('DELETE from tbl_hearingattendance where ha_hearing = '. $word[1]);

        DB::delete('DELETE from tbl_hearing where hearing_id = '.$word[1]);

        $hearing = DB::select('select * tbl_hearing where hearing_case = '.$word[2].' order by hearing_type desc');

        if($hearing[0]->hearing_type<4){
          DB::table('tbl_case')->where('case_id',$word[2])->update('case_status', 'Mediation');
        }
        else if($hearing[0]->hearing_type>3&&$hearing[0]->hearing_type<7){
          DB::table('tbl_case')->where('case_id',$word[2])->update('case_status', 'Conciliation');
        }

        return response("success");
    }

    public function arbsave(Request $request){

      $date = date('Y-m-d H:i:s');

        DB::table('tbl_hearing')->where('hearing_id',$request->id)->update(['hearing_status'=>'Done']);

        DB::table('tbl_minutes')->where('minutes_id',$request->minutesid)->update(['minutes_official'=>$request->official, 'minutes_details'=>$request->minutes, 'minutes_end'=>$date]);

        return response("success");

    }
}

