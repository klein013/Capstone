<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblResident;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;


class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $streets = DB::select("select street_id, street_name, area_name from tbl_street join tbl_area on tbl_street.street_area=tbl_area.area_id order by area_name,street_name");
        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];

        return view('admin.resident')->with(['streets'=>$streets, 'return'=>$return]);
    }

    public function getResidents()
    {
        $resident = DB::select("select resident_id, resident_fname, resident_lname, resident_image, resident_hno, street_name, area_name from tbl_resident join tbl_street on tbl_resident.resident_street=tbl_street.street_id join tbl_area on tbl_street.street_area=tbl_area.area_id where resident_exists = 1 and resident_id != '0' order by resident_id asc");

        return response()->json($resident);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $residents = new TblResident;

        if(!$request->hasFile('file')){
            $residents->resident_image = 'uploads/human.png';
        }
        else{
            $file = $request->file('file');
            $file->move('uploads', $file->getClientOriginalName());
            $residents->resident_image = 'uploads/'.$file->getClientOriginalName();
        }

        $residents->resident_fname = $request->fname;
        $residents->resident_mname = $request->mname;
        $residents->resident_lname = $request->lname;
        $residents->resident_bdate = $request->bdate;
        $residents->resident_hno = $request->house;
        $residents->resident_street = $request->street;
        $residents->resident_gender = $request->gender;
        $residents->resident_exists = 1;
        $residents->resident_allowmessage = $request->allow;
        $residents->resident_yearstayed = $request->year;
        $residents->resident_contact = $request->contact;

        $residents->save();

        return response("success");
    }

    public function destroy(Request $id)
    {
        DB::table('tbl_resident')->where('resident_id',$request->id)->update(['resident_exists' => 0]);
        return response("success");
    }
}
