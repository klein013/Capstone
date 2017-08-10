<?php

namespace App\Http\Controllers;

use App\Models\TblPosition;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Log;


class PositionController extends Controller
{
    public function getPositions(){
        $pos = DB::select('select * from tbl_position');

        return response()->json($pos);
    }

    public function create()
    {
        return view('admin.maintenance_pos');
    }

    public function store(Request $request)
    {

        $pos = DB::select('select position_id from tbl_position where LOWER(position_name) = "'.$request->name.'"');

        if(empty($pos[0]->Pos_ID)){
            $position = new TblPosition;

            $position->position_name = $request->name;
            $position->position_desc = $request->desc;
            $position->position_count = $request->count;
            $position->position_manage = $request->manage;           
            $position->save();

           return response()->json($position);
        }
        else{
            return response()->json();
        }
        
    }

    public function getdetails($id){

        $det = DB::select('select p.position_name as position_name, p.position_desc as position_desc, p.position_manage as position_manage, p.position_count as position_count, count(o.position_id) as Off_Count from tbl_position p join tbl_official o on p.position_id = o.position_id where p.position_id = '.$id.' and o.official_exists = 1 group by 1,2, 3, 4');

        if(!empty($det[0])){
           return response()->json($det);
        }
        else{
            $det = DB::select('select position_name as position_name, position_desc as position_desc, position_manage as position_manage, position_count as position_count, 0 as Off_Count from tbl_position where position_id = '.$id.'');            
            return response()->json($det);
        }
    }

    public function destroy(Request $id)
    {
        $off = DB::select('select official_id from tbl_official where position_id = '.$id->id.' and official_exists = 1');

        if(!empty($off)){
            return "exists";
        }
        else{
            $position = TblPosition::findOrFail($id->id);
            $position->delete();
            return "success";
        }
    }

    public function update(Request $request){

        DB::table('tbl_position')->where('position_id',$request->id)->update(['position_name' => $request->name, 'position_desc' => $request->desc, 'position_count' => $request->count, 'position_manage' => $request->manage]);

        return response()->json(null);
    }
}
