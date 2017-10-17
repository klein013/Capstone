<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblClearance;
use App\Models\TblPrice;
use App\Models\TblClearancerequirement;
use App\Models\TblClearancevalidity;
use App\Models\TblClearancecontent;
use Session;

class ClearanceController extends Controller
{

    public function create()
    {
        $reqs = DB::select('select requirement_id, requirement_name from tbl_requirement where requirement_exists=1');
          $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];
        
        return view('admin.maintenance_clearance')->with(['reqs'=>$reqs,'return'=>$return]);
    }

    public function update(Request $request)
    {
        $newdate = date('Y-m-d H:i:s');

        DB::table('tbl_clearance')->where('clearance_id',$request->id)->update(['updated_at'=>date('Y-m-d H:i:s'),'clearance_desc'=>$request->desc]);

        $validity = DB::select('select * from tbl_clearancevalidity where updated_at is null and clearance_id ='.$request->id);

        if(($validity[0]->validity_no!=$request->number)||($validity[0]->validity_unit!=$request->unit)){

            DB::table('tbl_clearancevalidity')->where('validity_id',$validity[0]->validity_id)->update(['updated_at'=>$newdate]);

           $newvalidity = new TblClearancevalidity;

           $newvalidity->clearance_id = $request->id;
           $newvalidity->validity_unit = $request->unit;
           $newvalidity->validity_no = $request->number;
           $newvalidity->updated_at = null;
           $newvalidity->save();
        }

        $content = DB::select('select * from tbl_clearancecontent where updated_at is null and clearance_id = '.$request->id);

        if(strcmp($content[0]->content,$request->cont)!=0){

            DB::table('tbl_clearancecontent')->where('content_id',$content[0]->content_id)->update(['updated_at'=>$newdate]);

            $newcontent = new TblClearancecontent;

            $newcontent->clearance_id = $request->id;
            $newcontent->content = $request->cont;
            $newcontent->updated_at = null;
            $newcontent->save();
        }

        $price = DB::select('select * from tbl_price where updated_at is null and clearance_id = '.$request->id);

        if($price[0]->price_amt!=$request->price){

            DB::table('tbl_price')->where('price_id',$price[0]->price_id)->update(['updated_at'=>$newdate]);

            $newprice = new TblPrice;

            $newprice->price_amt = $request->price;
            $newprice->clearance_id = $request->id;
            $newprice->updated_at = null;
            $newprice->save();

        }

        DB::delete('DELETE FROM tbl_clearancerequirement WHERE cr_clearance = '.$request->id);

        if($request->req!=null){

            $reqs = explode(',', $request->req);

            foreach($reqs as $req){
                $requirement = new TblClearancerequirement;

                    $requirement->cr_clearance = $request->id;
                    $requirement->cr_requirement = $req;
                    $requirement->save();
            }
        }

        return response()->json("success");

    }

    public function store(Request $request)
    {
        $clearance = new TblClearance;

        $clearance->Clearance_Type = $request->name;
        $clearance->Clearance_Desc = $request->desc;

        $clearance->save();

        return response()->json($clearance);
    }

    public function show($id)
    {
        $details = DB::select('select c.clearance_name as clearance_type, c.clearance_desc, group_concat(distinct(r.requirement_id) separator ",") as clearance_requirements, p.price_amt as clearance_price, v.validity_no,v.validity_unit, cc.content as clearance_content from tbl_clearance c join tbl_price p on p.clearance_id = c.clearance_id left join tbl_clearancerequirement cr on c.clearance_id = cr.cr_clearance left join tbl_requirement r on cr.cr_requirement = r.requirement_id join tbl_clearancevalidity v on c.clearance_id = v.clearance_id join tbl_clearancecontent cc on cc.clearance_id = c.clearance_id where p.updated_at is null and cc.updated_at is null and v.updated_at is null and c.clearance_exists = 1 and c.clearance_id = '.$id.' group by c.clearance_id');

        return response()->json($details);
    }

    public function getClearances(){
        $clearances = DB::select('select distinct(c.clearance_id), c.clearance_name as clearance_type, group_concat(distinct(r.requirement_name) separator "<br>") as clearance_requirements, p.price_amt as clearance_price, concat(v.validity_no," ",v.validity_unit) as validity from tbl_clearance c join tbl_price p on p.clearance_id = c.clearance_id left join tbl_clearancerequirement cr on c.clearance_id = cr.cr_clearance left join tbl_requirement r on cr.cr_requirement = r.requirement_id join tbl_clearancevalidity v on c.clearance_id = v.clearance_id join tbl_clearancecontent cc on cc.clearance_id = c.clearance_id where c.clearance_exists = 1 and p.updated_at is null and cc.updated_at is null and v.updated_at is null group by c.clearance_id');

        return response()->json($clearances);
    }

    public function add(Request $request){
        
        $checkexist = DB::select('select * from tbl_clearance where clearance_name = "'.$request->name.'" and clearance_exists = 1');
        if(empty($checkexist[0])){

            $clearance = new TblClearance;

            $clearance->clearance_name = $request->name;
            $clearance->clearance_desc = $request->desc;
            $clearance->clearance_exists = 1;
            $clearance->updated_at = null;
            $clearance->save();
                
            if($request->req!=null){
                $reqs = explode(',', $request->req);

                foreach($reqs as $req){

                    $requirement = new TblClearancerequirement;

                    $requirement->cr_clearance = $clearance->clearance_id;
                    $requirement->cr_requirement = $req;
                    $requirement->save();

                }
            }

            $price = new TblPrice;

            $price->clearance_id = $clearance->clearance_id;
            $price->price_amt = $request->price;
            $price->updated_at = null;
            $price->save();

            $content = new TblClearancecontent;

            $content->clearance_id = $clearance->clearance_id;
            $content->content = $request->cont;
            $content->updated_at = null;
            $content->save();

            $validity = new TblClearancevalidity;

            $validity->clearance_id = $clearance->clearance_id;
            $validity->validity_no = $request->number;
            $validity->validity_unit = $request->unit;
            $validity->updated_at = null;
            $validity->save();

            return response()->json("Success");
        }
        else{
            return response()->json(null);
        }
    }

    public function delete($id){
        
        DB::delete('DELETE FROM tbl_clearancerequirement where cr_clearance = '.$id);
        DB::table('tbl_clearance')->where('clearance_id', $id)->update(['clearance_exists'=>0]);

        return null;
    }
}
