<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Models\TblH;

class HolidayController extends Controller
{

    public function create()
    {
    	 $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];
	    return view('admin.events', compact('return'));
    }

    public function show(){

    	$events = DB::select('select * from tbl_hs');

    	return response()->json($events);
    }

    public function store(Request $request){

    	$event = new TblH;

    	$event->hs_name = $request->name;
    	$event->hs_desc = $request->desc;
    	$event->save();

    	return response()->json($event);
    }

    public function delete(Request $request){

    	DB::delete('DELETE FROM tbl_hs where hs_id = '.$request->id);

    	return response("success");
    }

    public function updaterec($id){

    	$event = DB::select('select * from tbl_hs where hs_id = '.$id);

    	return response()->json($event);
    }

    public function update(Request $request){

    	DB::table('tbl_hs')->where('hs_id', $request->id)->update(['hs_name'=>$request->name, 'hs_desc'=>$request->desc]);

    	return response("success");
    }
    
}
