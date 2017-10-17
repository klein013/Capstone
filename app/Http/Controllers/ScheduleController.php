<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblHearing;
use App\Models\TblHearingletter;
use App\Models\TblCaseallocation;
use App\Models\TblCase;
use Session;
use DB;
use Carbon;

class ScheduleController extends Controller
{
   	public function create(){
   		$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];
	    return view('admin.schedule', compact('return'));
   	}

   	public function view(){

         DB::table('tbl_hearing')->whereDate('hearing_sched','<',date('Y-m-d'))->whereIn('hearing_status',array('For Process', 'Pending'))->where('hearing_status','!=','Done')->update(['hearing_status'=>'For Reschedule']);

         DB::table('tbl_hearing')->whereDate('hearing_sched','=',date('Y-m-d'))->whereTime('hearing_sched','<=',date('H:i:s'))->where('hearing_status','!=','Done')->update(['hearing_status'=>'For Process']);

   		if(Session::get('official')==0){
   			$scheds = DB::select('select distinct(concat("Hearing ID: ",h.hearing_id)) as "id", h.hearing_status,concat("Case : ",h.hearing_case) as "case", kp.caseskp_name as casename, h.hearing_sched from tbl_hearing h join tbl_caseallocation c on c.caseallocation_case = h.hearing_case join tbl_case ca on ca.case_id = h.hearing_case join tbl_caseskp kp on kp.caseskp_id = ca.case_caseskp where ca.case_exists = 1 and h.hearing_exists = 1');
   		}
   		else{
   			$scheds = DB::select('select distinct(concat("Hearing ID: ",h.hearing_id)) as "id", h.hearing_status, concat("Case : ",h.hearing_case) as "case", kp.caseskp_name as casename, h.hearing_sched from tbl_hearing h join tbl_caseallocation c on c.caseallocation_case = h.hearing_case join tbl_case ca on ca.case_id = h.hearing_case join tbl_caseskp kp on kp.caseskp_id = ca.case_caseskp where ca.case_exists = 1 and h.hearing_exists = 1 and c.caseallocation_official = '.Session::get('official'));
   		}

   		return response()->json($scheds);

   	}

      public function getdetails($id){

         $case = DB::select('select lpad(ca.case_id,8,"0") as case_id , h.hearing_id, concat(lpad(o.official_id,8,"0")," - ",r.resident_fname," ",r.resident_lname) as official, kp.caseskp_name, ca.case_filed, concat(cs.casestage_name," - ",cs.casestage_no) as hearing_type, h.hearing_sched from tbl_case ca join tbl_caseallocation cl on ca.case_id = cl.caseallocation_case join tbl_official o on o.official_id = cl.caseallocation_official join tbl_resident r on o.resident_id = r.resident_id join tbl_hearing h on h.hearing_case = cl.caseallocation_case join tbl_caseskp kp on kp.caseskp_id = ca.case_caseskp join tbl_casestage cs on cs.casestage_id = h.hearing_type where h.hearing_id = '.$id);

         $cresidents = DB::select('select group_concat(concat(r.resident_id," - ",r.resident_fname," ",r.resident_lname)) as name, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "C" group by p.personinvolve_type');

          $rresidents = DB::select('select group_concat(concat(r.resident_id," - ",r.resident_fname," ",r.resident_lname)) as name, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "R" group by p.personinvolve_type');

         $wresidents = DB::select('select group_concat(concat(r.resident_id," - ",r.resident_fname," ",r.resident_lname)) as name, p.personinvolve_type from tbl_resident r join tbl_personinvolve p on r.resident_id = p.personinvolve_resident join tbl_case c on p.personinvolve_case = c.case_id where c.case_id = '.$case[0]->case_id.' and p.personinvolve_type = "W" group by p.personinvolve_type union select "", ""');

         return response()->json([['case'=>$case],['cresidents'=>$cresidents],['rresidents'=>$rresidents],['wresidents'=>$wresidents]]);

      }

      public function resched(Request $request){

         $iflupon = DB::select('select brgyinfo_case from tbl_brgyinfo');

         if($iflupon[0]->brgyinfo_case == "Captain"){

            $type= DB::select("select hearing_type from tbl_hearing where hearing_id = ".$request->id);

            if($type[0]->hearing_type<4){

               $caseallocated = DB::select('select * from tbl_caseallocation where caseallocation_case = '.$request->caseno);

               $brgytime = DB::select('select brgyinfo_opening, brgyinfo_closing from tbl_brgyinfo limit 1');

               $open = strtotime($brgytime[0]->brgyinfo_opening);
               $close = strtotime($brgytime[0]->brgyinfo_closing);

               $hearing = DB::select('select DISTINCT(h.hearing_id), h.hearing_sched from tbl_hearing h join tbl_caseallocation c on h.hearing_case = c.caseallocation_case where c.caseallocation_official = '.$caseallocated[0]->caseallocation_official.' and DATE(h.hearing_sched) = (DATE("'.$request->rescheddate.'") + interval '.$request->number.' DAY) and h.hearing_exists = 1 order by TIME(h.hearing_sched)');

               $det = [];

               if(empty($hearing[0]->hearing_id)){

               $newhearing = new TblHearing;

               $heardate = $request->rescheddate;
               $heartime = date("H:i", strtotime('+30 minutes', $open));
               $newhearing->hearing_case = $request->caseno;
               $newhearing->hearing_sched = strtotime("$heardate $heartime");
               $newhearing->hearing_type = $type[0]->hearing_type;
               $newhearing->hearing_status = "Pending";
               $newhearing->hearing_exists = true;
               $newhearing->save();
               $residents = DB::select('select personinvolve_resident, personinvolve_type from tbl_personinvolve where personinvolve_case = '.$request->caseno);

                     foreach($residents as $resident){
                        $hearingletter = new TblHearingletter;

                        $hearingletter->hl_hearing = $newhearing->hearing_id;
                        $hearingletter->hl_personinvolve = $resident->personinvolve_resident;
                        $hearingletter->hl_printdate = null;
                        $hearingletter->hl_datereceive = null;
                        if($resident->personinvolve_type=='C'){
                           $hearingletter->hl_lettertype = 'Summon';
                        }
                        else if($resident->personinvolve_type=='R'){
                           $hearingletter->hl_lettertype = 'Notice of Hearing - Mediation Proceedings'; 
                        }

                        $hearingletter->save();
                     }

               DB::table('tbl_hearing')->where('hearing_id', $request->id)->update(['hearing_exists'=>false,'hearing_status'=>'Rescheduled']);

               array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $heartime")), 'case'=>$newhearing->hearing_case]);

               }
               else{

               $checktrue = "";
               $fromtime = explode(':', $brgytime[0]->brgyinfo_opening);
               $heartime = "";
               $heardate = $hearing[0]->hearing_sched;
               $heardate = (new Carbon($heardate))->format('Y-m-d');
               $time = Carbon::createFromTime($fromtime[0],$fromtime[1],$fromtime[2],0);
               $time->addMinutes(30);

               foreach($hearing as $hear){
                  $timeinstring = explode(':', ((explode(' ', $hear->hearing_sched)[1])));
                  $timeincarbon = Carbon::createFromTime($timeinstring[0], $timeinstring[1], $timeinstring[2], 0);

              
                  if(($timeincarbon->hour-$time->hour)>=2){
                      break;
                  }
                  else{
                    $timeincarbon->addHours(2);
                    $time = $timeincarbon;
                  }
              

               }

               $newtime = date('H:i', strtotime($time));
               if(strtotime($newtime) <= strtotime('09:30')){
              
                  $newhearing = new TblHearing;

                 $newhearing->hearing_case = $request->caseno;
                 $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
                 $newhearing->hearing_type = $type[0]->hearing_type;
                 $newhearing->hearing_status = "Pending";
                 $newhearing->hearing_exists = true;
                 $newhearing->save();
                 $residents = DB::select('select personinvolve_resident, personinvolve_type from tbl_personinvolve where personinvolve_case = '.$request->caseno);

                     foreach($residents as $resident){
                        $hearingletter = new TblHearingletter;

                        $hearingletter->hl_hearing = $newhearing->hearing_id;
                        $hearingletter->hl_personinvolve = $resident->personinvolve_resident;
                        $hearingletter->hl_printdate = null;
                        $hearingletter->hl_datereceive = null;
                        if($resident->personinvolve_type=='C'){
                           $hearingletter->hl_lettertype = 'Summon';
                        }
                        else if($resident->personinvolve_type=='R'){
                           $hearingletter->hl_lettertype = 'Notice of Hearing - Mediation Proceedings'; 
                        }


                        $hearingletter->save();
                     }
                 DB::table('tbl_hearing')->where('hearing_id', $request->id)->update(['hearing_exists'=>false,'hearing_status'=>'Rescheduled']);
                 array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case]);
               }
               else if(strtotime($newtime) < $close){
              
                 $newhearing = new TblHearing;

                 $newhearing->hearing_case = $request->caseno;
                 $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
                 $newhearing->hearing_type = $type[0]->hearing_type;
                 $newhearing->hearing_status = "Pending";
                 $newhearing->hearing_exists = true;
                 $newhearing->save();

                 $residents = DB::select('select personinvolve_resident, personinvolve_type from tbl_personinvolve where personinvolve_case = '.$request->caseno);

                     foreach($residents as $resident){
                        $hearingletter = new TblHearingletter;

                        $hearingletter->hl_hearing = $newhearing->hearing_id;
                        $hearingletter->hl_personinvolve = $resident->personinvolve_resident;
                        $hearingletter->hl_printdate = null;
                        $hearingletter->hl_datereceive = null;
                        if($resident->personinvolve_type=='C'){
                           $hearingletter->hl_lettertype = 'Summon';
                        }
                        else if($resident->personinvolve_type=='R'){
                           $hearingletter->hl_lettertype = 'Notice of Hearing - Mediation Proceedings'; 
                        }

                        $hearingletter->save();
                     }
                 DB::table('tbl_hearing')->where('hearing_id', $request->id)->update(['hearing_exists'=>false,'hearing_status'=>'Rescheduled']);
                 array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case]);
               }
               else if(strtotime($newtime) >= $close){

                  return response()->json("No available slot for the selected date");
                 
               }
               else{

                  $newhearing = new TblHearing;

                 $newhearing->hearing_case = $request->caseno;
                 $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
                 $newhearing->hearing_type = $type[0]->hearing_type;
                 $newhearing->hearing_status = "Pending";
                 $newhearing->hearing_exists = true;
                 $newhearing->save();

                 $residents = DB::select('select personinvolve_resident, personinvolve_type from tbl_personinvolve where personinvolve_case = '.$request->caseno);

                     foreach($residents as $resident){
                        $hearingletter = new TblHearingletter;

                        $hearingletter->hl_hearing = $newhearing->hearing_id;
                        $hearingletter->hl_personinvolve = $resident->personinvolve_resident;
                        $hearingletter->hl_printdate = null;
                        $hearingletter->hl_datereceive = null;
                        if($resident->personinvolve_type=='C'){
                           $hearingletter->hl_lettertype = 'Summon';
                        }
                        else if($resident->personinvolve_type=='R'){
                           $hearingletter->hl_lettertype = 'Notice of Hearing - Mediation Proceedings'; 
                        }

                        $hearingletter->save();
                     }
                 DB::table('tbl_hearing')->where('hearing_id', $request->id)->update(['hearing_exists'=>false,'hearing_status'=>'Rescheduled']);
                 array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case.'\n '.$checktrue]);
               }
               }

               return response()->json($det);
            }
            else if($type[0]->hearing_type<7){

            }
            else{

            }
         }
//Lupon
         else{

         }
      }

      public function schednext(Request $request){

         $hearings = DB::select('select * from tbl_hearing where hearing_status = "Done" and hearing_exists =1 and hearing_case = '.$request->id.' order by hearing_sched desc limit 1');

         if($hearings[0]->hearing_type<4){
            if($hearings[0]->hearing_type!=3){
               $caseallocated = DB::select('select * from tbl_caseallocation where caseallocation_case = '.$request->id);

               $brgytime = DB::select('select brgyinfo_opening, brgyinfo_closing from tbl_brgyinfo limit 1');

               $open = strtotime($brgytime[0]->brgyinfo_opening);
               $close = strtotime($brgytime[0]->brgyinfo_closing);

               $hearing = DB::select('select DISTINCT(h.hearing_id), h.hearing_sched from tbl_hearing h join tbl_caseallocation c on h.hearing_case = c.caseallocation_case where c.caseallocation_official = '.$caseallocated[0]->caseallocation_official.' and DATE(h.hearing_sched) = (curdate() + interval '.$request->number.' DAY) and h.hearing_exists = 1 order by TIME(h.hearing_sched)');

               $det = [];

               if(empty($hearing[0])){

                  $newhearing = new TblHearing;

                  $heardate = date("Y-m-d", strtotime("+".$request->number." days"));
                  $heartime = date("H:i", strtotime('+30 minutes', $open));
                  $newhearing->hearing_case = $request->id;
                  $newhearing->hearing_sched = strtotime("$heardate $heartime");
                  $newhearing->hearing_type = $hearings[0]->hearing_type+1;
                  $newhearing->hearing_status = "Pending";
                  $newhearing->hearing_exists = true;
                  $newhearing->save();

                  $residents = DB::select('select personinvolve_resident, personinvolve_type from tbl_personinvolve where personinvolve_case = '.$request->id);

                     foreach($residents as $resident){
                        $hearingletter = new TblHearingletter;

                        $hearingletter->hl_hearing = $newhearing->hearing_id;
                        $hearingletter->hl_personinvolve = $resident->personinvolve_resident;
                        $hearingletter->hl_printdate = null;
                        $hearingletter->hl_datereceive = null;
                        if($resident->personinvolve_type=='C'){
                           $hearingletter->hl_lettertype = 'Summon';
                        }
                        else if($resident->personinvolve_type=='R'){
                           $hearingletter->hl_lettertype = 'Notice of Hearing - Mediation Proceedings'; 
                        }

                  $hearingletter->save();
               }

                  DB::table('tbl_hearing')->where('hearing_id', $request->id)->update(['hearing_exists'=>false,'hearing_status'=>'Rescheduled']);

                  array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $heartime")), 'case'=>$newhearing->hearing_case]);

               }

               else{

                  $checktrue = "";
                  $fromtime = explode(':', $brgytime[0]->brgyinfo_opening);
                  $heartime = "";
                  $heardate = $hearing[0]->hearing_sched;
                  $heardate = (new Carbon($heardate))->format('Y-m-d');
                  $time = Carbon::createFromTime($fromtime[0],$fromtime[1],$fromtime[2],0);
                  $time->addMinutes(30);

                  foreach($hearing as $hear){
                     $timeinstring = explode(':', ((explode(' ', $hear->hearing_sched)[1])));
                     $timeincarbon = Carbon::createFromTime($timeinstring[0], $timeinstring[1], $timeinstring[2], 0);

              
                     if(($timeincarbon->hour-$time->hour)>=2){
                         break;
                     }
                     else{
                       $timeincarbon->addHours(2);
                       $time = $timeincarbon;
                     }
                  }
            
                  $newtime = date('H:i', strtotime($time));
                  if(strtotime($newtime) <= strtotime('09:30')){
              
                     $newhearing = new TblHearing;

                     $newhearing->hearing_case = $request->id;
                     $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
                     $newhearing->hearing_type = $hearings[0]->hearing_type+1;
                     $newhearing->hearing_status = "Pending";
                     $newhearing->hearing_exists = true;
                     $newhearing->save();

                     $residents = DB::select('select personinvolve_resident, personinvolve_type from tbl_personinvolve where personinvolve_case = '.$request->id);

                     foreach($residents as $resident){
                        $hearingletter = new TblHearingletter;

                        $hearingletter->hl_hearing = $newhearing->hearing_id;
                        $hearingletter->hl_personinvolve = $resident->personinvolve_resident;
                        $hearingletter->hl_printdate = null;
                        $hearingletter->hl_datereceive = null;
                        if($resident->personinvolve_type=='C'){
                           $hearingletter->hl_lettertype = 'Summon';
                        }
                        else if($resident->personinvolve_type=='R'){
                           $hearingletter->hl_lettertype = 'Notice of Hearing - Mediation Proceedings'; 
                        }

                        $hearingletter->save();
                     }
                     
                     array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case.'\n '.$checktrue]);
                  }
                  else if(strtotime($newtime) < $close){
              
                       $newhearing = new TblHearing;

                       $newhearing->hearing_case = $request->id;
                       $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
                       $newhearing->hearing_type = $hearings[0]->hearing_type+1;
                       $newhearing->hearing_status = "Pending";
                       $newhearing->hearing_exists = true;
                       $newhearing->save();

                       $residents = DB::select('select personinvolve_resident, personinvolve_type from tbl_personinvolve where personinvolve_case = '.$request->id);

                       foreach($residents as $resident){
                           $hearingletter = new TblHearingletter;

                           $hearingletter->hl_hearing = $newhearing->hearing_id;
                           $hearingletter->hl_personinvolve = $resident->personinvolve_resident;
                           $hearingletter->hl_printdate = null;
                           $hearingletter->hl_datereceive = null;
                           if($resident->personinvolve_type=='C'){
                              $hearingletter->hl_lettertype = 'Summon';
                           }
                           else if($resident->personinvolve_type=='R'){
                              $hearingletter->hl_lettertype = 'Notice of Hearing - Mediation Proceedings'; 
                           }

                           $hearingletter->save();
                        }

                        array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case.'\n '.$checktrue]);
                     }
                     else if(strtotime($newtime) >= $close){

                        $request->number = $request->number+1;
                        return $this->reschednext($request);
                     }
                     else{

                        $newhearing = new TblHearing;

                        $newhearing->hearing_case = $request->id;
                        $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
                        $newhearing->hearing_type = $hearings[0]->hearing_type+1;
                        $newhearing->hearing_status = "Pending";
                        $newhearing->hearing_exists = true;
                        $newhearing->save();

                        $residents = DB::select('select personinvolve_resident, personinvolve_type from tbl_personinvolve where personinvolve_case = '.$request->id);

                        foreach($residents as $resident){
                           $hearingletter = new TblHearingletter;

                           $hearingletter->hl_hearing = $newhearing->hearing_id;
                           $hearingletter->hl_personinvolve = $resident->personinvolve_resident;
                           $hearingletter->hl_printdate = null;
                           $hearingletter->hl_datereceive = null;
                           if($resident->personinvolve_type=='C'){
                              $hearingletter->hl_lettertype = 'Summon';
                           }
                           else if($resident->personinvolve_type=='R'){
                              $hearingletter->hl_lettertype = 'Notice of Hearing - Mediation Proceedings'; 
                           }

                          $hearingletter->save();
                        }
                        array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case.'\n '.$checktrue]);
                     }              
               
            }
            return response()->json($det);
         }

         }               
      }
}
