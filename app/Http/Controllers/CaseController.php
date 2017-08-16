<?php

namespace App\Http\Controllers;
use App\Models\TblCaseskp;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;

class CaseController extends Controller
{

    public function create()
    {
          $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];
        return view('admin.maintenance_cases', compact('return'));
    }

    public function store(Request $request)
    {

        $check = DB::select('select caseskp_id from tbl_caseskp where (lower(caseskp_name) = lower("'.$request->name.'") and lower(caseskp_desc) = lower("'.$request->desc.'")) and caseskp_exists = 1');
        if(empty($check)){
            $cases = new TblCaseskp;

            $cases->caseskp_name = $request->name;
            $cases->caseskp_desc = $request->desc;
            $cases->caseskp_exists = 1;

            $cases->save();

            return response()->json($cases);
        }
        else{
            return response(null);
        }
    }
    
    public function getCases()
    {
        $det = DB::select('select caseskp_id, caseskp_name, caseskp_desc from tbl_caseskp where caseskp_exists = 1');

        return response()->json($det);
    }

    public function getdetails($id){

        $det = DB::select('select caseskp_id, caseskp_name, caseskp_desc from tbl_caseskp where caseskp_id = '.$id);

        return response()->json($det);
    }

    public function updated(Request $request)
    {
        $check = DB::select('select caseskp_id from tbl_caseskp where (lower(caseskp_name) = lower("'.$request->name.'") and lower(caseskp_desc) = lower("'.$request->desc.'")) and caseskp_exists = 1 and caseskp_id != '.$request->id);
        
        if(empty($check)){
            
            DB::table('tbl_caseskp')->where('caseskp_id', $request->id)->update(['caseskp_name'=> $request->name, 'caseskp_desc'=> $request->desc]);

        
            return response()->json("success");
        }
        else{

            return response()->json(null);

        }
    }

    public function destroy($id)
    {
        DB::table('tbl_caseskp')->where('caseskp_id',$id)->update(['caseskp_exists' => 0]);

        return null;
    }
}
