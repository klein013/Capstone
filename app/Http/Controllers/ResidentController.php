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
        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position')];

        return view('admin.resident')->with(['streets'=>$streets, 'return'=>$return]);
    }

    public function getResidents()
    {
        $resident = DB::select("select resident_id, resident_fname, resident_lname, resident_image, resident_hno, street_name, area_name from tbl_resident join tbl_street on tbl_resident.resident_street=tbl_street.street_id join tbl_area on tbl_street.street_area=tbl_area.area_id");

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
        $residents->resident_yearstayed = $request->year;
        $residents->resident_contact = $request->contact;

        $residents->save();

        $resident = DB::select("select r.resident_id, r.resident_image,r.resident_gender, r.resident_fname, r.resident_lname, r.resident_bdate, r.resident_bdate, concat(r.resident_hno,'',s.street_name,' ',a.area_name) as resident_add from tbl_resident r join tbl_street s on s.street_id = r.resident_street join tbl_area a on a.area_id = s.street_area where r.resident_id = ".$residents->resident_id);

        return response()->json($resident);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $resident = TblResident::findOrFail($id);
        $resident->delete();

        return null;
    }
}
