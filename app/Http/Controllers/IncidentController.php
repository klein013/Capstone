<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblIncident;
use Session;
use App\Jobs\SendMessages;
use Carbon;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidents = DB::select("Select Incident_ID, concat(Incident_House,' ',Incident_Street,' ',Incident_Area) as Place, Incident_Datetime, Incident_Statement, Incident_Status from tbl_incident;");

        return response()->json($incidents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createIncident()
    {
        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];

        $street = DB::select('select s.street_name, s.street_id, a.area_id from tbl_street s join tbl_area a on a.area_id = s.street_area where a.area_exists = 1 and s.street_exists = 1;');

        $areas = DB::select('select area_id, area_name from tbl_area where area_exists = 1');

        $incidentcats = DB::select('select incidentcat_id, incidentcat_name from tbl_incidentcat where incidentcat_exists = 1');

        return view('admin.incident')->with(array('streets'=>$street,'return'=>$return,'areas'=>$areas, 'incidentcats'=>$incidentcats));
    }

    public function storeIncident(Request $request)
    {
        $address = $request->street_name.",Payatas,Quezon City,Philippines"; // Google HQ
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&key=AIzaSyAf9S1qa_pd7y1WTlfK86ROGs05RXM3Qaw');
        $output= json_decode($geocode);
        if($output->status=="OK"){
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;
        }
        else{
            $latitude = null;
            $longitude = null;
        }


        $inc = new TblIncident;

        $inc->incident_datetime = $request->datetime;
        $inc->incident_street = $request->street_id;
        $inc->incident_statement = $request->desc;
        $inc->incident_lat = $latitude;
        $inc->incident_long = $longitude;
        $inc->incident_status = "On-going";
        $inc->incident_cat = $request->cat;
        $inc->incident_exists = 1;

        $inc->save();

        $incidents = DB::select('select lpad(i.incident_id,8,"0") as incident_id, concat(s.street_name," ",a.area_name) as place, i.incident_datetime, c.incidentcat_name, i.incident_status, coalesce(i.incident_notes," ") as incident_notes from tbl_incident i join tbl_incidentcat c on c.incidentcat_id = i.incident_cat join tbl_street s on s.street_id = i.incident_street join tbl_area a on s.street_area = a.area_id where i.incident_exists = 1 and i.incident_id = '.$inc->incident_id);

        return response()->json($incidents);
    }

    public function sendMessages(Request $request){
        $numbers = DB::select('select resident_contact from tbl_resident where resident_exists = 1 and resident_contact is not null and resident_allowmessage = 1');
        $job = (new SendMessages(["numbers" => $numbers, "incident" => $request->incident]))->delay(Carbon::now()->addMinutes(1));

        dispatch($job);

        return response("success");

    }

    public function getIncident(){

        $incidents = DB::select('select lpad(i.incident_id,8,"0") as incident_id, concat(s.street_name,", ",a.area_name) as place, i.incident_datetime, c.incidentcat_name, i.incident_status, i.incident_notes from tbl_incident i join tbl_incidentcat c on c.incidentcat_id = i.incident_cat join tbl_street s on s.street_id = i.incident_street join tbl_area a on s.street_area = a.area_id where i.incident_exists = 1 order by field(i.incident_status,"Pending","On-going","Done")');

       return response()->json($incidents);
    }

    public function deleteIncident(Request $request){

        DB::table('tbl_incident')->where('incident_id',$request->id)->update(['incident_exists' => 0]);
        return response("success");
    }

    public function count(){

        $count = DB::select('select count(*) as count from tbl_incident where incident_exists = 1');
        return response($count[0]->count);
    }
}
