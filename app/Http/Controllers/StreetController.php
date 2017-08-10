<?php

namespace App\Http\Controllers;

use App\Models\TblStreet;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;

class StreetController extends Controller
{
    public function create(){

        $areas = DB::select('select area_id, area_name from tbl_area where area_exists=1');

        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position')];
    	return view('admin.maintenance_street')->with(['areas'=>$areas,'return'=>$return]);
    } 

    public function store(Request $request){

        $check = DB::select('select street_id from tbl_street where lower(street_name) = lower("'.$request->name.'") and street_area = '.$request->area);
        if(!empty($check[0])){
           return response("exists");
        }
        else{
            $street = new TblStreet;
            $street->street_name = $request->name;
            $street->street_area = $request->area;
            $street->street_exists = 1;

            $street->save();

            $streetreturn = DB::select('select street_id, street_name, area_name from tbl_street s join tbl_area a on s.street_area=a.area_id where s.street_exists = 1 and s.street_id = '.$street->street_id);
        
            return response()->json($streetreturn);
        }
    	
    }

    public function getStreets(){

    	$streets = DB::select('select street_id, street_name, area_name from tbl_street s join tbl_area a on s.street_area=a.area_id where s.street_exists = 1');
    	

    	return response()->json($streets);
    }

    public function destroy(Request $request){

        DB::table('tbl_street')->where('street_id',$request->id)->update(['street_exists'=>0]);

        return response("success");
    }

    public function getdetails($id){

        $street = DB::select('select street_id, street_name, street_area from tbl_street where street_id = '.$id );

        return response()->json($street);

    }

    public function update(Request $request){

        $check = DB::select('select street_id from tbl_street where lower(street_name) = lower("'.$request->name.'") and street_area = '.$request->area);
        if(!empty($check[0])){
           return response("exists");
        }
        else{
            DB::table('tbl_street')->where('street_id',$request->id)->update(['street_name'=>$request->name,'street_area'=>$request->area]);

            return response("success");
        }
    }
}
 