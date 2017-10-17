<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblRequirement;
use DB;
use App\Http\Requests;
use Response;
use Session;
use Illuminate\Support\Facedes\Input;

class RequirementController extends Controller
{
    //

    public function create(){
    	$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];
        return view('admin.maintenance_requirement', compact('return'));

    }

   public function getRequirements(){

    	$requirements = DB::select('select requirement_id, requirement_name, requirement_desc from tbl_requirement where requirement_exists = 1');

    	return response()->json($requirements);
    }

    public function store(Request $request){

    	$check = DB::select('select requirement_id from tbl_requirement where (lower(requirement_name = lower("'.$request->name.'") and lower(requirement_desc) = "'.$request->desc.'")) and requirement_exists = 1');

    	if(!empty($check)){
    		return response()->json();
    	}
    	else{
    		$req = new TblRequirement;

    		$req->requirement_name = $request->name;
    		$req->requirement_desc = $request->desc;
    		$req->requirement_exists =1;

    		$req->save();

    		return response()->json($req);
    	}
    }

    public function destroy(Request $request){

    	DB::table('tbl_requirement')->where('requirement_id',$request->id)->update(['requirement_exists'=>0]);

    	return response("success");

    }

    public function getdetails($id){

    	$requirement = DB::select('select requirement_name, requirement_desc from tbl_requirement where requirement_id = '.$id);

    	return response()->json($requirement);

    }

    public function update(Request $request){
    	$check = DB::select('select requirement_id from tbl_requirement where (lower(requirement_name = lower("'.$request->name.'") and lower(requirement_desc) = "'.$request->desc.'")) and requirement_exists = 1 and requirement_id != '.$request->id);

    	if(!empty($check)){
    		return response()->json();
    	}
    	else{
    		DB::table('tbl_requirement')->where('requirement_id',$request->id)->update(['requirement_name'=>$request->name,'requirement_desc'=>$request->desc]);

    		return response()->json("success");
    	}
    }

}
