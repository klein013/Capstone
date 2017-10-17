<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblBrgyinfo;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;
use Exception;

class InfoController extends Controller
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
        $info = DB::table('tbl_brgyinfo')->first();
          $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];
        return view('admin.maintenance_info')->with(['info'=>$info,'return'=>$return]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        try{
            if(!empty($request->file('cityfile'))){
                $cityfile = $request->file('cityfile');
                $cityfile->move('uploads', $cityfile->getClientOriginalName());
                $city = 'uploads/'.$cityfile->getClientOriginalName();

                DB::table('tbl_brgyinfo')->update(['brgyinfo_citylogo'=>$city]);
            }
            if(!empty($request->file('brgyfile'))){
                $brgyfile = $request->file('brgyfile');
                $brgyfile->move('uploads', $brgyfile->getClientOriginalName());
                $brgy = 'uploads/'.$brgyfile->getClientOriginalName();

                DB::table('tbl_brgyinfo')->update(['brgyinfo_logo'=>$brgy]);
            }   

            DB::table('tbl_brgyinfo')->update(['brgyinfo_name'=>$request->name, 'brgyinfo_email'=>$request->email, 'brgyinfo_city'=>$request->city, 'brgyinfo_region'=>$request->region, 'brgyinfo_website'=>$request->web, 'brgyinfo_fb'=>$request->fb]);

            return response("success");
        }catch(Exception $e){
            return response("file exceed");
        }
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
    public function destroy($id)
    {
        //
    }
}
