<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblArea;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facedes\Input;
use Session;

class AreaController extends Controller
{
 
 	public function create(){
		$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

	    return view('admin.maintenance_area', compact('return'));
 	}

 	public function getAreas(){

 		$areas = DB::select('select area_id, area_name from tbl_area where area_exists = 1');

 		return response()->json($areas);
 	}

 	public function store(Request $request){

 		$area = new TblArea;

 		$area->area_name = $request->name;
 		$area->area_exists = 1;

 		$area->save();

 		return response()->json($area);
 	}

 	public function destroy(Request $id){

 		DB::table('tbl_area')->where('area_id',$id->id)->update(['area_exists'=>0]);

 		DB::table('tbl_street')->where('street_area',$id->id)->update(['street_exists'=>0]);

 		return response("success");
 	}

 	public function getdetails($id){

 		$name = DB::select('select area_name from tbl_area where area_id = '.$id);

 		return response()->json($name);
 	}

 	public function update(Request $request){

 		DB::table('tbl_area')->where('area_id', $request->id)->update(['area_name'=>$request->name]);

 		return response("success");
 	}
}
