<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class ScheduleController extends Controller
{
   	public function create(){
   		$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];
	    return view('admin.schedule', compact('return'));
   	}

   	public function view(){

   		$scheds = DB::select('select concat("Hearing ID: ",h.hearing_id) as "id", concat("Case : ",h.hearing_case," ",kp.caseskp_name)as "case", h.hearing_sched from tbl_hearing h join tbl_caseallocation c on c.caseallocation_case = h.hearing_case join tbl_caseskp kp on kp.caseskp_id = c.caseallocation_case where c.caseallocation_official = '.Session::get('official'));


   		return response()->json($scheds);

   	}
}
