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
use App\Models\TblPangkat;

class PangkatController extends Controller
{
    
    public function createpangkat(Request $request){

    	$recs = DB::select('select official_id from tbl_official where position_id = 2 and official_exists = 1');

    	$offs = [];

    	array_push($offs, $recs[rand(1, count($recs))-1]->official_id);
    	

    	while(count($offs) < 3){
    		$check= false;
    		$num = 0;
    		foreach($offs as $off){
	    		$num = rand(1, count($recs))-1;
    			if($off==$recs[$num]->official_id){
    				$check=true;
    				break;
	    		}
    		}

    		if($check==false){
    			array_push($offs, $recs[$num]->official_id);
    		}
    	}

    	$return = implode (", ", $offs);

    	$official = DB::select('select o.official_id, concat(r.resident_fname," ",r.resident_lname) as name from tbl_official o join tbl_resident r on r.resident_id = o.resident_id where o.official_id in ('.$return.')');
    	return response()->json($official);

    }

    public function savepangkat(Request $request){

    	$group1 = explode('_', $request->group1);
    	$group2 = explode('_', $request->group2);
    	$group3 = explode('_', $request->group3);

    	$pangkat = new TblPangkat;

    	if($group1[1]=="pp"){
    		$pangkat->pangkat_president = $group1[0];
    	}
    	else if($group1[1]=="ps"){
    		$pangkat->pangkat_secretary = $group1[0];
    	}
    	else{
    		$pangkat->pangkat_member = $group1[0];
    	}

		if($group2[1]=="pp"){
    		$pangkat->pangkat_president = $group2[0];
    	}
    	else if($group2[1]=="ps"){
    		$pangkat->pangkat_secretary = $group2[0];
    	}
    	else{
    		$pangkat->pangkat_member = $group2[0];
    	}   

    	if($group3[1]=="pp"){
    		$pangkat->pangkat_president = $group3[0];
    	}
    	else if($group3[1]=="ps"){
    		$pangkat->pangkat_secretary = $group3[0];
    	}
    	else{
    		$pangkat->pangkat_member = $group3[0];
    	} 	

    	$pangkat->save();

    	DB::table('tbl_case')->where('case_id',$request->id)->update(['case_status'=>'Conciliation']);

    	DB::table('tbl_caseallocation')->where('caseallocation_case',$request->id)->update(['caseallocation_pangkat'=>$pangkat->pangkat_id]);

    	return response("success");
    }
}
