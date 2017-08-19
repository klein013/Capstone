<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblClearance;
use App\Models\TblPrice;
use App\Models\TblClearancerequirement;
use Session;

class ClearanceController extends Controller
{

    public function create()
    {
        $reqs = DB::select('select requirement_id, requirement_name from tbl_requirement where requirement_exists=1');
          $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];
        
        return view('admin.maintenance_clearance')->with(['reqs'=>$reqs,'return'=>$return]);
    }

    public function update(Request $request)
    {


        $exists = DB::select('select clearance_id from tbl_clearance where LOWER(Clearance_Type) = LOWER("'.$request->name.'") and clearance_exists = 1');
        if(empty($exist)){

            $priceexists = DB::select('select price_id from tbl_price where price_amt = '.$request->price);
            if(empty($priceexists[0]->price_id)){

                $price = new TblPrice;

                $price->price_amt = $request->price;
                $price->price_date = date('Y-m-d');
                $price->save();

                DB::table('tbl_clearance')->where('clearance_id',$request->id)->update(['clearance_type'=>$request->name,'clearance_desc'=>$request->desc, 'clearance_price'=>$price->price_id]);

                if($request->req!=null){

                    DB::delete('delete from tbl_clearancerequirement where cr_clearance = '.$request->id);

                    $reqs = explode(',',$request->req);

                    foreach($reqs as $req){
                        $insert = new TblClearancerequirement;

                        $insert->cr_requirement = $req;
                        $insert->cr_clearance = $clearance->clearance_id;
                        $insert->save();
                    }

                     

                }
                else{

                     DB::delete('delete from tbl_clearancerequirement where cr_clearance = '.$request->id);
                    
                }

               
            }
            else{

               DB::table('tbl_clearance')->where('clearance_id',$request->id)->update(['clearance_type'=>$request->name,'clearance_desc'=>$request->desc, 'clearance_price'=>$priceexists[0]->price_id]);

                if($request->req!=null){

                    DB::delete('delete from tbl_clearancerequirement where cr_clearance = '.$request->id);

                    $reqs = explode(',',$request->req);

                    foreach($reqs as $req){
                        $insert = new TblClearancerequirement;

                        $insert->cr_requirement = $req;
                        $insert->cr_clearance = $request->id;
                        $insert->save();
                    }

                }
                else{

                    DB::delete('delete from tbl_clearancerequirement where cr_clearance = '.$request->id);

                }


                return response()->json("success");
            }
        }
        else{
            return response()->json(null);
        }
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
        $details = DB::select('select c.clearance_type, c.clearance_desc, group_concat(distinct(r.requirement_id) separator ",") as clearance_requirements, p.price_amt as clearance_price from tbl_clearance c join tbl_price p on p.price_id = c.clearance_price left join tbl_clearancerequirement cr on c.clearance_id = cr.cr_clearance left join tbl_requirement r on cr.cr_requirement = r.requirement_id where c.clearance_exists = 1 and c.clearance_id = '.$id.' group by c.clearance_id');

        return response()->json($details);
    }

    public function getClearances(){
        $clearances = DB::select('select c.clearance_id, c.clearance_type, group_concat(distinct(r.requirement_name) separator "<br>") as clearance_requirements, p.price_amt as clearance_price from tbl_clearance c join tbl_price p on p.price_id = c.clearance_price left join tbl_clearancerequirement cr on c.clearance_id = cr.cr_clearance left join tbl_requirement r on cr.cr_requirement = r.requirement_id where c.clearance_exists = 1 group by c.clearance_id');

        return response()->json($clearances);
    }

    public function add(Request $request){
        $exists = DB::select('select clearance_id from tbl_clearance where LOWER(Clearance_Type) = LOWER("'.$request->name.'") and clearance_exists = 1');
        if(empty($exist)){

            $priceexists = DB::select('select price_id from tbl_price where price_amt = '.$request->price);
            if(empty($priceexists[0]->price_id)){

                $price = new TblPrice;

                $price->price_amt = $request->price;
                $price->price_date = date('Y-m-d');
                $price->save();

                $clearance = new TblClearance;

                $clearance->clearance_type = $request->name;
                $clearance->clearance_desc = $request->desc;
                $clearance->clearance_price = $price->id;
                $clearance->clearance_content = $request->cont;
                $clearance->clearance_exists = 1;
                $clearance->save();

                if($request->req!=null){
                    $reqs = explode(',',$request->req);

                    foreach($reqs as $req){
                        $insert = new TblClearancerequirement;

                        $insert->cr_requirement = $req;
                        $insert->cr_clearance = $clearance->clearance_id;
                        $insert->save();
                    }

                     $clearances = DB::select('select c.clearance_id, c.clearance_type, group_concat(r.requirement_name separator "<br>") as clearance_requirements, p.price_amt as clearance_price from tbl_clearance c join tbl_price p on p.price_id = c.clearance_price join tbl_clearancerequirement cr on c.clearance_id = cr.cr_clearance join tbl_requirement r on cr.cr_requirement = r.requirement_id where cr.cr_clearance = '.$clearance->clearance_id.' group by c.clearance_id');

                }
                else{
                    $clearances = DB::select('select c.clearance_id, c.clearance_type, null as clearance_requirements, p.price_amt as clearance_price from tbl_clearance c join tbl_price p on p.price_id = c.clearance_price where c.clearance_id = '.$clearance->clearance_id.' and c.clearance_id not in(select cr_clearance from tbl_clearancerequirement) group by c.clearance_id');
                }

               

                return response()->json($clearances);
            }
            else{

                $clearance = new TblClearance;

                $clearance->clearance_type = $request->name;
                $clearance->clearance_desc = $request->desc;
                $clearance->clearance_price = $priceexists[0]->price_id;
                $clearance->clearance_content = $request->cont;
                $clearance->clearance_exists = 1;
                $clearance->save();

                if($request->req!=null){
                    $reqs = explode(',',$request->req);

                    foreach($reqs as $req){
                        $insert = new TblClearancerequirement;

                        $insert->cr_requirement = $req;
                        $insert->cr_clearance = $clearance->clearance_id;
                        $insert->save();
                    }

                      $clearances = DB::select('select c.clearance_id, c.clearance_type, group_concat(r.requirement_name separator "<br>") as clearance_requirements, p.price_amt as clearance_price from tbl_clearance c join tbl_price p on p.price_id = c.clearance_price join tbl_clearancerequirement cr on c.clearance_id = cr.cr_clearance join tbl_requirement r on cr.cr_requirement = r.requirement_id where cr.cr_clearance = '.$clearance->clearance_id.' group by c.clearance_id');

                }
                else{
                    $clearances = DB::select('select c.clearance_id, c.clearance_type, null as clearance_requirements, p.price_amt as clearance_price from tbl_clearance c join tbl_price p on p.price_id = c.clearance_price where c.clearance_id = '.$clearance->clearance_id.' and c.clearance_id not in(select cr_clearance from tbl_clearancerequirement) group by c.clearance_id');
                }


                return response()->json($clearances);
            }
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
