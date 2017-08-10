<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class RecordController extends Controller
{
    public function create()
    {

     $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position')];
	    return view('admin.record', compact('return'));
    }

    public function show(){
    	
    	$records = DB::select('select c.case_id, GROUP_CONCAT(concat(r.resident_fname," ",r.resident_lname)," ") as name, p.personinvolve_type, k.caseskp_name, c.case_status from tbl_case c join tbl_personinvolve p on c.case_id = p.personinvolve_case join tbl_resident r on p.personinvolve_resident = r.resident_id join tbl_caseskp k on c.case_caseskp = k.caseskp_id where c.case_exists = 1 group by c.case_id, personinvolve_type');

    	return response()->json($records);

    }
}
