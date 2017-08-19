<?php

namespace App\Http\Controllers;

use DB;
use App\Models\TblRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;

class ClearanceReqController extends Controller
{
 
    public function create(){

        $clearance = DB::select('select clearance_id, clearance_type from tbl_clearance where clearance_exists = 1');

        // $requirements = DB::select('')

        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];
        return view('admin.clearance')->with(array('clearances'=>$clearance, 'return'=>$return));
    }

    public function getResidents($id){

        $residents = DB::select('select r.resident_id as resident_id, concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, r.resident_bdate, concat(r.resident_hno," ",s.street_name," ",a.area_name) as address, coalesce(r.resident_contact,"") as contact from tbl_resident r join tbl_street s on r.resident_street = s.street_id join tbl_area a on a.area_id = s.street_area where r.resident_exists = 1 and r.resident_id != "'.$id.'"' );

        return response()->json($residents);
    }

    public function storeClearance(Request $request){

        $req = new TblRequest;

        $req->request_resident = $request->resID;
        $req->request_clearance = $request->ctype;
        $req->request_purpose = $request->purpose;
        $req->request_date = date('Y-m-d');
        $req->request_expiry = date('Y-m-d', strtotime('+1 years'));
        $req->request_status = "Request Made";
        $req->save();

        $return = DB::select('select lpad(r.request_id,8,"0") as request_id, c.clearance_type, r.request_purpose, concat(t.resident_fname," ",coalesce(t.resident_mname,"")," ",t.resident_lname) as name, r.request_statuse from tbl_request r join tbl_resident t on r.request_resident = t.resident_id join tbl_clearance c on c.clearance_id = r.request_clearance where r.request_id = '.$req->request_id);

        return response()->json($$return);
    }
}
