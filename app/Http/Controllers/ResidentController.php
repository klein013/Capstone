<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblResident;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;


class ResidentController extends Controller
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
        $streets = DB::select("select street_id, street_name, area_name from tbl_street join tbl_area on tbl_street.street_area=tbl_area.area_id order by area_name,street_name");
        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

        return view('admin.resident')->with(['streets'=>$streets, 'return'=>$return]);
    }

    public function getResidents()
    {
        $resident = DB::select("select resident_id, resident_fname, resident_lname, resident_image, resident_hno, street_name, area_name from tbl_resident join tbl_street on tbl_resident.resident_street=tbl_street.street_id join tbl_area on tbl_street.street_area=tbl_area.area_id where resident_exists = 1 and resident_id != '0' and resident_non = 0 order by resident_id asc");

        return response()->json($resident);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $ifexists = DB::select('select * from tbl_resident where resident_contact = "'.$request->contact.'" and resident_exists=1');

        if(empty($ifexists[0]->resident_id)){
        $residents = new TblResident;

        if(!$request->hasFile('file')){
            $residents->resident_image = 'uploads/human.png';
        }
        else{

            try{
                $file = $request->file('file');
                $file->move('uploads', $file->getClientOriginalName());
                $residents->resident_image = 'uploads/'.$file->getClientOriginalName();
            }catch(\Exception $e){
                return response("exceed");
            }
        }

        $residents->resident_fname = $request->fname;
        $residents->resident_mname = $request->mname;
        $residents->resident_lname = $request->lname;
        $residents->resident_bdate = $request->bdate;
        $residents->resident_hno = $request->house;
        $residents->resident_street = $request->street;
        $residents->resident_gender = $request->gender;
        $residents->resident_exists = 1;
        $residents->resident_allowmessage = $request->allow;
        $residents->resident_yearstayed = $request->year;
        $residents->resident_contact = $request->contact;
        $residents->resident_non = 0;

        $residents->save();

        return response("success");
        }
        else{
            return response("Contact Number already used");
        }
    }

    public function update(Request $request){

         $ifexists = DB::select('select * from tbl_resident where resident_contact = "'.$request->contact.'" and resident_exists=1 and resident_id != "'.$request->id.'"');

        if(empty($ifexists[0]->resident_id)){
            
            $image="";
            if(!$request->hasFile('file')){
                $image = 'uploads/human.png';
            }
            else{
                try{
                    $file = $request->file('file');
                    $file->move('uploads', $file->getClientOriginalName());
                    $image = 'uploads/'.$file->getClientOriginalName();
                }catch(\Exception $e){
                    return response("exceed");
                }
            }

            DB::table('tbl_resident')->where('resident_id', $request->id)->update(['resident_fname'=>$request->fname, 'resident_mname'=>$request->mname, 'resident_lname'=>$request->lname, 'resident_bdate'=>$request->bdate, 'resident_contact'=>$request->contact, 'resident_hno'=>$request->house, 'resident_street'=>$request->street, 'resident_gender'=>$request->gender, 'resident_yearstayed'=>$request->year, 'resident_yearstayed'=>$request->year, 'resident_allowmessage'=>$request->allow, 'resident_image'=>$image]);

            

            $ifofficial = DB::select('select concat(r.resident_fname," ",r.resident_lname) as name, r.resident_image, p.position_id, o.official_id, u.official_admin from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_officialuser u on o.official_id = u.official_id join tbl_position p on p.position_id = o.position_id where o.official_id = '.Session::get('official'));

            if(!empty($ifofficial[0]->name)){
                session(['position'=>$ifofficial[0]->position_id]);
                session(['name'=> $ifofficial[0]->name]);
                session(['image'=> $ifofficial[0]->resident_image]);
                session(['official'=> $ifofficial[0]->official_id]);
                session(['admin'=> $ifofficial[0]->official_admin]);
            }
    
            return response()->json($ifofficial);
        }
        else{
            return response("Contact Number already used");
        }

    }

    public function showrecord($id){

        $resident = DB::select('select * from tbl_resident r join tbl_street s on r.resident_street = s.street_id where resident_id = "'.$id.'"');

        return response()->json($resident);
    }

    public function destroy(Request $request)
    {
        DB::table('tbl_resident')->where('resident_id',$request->id)->update(['resident_exists' => 0]);
        return response("success");
    }

    public function nonres(Request $request){

        $ifexists = DB::select('select * from tbl_resident where resident_contact = "'.$request->contact.'" and resident_exists=1');


        if(empty($ifexists[0]->resident_id)){
            $residents = new TblResident;
        $residents->resident_fname = $request->fname;
        $residents->resident_mname = $request->mname;
        $residents->resident_lname = $request->lname;
        $residents->resident_bdate = $request->bdate;
        $residents->resident_hno = $request->address;
        $residents->resident_street = null;
        $residents->resident_gender = $request->gender;
        $residents->resident_exists = 1;
        $residents->resident_allowmessage = null;
        $residents->resident_yearstayed = null;
        $residents->resident_contact = $request->contact;
        $residents->resident_non = 1;

        $residents->save();

        $check = DB::select('select lpad(id, 8, "0") as resident_id from tbl_resident_seq order by id desc limit 1');

        $residents->resident_id = "RES".$check[0]->resident_id;

        return response()->json($residents);
        }
        else{
            return response("Contact Number already used");
        }   
    }
}
