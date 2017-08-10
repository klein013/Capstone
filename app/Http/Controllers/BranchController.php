<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblBranch;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;

class BranchController extends Controller
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
        $branches = DB::table('tbl_branch')->get();

        return view('admin.maintenance_branches', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $brgy = DB::select('select BrgyInfo_Name from tbl_brgyinfo');

        $branch = new TblBranch;

        $branch->Branch_Name = $request->name;
        $branch->Branch_Address = $request->address;
        $branch->Branch_Contact = $request->contact;
        $branch->Branch_Brgy = $brgy[0]->BrgyInfo_Name;

        $branch->save();

        return response()->json($branch);
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
        $branch = TblBranch::find($id);
        $branch->delete();

        return null;
    }
}
