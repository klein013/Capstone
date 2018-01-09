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

class RecordController extends Controller
{
    public function create()
    {

     $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];
	    return view('admin.record', compact('return'));
    }

    public function showblotter($id){
      $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

      $records = DB::select('select lpad(c.case_id,8,"0") as case_id, c.case_filed, concat(r.resident_fname," ",r.resident_lname) as name, p.personinvolve_type, k.caseskp_name, c.case_status from tbl_case c join tbl_personinvolve p on c.case_id = p.personinvolve_case left join tbl_resident r on p.personinvolve_resident = r.resident_id join tbl_caseskp k on c.case_caseskp = k.caseskp_id where c.case_exists = 1 and c.case_id = '.$id.' group by c.case_id, p.personinvolve_type ');

      $hearingsmed = DB::select('select h.hearing_id, concat(s.casestage_name,"-",s.casestage_no) as casestage, h.hearing_sched, h.hearing_status from tbl_hearing h join tbl_casestage s on s.casestage_id = h.hearing_type where h.hearing_exists =1 and h.hearing_type<4 and h.hearing_case = '.$id);

      $hearingscon = DB::select('select coalesce(h.hearing_id,null) as hearing_id, concat(s.casestage_name,"-",s.casestage_no) as casestage, h.hearing_sched, h.hearing_status from tbl_hearing h join tbl_casestage s on s.casestage_id = h.hearing_type where h.hearing_exists =1 and h.hearing_type in(4,5,6) and h.hearing_case = '.$id);

      $hearingsarb = DB::select('select coalesce(h.hearing_id,null) as hearing_id, concat(s.casestage_name,"-",coalesce(s.casestage_no,"")) as casestage, h.hearing_sched, h.hearing_status from tbl_hearing h join tbl_casestage s on s.casestage_id = h.hearing_type where h.hearing_exists =1 and h.hearing_type =7 and h.hearing_case = '.$id);

      $checkalloc = DB::select('select * from tbl_caseallocation where caseallocation_case = '.$id);

      if(empty($checkalloc[0]->caseallocation_pangkat)){
        $allocated = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, lpad(o.official_id,8,"0") as official_id from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_caseallocation a on a.caseallocation_official= o.official_id where a.caseallocation_case = '.$id);
      }
      else{

        $pangkat = DB::select('select concat(pangkat_president,",",pangkat_secretary,",",pangkat_member) as pangkat from tbl_pangkat where pangkat_id = 3');

        $allocated = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, lpad(o.official_id,8,"0") as official_id from tbl_resident r join tbl_official o on o.resident_id = r.resident_id where o.official_id in ('.$pangkat[0]->pangkat.')');
      }


      $settle = DB::select('select DATE(s.settlement_datetime) as settledate from tbl_settlement s join tbl_hearing h on s.settlement_hearing = h.hearing_id where h.hearing_case = '.$id.' and TIMESTAMPDIFF(day,s.settlement_datetime, now() ) >= 10');

      return view('admin.recorddetails')->with(['return'=>$return, 'records'=>$records, 'hearingsmed'=>$hearingsmed, 'hearingscon'=>$hearingscon, 'hearingsarb'=>$hearingsarb, 'allocated'=>$allocated, 'settlement'=>$settle]);
    }

    public function show(){
    	
    	$records = DB::select('select lpad(c.case_id,8,"0") as case_id, c.case_filed, concat(r.resident_fname," ",r.resident_lname) as name, p.personinvolve_type, k.caseskp_name, c.case_status from tbl_case c join tbl_personinvolve p on c.case_id = p.personinvolve_case left join tbl_resident r on p.personinvolve_resident = r.resident_id join tbl_caseskp k on c.case_caseskp = k.caseskp_id where c.case_exists = 1 group by c.case_id, p.personinvolve_type ORDER BY 1,6,2');

    	return response()->json($records);

    }

    public function getcase(Request $request){

        if($request->stat=="Lupon"){
            $luponid = DB::select('select position_id from tbl_position where position_name = "Lupon"');
            $countcaseallocs = DB::select('select count(ca.caseallocation_case) as number, lpad(ca.caseallocation_official,8,"0") as caseallocation_official, concat(r.resident_fname," ",r.resident_lname) as name from tbl_caseallocation ca join tbl_case c on c.case_id = ca.caseallocation_case join tbl_official o on o.official_id = ca.caseallocation_official join tbl_resident r on r.resident_id = o.resident_id where DATE(c.case_filed) <= DATE_ADD(NOW(), INTERVAL -1 MONTH) group by ca.caseallocation_official order by 1 asc');

            if(empty($countcaseallocs[0])){

                $case = DB::select('select o.official_id from tbl_official o join tbl_resident r on o.resident_id = r.resident_id join tbl_personinvolve pi on pi.personinvolve_resident = r.resident_id join tbl_case c on c.case_id = pi.personinvolve_case where c.case_id = '.$request->id.' and o.position_id = '.$luponid[0]->position_id);

                if(!empty($case)){

                  $offs = "";
                  foreach($case as $off){
                      $offs .= $off->official_id.",";
                  }
                  $offs= rtrim($offs,',');

                  $lupons = DB::select('select lpad(o.official_id,8,"0") as official_id, concat(r.resident_fname," ",r.resident_lname) as name from tbl_official o join tbl_resident r on r.resident_id = o.resident_id where o.position_id = '.$luponid[0]->position_id. ' and o.official_id not in ('.$offs.') and o.official_exists = 1 order by o.official_id');
                }
                else{

                   $lupons = DB::select('select lpad(o.official_id,8,"0") as official_id, concat(r.resident_fname," ",r.resident_lname) as name from tbl_official o join tbl_resident r on r.resident_id = o.resident_id where o.position_id = '.$luponid[0]->position_id. ' and o.official_exists = 1 order by o.official_id');

                }

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

                if(!empty($case[0])){
                $offs = "";
                foreach($case as $off){
                    $offs .= $off->official_id.",";
                }
                $offs= rtrim($offs,',');

                $countcaseallocs = DB::select('select count(ca.caseallocation_case) as number, lpad(ca.caseallocation_official,8,"0") as caseallocation_official, concat(r.resident_fname," ",r.resident_lname) as name from tbl_caseallocation ca join tbl_case c on c.case_id = ca.caseallocation_case join tbl_official o on o.official_id = ca.caseallocation_official join tbl_resident r on r.resident_id = o.resident_id where DATE(c.case_filed) <= DATE_ADD(NOW(), INTERVAL -1 MONTH) and ca.caseallocation_official not in ('.$offs.') group by ca.caseallocation_official order by 1 asc');

                $lupons = DB::select('select lpad(o.official_id,8,"0") as official_id, concat(r.resident_fname," ",r.resident_lname) as name from tbl_official o join tbl_resident r on r.resident_id = o.resident_id where o.position_id = '.$luponid[0]->position_id. ' and o.official_exists = 1 and o.official_id not in('.$newlupons.') order by o.official_id');

              }
              else{

                $countcaseallocs = DB::select('select count(ca.caseallocation_case) as number, lpad(ca.caseallocation_official,8,"0") as caseallocation_official, concat(r.resident_fname," ",r.resident_lname) as name from tbl_caseallocation ca join tbl_case c on c.case_id = ca.caseallocation_case join tbl_official o on o.official_id = ca.caseallocation_official join tbl_resident r on r.resident_id = o.resident_id where DATE(c.case_filed) <= DATE_ADD(NOW(), INTERVAL -1 MONTH) and ca.caseallocation_official not in ('.$offs.') group by ca.caseallocation_official order by 1 asc');

                $lupons = DB::select('select lpad(o.official_id,8,"0") as official_id, concat(r.resident_fname," ",r.resident_lname) as name from tbl_official o join tbl_resident r on r.resident_id = o.resident_id where o.position_id = '.$luponid[0]->position_id. ' and o.official_exists = 1 order by o.official_id');

              }

                

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

    public function reschedcap($id){

    }

    public function allocatecap(Request $request){

      DB::table('tbl_case')->where('case_id',$request->id)->update(['case_status'=>'Mediation']);

      $off = DB::select('select official_id from tbl_official where position_id = 1 and official_exists = 1 ;');

      if(!empty($off[0]->official_id)){
        $alloc = new TblCaseallocation;

        $alloc->caseallocation_case = $request->id;
        $alloc->caseallocation_official = $off[0]->official_id;
        $alloc->save();

        $brgytime = DB::select('select brgyinfo_opening, brgyinfo_closing from tbl_brgyinfo limit 1');

          $open = strtotime($brgytime[0]->brgyinfo_opening);
          $close = strtotime($brgytime[0]->brgyinfo_closing);

          $hearing = DB::select('select DISTINCT(h.hearing_id), h.hearing_sched from tbl_hearing h join tbl_caseallocation c on h.hearing_case = c.caseallocation_case where c.caseallocation_official = '.$off[0]->official_id.' and DATE(h.hearing_sched) = (curdate() + interval '.$request->number.' DAY) and h.hearing_exists = 1 and h.hearing_status != "Void" order by TIME(h.hearing_sched)');

          $det = [];
          if(empty($hearing[0])){

            $newhearing = new TblHearing;

            $heardate = date("Y-m-d", strtotime("+".$request->number." days"));
            $heartime = date("H:i", strtotime('+30 minutes', $open));
            $newhearing->hearing_case = $request->id;
            $newhearing->hearing_sched = strtotime("$heardate $heartime");
            $newhearing->hearing_type = 1;
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
                else{
                           $hearingletter->hl_lettertype = 'Subpoena';   
                        }

                $hearingletter->save();
              }

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
                    $checktrue .= $timeincarbon;
                      break;
                  }
                  else{
                    $timeincarbon->addHours(2);
                    $checktrue .= $timeincarbon;
                    $time = $timeincarbon;
                  }
              

            }

            $newtime = date('H:i', strtotime($time));
            if(strtotime($newtime) <= strtotime('09:30')){
              
              $newhearing = new TblHearing;

              $newhearing->hearing_case = $request->id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 1;
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
                else{
                           $hearingletter->hl_lettertype = 'Subpoena';   
                        }

                $hearingletter->save();
              }
              array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case]);
            }
            else if(strtotime($newtime) < $close){
              
              $newhearing = new TblHearing;

              $newhearing->hearing_case = $request->id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 1;
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
                else{
                           $hearingletter->hl_lettertype = 'Subpoena';   
                        }

                $hearingletter->save();
              }

              array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case]);
            }
            else if(strtotime($newtime) >= $close){

              $request->number = $request->number+1;
              return $this->allocatecap($request);
            }
            else{

              $newhearing = new TblHearing;

              $newhearing->hearing_case = $request->id;
              $newhearing->hearing_sched = date('Y-m-d H:i:s', strtotime("$heardate $newtime"));
              $newhearing->hearing_type = 1;
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
                else{
                           $hearingletter->hl_lettertype = 'Subpoena';   
                        }

                $hearingletter->save();
              }
              array_push($det,['sched'=>date('Y-m-d H:i:s', strtotime("$heardate $newtime")), 'case'=>$newhearing->hearing_case]);
            }
        }
        return response()->json($det);
      }
      else{
        return response()->json("No Barangay Captain Assigned");
      }
    }


    public function delete($id){

        DB::table('tbl_case')->where('case_id',$id)->update(['case_exists'=>0]);
        return response("success");
    }

    public function showhearing($id){


    }

    public function showprint($id){

      $letters = DB::select('select DISTINCT(concat(r.resident_fname," ",r.resident_lname)) as name, r.resident_id, l.hl_lettertype, l.hl_printdate, DATE(l.hl_datereceive) as hl_datereceive from tbl_hearingletter l join tbl_resident r on r.resident_id = l.hl_personinvolve where l.hl_hearing = '.$id);

      return response()->json($letters);

    }

    public function receive($id){

      $request = explode('_', $id);

      DB::table('tbl_hearingletter')->where([['hl_personinvolve','=',$request[0]], ['hl_lettertype','=',$request[1]], ['hl_hearing','=',$request[2]]])->update(['hl_datereceive'=>date('Y-m-d H:i:s')]);

      return response("success");
    }

    public function repudiate(Request $request){

      DB::table('tbl_case')->where('case_id',$request->id)->update(['case_status'=>'Repudiated']);

      return response("success");

    }
}

