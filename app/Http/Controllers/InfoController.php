<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblBrgyinfo;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;

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
          $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];

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
        $info = new TblBrgyinfo;
        if(!$request->hasFile('file')){
            $info->BrgyInfo_Image = "";
        }
        else{
            $file = $request->file('file');
            $file->move('uploads', $file->getClientOriginalName());
            $info->BrgyInfo_Image = "uploads/".$file->getClientOriginalName();
        }
        $info->BrgyInfo_Name = $request->input('name');
        $info->BrgyInfo_Web = $request->input('web');
        $info->BrgyInfo_Email = $request->input('email');

        $info->save();

        return view('admin.maintenance_info', '@InfoController/create');
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
