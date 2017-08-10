<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblPersoninvolve;
use App\Models\TblCase;
use Response;
use Session;

class ComplaintController extends Controller
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
        $cases = DB::select("select caseskp_id, caseskp_name from tbl_caseskp where caseskp_exists = 1 order by caseskp_name");
        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position')];

        return view('admin.complaint')->with(['cases'=>$cases, 'return'=>$return]);
    }

   public function com(Request $req){
      if(!empty($req->used)){
        $com = DB::select('select r.resident_id, concat(r.resident_fname," ",r.resident_lname) as name, r.resident_bdate, concat(r.resident_hno," ",s.street_name," Street ",a.area_name) as address from tbl_resident r join tbl_street s on r.resident_street = s.street_id join tbl_area a on a.area_id = s.street_area where r.resident_id not in('.$req->used.') and r.resident_exists = 1');

        return response()->json($com);
      }
      else{
        $com = DB::select('select r.resident_id, concat(r.resident_fname," ",r.resident_lname) as name, r.resident_bdate, concat(r.resident_hno," ",s.street_name," Street ",a.area_name) as address from tbl_resident r join tbl_street s on r.resident_street = s.street_id join tbl_area a on a.area_id = s.street_area where r.resident_exists = 1');

        return response()->json($com);
      }
   }

   public function process(Request $request){

      if($request->turnover=="Lupon"){

        $info = DB::select('select brgyinfo_case from tbl_brgyinfo limit 1');

        $case = new TblCase();

        $case->case_caseskp = $request->case;
        $case->case_statement = $request->statement;
        $case->case_status = $info->brgyinfo_case;
        $case->case_exists = 1;

        $case->save();

        $res = explode(",", $request->res);

        foreach($res as $res1){
          $resp = new TblPersoninvolve();

          $resp->personinvolve_resident = $res1;
          $resp->personinvolve_case = $case->case_id;
          $resp->personinvolve_type = 'R';
          $resp->save();

        }

        $com = explode(",", $request->com);

        foreach($com as $com1){
          $comp = new TblPersoninvolve();

          $comp->personinvolve_resident = $com1;
          $comp->personinvolve_case = $case->case_id;
          $comp->personinvolve_type = 'C';
          $comp->save();
        
        }
      }

        return response("success");

        /*$involvenames = DB::select('select r.resident_mname, r.resident_lname, r.resident_street from tbl_resident r join tbl_personinvolve p on p.personinvolve_resident = r.resident_id join tbl_case c on c.case_id = p.personinvolve_case where c.case_id = '.$case->case_id);

        $mnames = "";
        $lnames = "";
        $street = "";

        if(!empty($involvenames->resident_mname)){
          foreach ($involvenames->resident_mname as $name) {
            $mnames += '"'.$name.'",';
          }
          substr($mnames, 0, -1);
        }
        else{
          $mnames = '""';
        }

        if(!empty($involvenames->resident_lname)){
          foreach ($involvenames->resident_lname as $name) {
            $lnames += '"'.$name.'",';
          }
          substr($lnames, 0, -1);
        }
        else{
          $lnames = '""';
        }

        if(!empty($involvenames->resident_street)){
          foreach ($involvenames->resident_street as $name) {
            $street += '"'.$name.'",';
          }
          substr($street, 0, -1);
        }
        else{
          $street = '""';
        }

        
        if($info->brgyinfo_case=="Lupon"){
          $luponid = DB::select('select position_id from tbl_position where position_name = "Lupon"');
          $lupon = DB::select('select o.official_id, concat(r.resident_fname," ",r.resident_mname," ",r.resident_lname) as name, r.resident_street from tbl_official o join tbl_resident r on r.resident_id = o.resident_id where o.position_id = '.$luponid->position_id. ' and o.official_exists = 1 and r.resident_mname in ('.$mnames.') or r.resident_lname not in ('.$lnames.') or r.resident_street not in ('.$street.') ');
          if(!empty($lupon)){
            $leastlupon = DB::select('select count()')
          }
          else{
            
          }
        }
        else{

        }

        return response("success");
      }
      else if($request->turnover=="PS6"){

      }
      else if($reques->turnover=="VAWC"){

      }
      else{

      }*/
   }

}
