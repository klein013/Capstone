<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LuponSchedController extends Controller
{
    public function create(){
    	$branches = DB::select('select Branch_ID, Branch_Name from tbl_branch');
    	
    	return view('admin.maintenance_luponsched', compact('branches'));
    }

    public function nosched(Request $request){
    	$officials= DB::select('select Lupon_ID, concat(Off_Fname," ",Off_Lname) as Lupon_Name from tbl_lupon join tbl_off on Off_ID=Lupon_ID where Lupon_Branch is null');

    	return response()->json($officials);
    }

    public function add(Request $request){
    	$day = ""; 
    	if($request->day==0){
    		$day = "Mon";
    	}
    	else if($request->day==1){
    		$day = "Tue";
    	}
    	else if($request->day==2){
    		$day="Wed";
    	}
    	else if($request->day==3){
    		$day="Thu";
    	}
    	else if($request->day==4){
    		$day="Fri";
    	}
    	else if($request->day==5){
    		$day="Sat";
    	}
    	else{
    		$day="Sun";
    	}
    		$days = DB::select('select Lupon_Day from tbl_lupon where = '.$request->id);
    	if(!empty($days[0])){
    		DB::table('tbl_lupon')->where('Lupon_ID',$request->id)->update(['Lupon_Branch'=>$request->area, 'Lupon_Day'=> $days[0]->Lupon_Day.';'.$day]);

		}
		else{
			DB::table('tbl_lupon')->where('Lupon_ID',$request->id)->update(['Lupon_Branch'=>$request->area, 'Lupon_Day'=> $day]);			
		}
    	return null;
    }

    public function subtract(Request $request){
    	DB::table('tbl_lupon')->where('Lupon_ID',$request->id)->update(['Lupon_Branch'=> NULL, 'Lupon_Day'=>NULL]);

    	return null;
    }
}
