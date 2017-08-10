<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AccessController extends Controller
{
    public function create(){

    	$officials = DB::select("SELECT tbl_off.Off_ID as ID, concat(tbl_off.Off_Fname,' ',tbl_off.Off_Lname) as Name, tbl_pos.Pos_Name as Pos, tbl_off.Off_Access as Access from tbl_off JOIN tbl_pos on tbl_off.Off_Pos = tbl_pos.Pos_ID where tbl_off.Off_Delete = 0 order by tbl_off.Off_ID");
    	
    	return view('admin.maintenance_access', compact('officials'));
    }
}
