<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblIncident;
use Session;

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
        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position')];
        return view('admin.incident', compact('return'));
    }

    public function createMap(){
        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position')];
        return view('admin.incident_mapping', compact('return'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inc = new TblIncident;

        $inc->Incident_House = $request->house;
        $inc->Incident_Street = $request->street;
        $inc->Incident_Area = $request->area;
        $inc->Incident_Datetime = date('Y-m-d h:m:s');
        $inc->Incident_Statement = $request->desc;
        $inc->Incident_Lat ="";
        $inc->Incident_Long ="";
        $inc->Incident_Type ="";
        $inc->Incident_Brgy =null;
        $inc->Incident_Status = "Pending";

        $inc->save();

        return response()->json($inc);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         DB::table('tbl_incident')->where('Incident_ID',$request->id)->update(['Incident_Status' => $request->stat]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $todel = TblIncident::findOrFail($id);
        $todel->delete();
        return "success";
    }

    public function getstat($id){
        $stat = DB::select('select Incident_Status from tbl_incident where Incident_ID = '.$id);

        return response()->json($stat);
    }
}
