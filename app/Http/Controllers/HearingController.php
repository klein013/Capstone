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

    	 $cresidents = DB::select('select group_concat(concat(r.resident_id," - ",r.resident_fname," ",r.resident_lname)) as name, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "C" group by p.personinvolve_type');

    	 $rresidents = DB::select('select group_concat(concat(r.resident_id," - ",r.resident_fname," ",r.resident_lname)) as name, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "R" group by p.personinvolve_type');

    	 $wresidents = DB::select('select group_concat(concat(r.resident_id," - ",r.resident_fname," ",r.resident_lname)) as name, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "W" group by p.personinvolve_type union select "", ""');

    	 return view('admin.hearing')->with(array('return'=>$return,'case'=>$case,'cresident'=>$cresidents, 'rresident'=>$rresidents, 'wresident'=>$wresidents));
    }

    public function addminutes(Request $request){


    	DB::table('tbl_minutes')->where('minutes_hearing',$request->id)->update(['minutes_end'=>date('Y-m-d H:i:s'),'minutes_timerendered'=>$request->rendered, 'minutes_details'=>$request->minutes]);

    	DB::table('tbl_hearing')->where('hearing_id', $request->id)->update(['hearing_status', 'Finished']);
    	
    	return response("success");
    
    }

    public function startminutes(Request $request){

    	$minutes = new TblMinute;

    	$minutes->minutes_hearing = $request->id;
    	$minutes->minutes_official = $request->official;

    	$minutes->save();

    	return response($minutes->minutes_id);
    }

    public function arbitration(Request $request){


        $case = $request->case;
        $hearing = $request->hearing;


    }


    public function schedNext(Request $request){

        $case = $request->case;


        DB::table('tbl_case')->where('case_id',$case)->update(['case_status'=>'Mediation']);


        $allocexist = DB::select('select * from tbl_caseallocation where caseallocation_case = '.$case.' and caseallocation_official = '.$request->official);

        if(empty($allocexist->caseallocation_case)){
            $alloc = new TblCaseallocation;

            $alloc->caseallocation_case = $request->id;
            $alloc->caseallocation_official = $request->offid;
            $alloc->save();

        }

         $brgytime = DB::select('select brgyinfo_opening, brgyinfo_closing from tbl_brgyinfo limit 1');

          $open = strtotime($brgytime[0]->brgyinfo_opening);
          $close = strtotime($brgytime[0]->brgyinfo_closing);

          $hearing = DB::select('select h.hearing_sched from tbl_hearing h join tbl_caseallocation c on h.hearing_case = c.caseallocation_case where c.caseallocation_official = '.$request->offid.' and h.hearing_sched = curdate() + interval 3 day');

          $det = [];

          if(empty($hearing->hearing_sched)){

            $newhearing = new TblHearing;

            $heardate = date("Y-m-d", strtotime("+4 days"));
            $heartime = date("H:i", strtotime('+30 minutes', $open));
            $newhearing->hearing_case = $request->id;
            $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $heartime"));
            $newhearing->hearing_type = 1;
            $newhearing->hearing_status = "Pending";
            $newhearing->save();

            array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $heartime")), 'case'=>$newhearing->hearing_case]);

          }
          else{

            $heartime = "";
            foreach($hearing as $hear){
              $heardate = $hear->hearing_sched;
              $heardate = (new Carbon($heardate))->format('Y-m-d');
              $time = $hear->hearing_sched;
              $time = (new Carbon($time))->format('H:i');
            }

            $newtime = date("H:i", strtotime('+120 minutes' ,strtotime($time)));
            if(strtotime($newtime) <= strtotime('09:30')){
              
              $newhearing = new TblHearing;

              $newhearing->hearing_case = $request->id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 2;
              $newhearing->hearing_status = "Pending";
              $newhearing->save();
              array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case]);
            }
            else if(strtotime($newtime) <= $close){
              
              $newhearing = new TblHearing;

              $newhearing->hearing_case = $request->id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 1;
              $newhearing->hearing_status = "Pending";
              $newhearing->save();
              array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case]);
            }
            else if(strtotime($newtime) > $close){

              $newhearing = new TblHearing;

              $date = date("Y-m-d", strtotime("+4 days", strtotime($heardate)));
              $heartime = date("H:i", strtotime('+30 minutes', $open));
              $newhearing->hearing_case = $request->id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$date $heartime"));
              $newhearing->hearing_type = 1;
              $newhearing->hearing_status = "Pending";
              $newhearing->save();
              array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$date $heartime")), 'case'=>$newhearing->hearing_case]);
            }
            else{

              $newhearing = new TblHearing;

              $newhearing->hearing_case = $request->id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 1;
              $newhearing->hearing_status = "Pending";
              $newhearing->save();
              array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case]);
            }
        }
        return response()->json($det);
    }

    public function schedCon(Request $request){

        $case = $request->case;

        DB::table('tbl_case')->where('case_id',$case)->update(['case_status'=>'Concillation']);
    }

    public function settlement(Request $request){

        $case - $request->case;

        DB::table('tbl_case')->where('case_id',$case)->update(['case_status'=>'Settled']);
    }
}

