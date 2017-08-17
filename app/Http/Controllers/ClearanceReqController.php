<?php

namespace App\Http\Controllers;

use DB;
use App\Models\TblClearancereq;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;

class ClearanceReqController extends Controller
{
 
    public function create(){

        $clearance = DB::select('select clearance_id, clearance_type from tbl_clearance where clearance_exists = 1');

        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];
        return view('admin.clearance')->with(array('clearances'=>$clearance, 'return'=>$return));
    }
}
