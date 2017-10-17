<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\TblOfficialuser;

class AccessController extends Controller
{
    public function create(){

    	
    	$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

    	
    	return view('admin.maintenance_access')->with(['return'=>$return]);
    }

    public function showall(){
    	$officials = DB::select("select o.official_id, concat(r.resident_fname,' ',coalesce(r.resident_mname, ''),' ',r.resident_lname) as name, p.position_name, u.official_username, u.official_admin from tbl_official o join tbl_officialuser u on u.official_id = o.official_id join tbl_resident r on o.resident_id = r.resident_id join tbl_position p on p.position_id = o.position_id where o.official_id != 0 and o.official_exists = 1 order by 1");

    	return response()->json($officials);
    }

    public function update(Request $request){

    	foreach($request->checks as $check){

    		DB::table('tbl_officialuser')->where('official_id', $check[0])->update(['official_admin'=>$check[1]]);
    	}

    	return response("success");
    }
}
