<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class MapController extends Controller
{

	public function createMap(){
		$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];

	

		$incidentcats = DB::select('select incidentcat_id, incidentcat_name from tbl_incidentcat where incidentcat_exists = 1');

        return view('admin.incident_mapping')->with(array('return'=>$return, 'incidentcats'=>$incidentcats));
	}
    
	public function getIncidentLoc(Request $request){

		$locs = DB::select('select lpad(i.incident_id,8,"0") as incident_id, c.incidentcat_name, concat(s.street_name," ",a.area_name) as place, i.incident_datetime, i.incident_status, coalesce(i.incident_notes,"") as incident_notes, i.incident_lat, i.incident_long from tbl_incident i join tbl_incidentcat c on i.incident_cat = c.incidentcat_id join tbl_street s on s.street_id = i.incident_street join tbl_area a on a.area_id = s.street_area where DATE(i.incident_datetime) between "'.$request->fdate.'" AND "'.$request->tdate.'" and c.incidentcat_id in ('.$request->incidentcat.') and i.incident_exists = 1');

		return response()->json($locs);
	}

}