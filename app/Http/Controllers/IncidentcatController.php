<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblIncidentcat;
use DB;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;


class IncidentcatController extends Controller
{
    public function create()
    {
          $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position')];
        return view('admin.maintenance_incidentcat', compact('return'));
    }

    public function store(Request $request)
    {

        $check = DB::select('select incidentcat_id from tbl_incidentcat where (lower(incidentcat_name) = lower("'.$request->name.'") and lower(incidentcat_desc) = lower("'.$request->desc.'")) and incidentcat_exists = 1');
        if(empty($check)){
            $cases = new TblIncidentcat;

            $cases->incidentcat_name = $request->name;
            $cases->incidentcat_desc = $request->desc;
            $cases->incidentcat_exists = 1;

            $cases->save();

            return response()->json($cases);
        }
        else{
            return response(null);
        }
    }
    
    public function getCases()
    {
        $det = DB::select('select incidentcat_id, incidentcat_name, incidentcat_desc from tbl_incidentcat where incidentcat_exists = 1');

        return response()->json($det);
    }

    public function getdetails($id){

        $det = DB::select('select incidentcat_id, incidentcat_name, incidentcat_desc from tbl_incidentcat where incidentcat_id = '.$id);

        return response()->json($det);
    }

    public function updated(Request $request)
    {
        $check = DB::select('select incidentcat_id from tbl_incidentcat where (lower(incidentcat_name) = lower("'.$request->name.'") and lower(incidentcat_desc) = lower("'.$request->desc.'")) and incidentcat_exists = 1 and incidentcat_id != '.$request->id);
        
        if(empty($check)){
            
            DB::table('tbl_incidentcat')->where('incidentcat_id', $request->id)->update(['incidentcat_name'=> $request->name, 'incidentcat_desc'=> $request->desc]);

        
            return response()->json("success");
        }
        else{

            return response()->json(null);

        }
    }

    public function destroy($id)
    {
        DB::table('tbl_incidentcat')->where('incidentcat_id',$id)->update(['incidentcat_exists' => 0]);

        return null;
    }
}
