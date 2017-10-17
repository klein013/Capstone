<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblOfficial;
use App\Models\TblResident;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Session;
use File;
use Exception;

class OfficialController extends Controller
{
    
    public function update(Request $request)
    {
        $contact = DB::select('select r.resident_id from tbl_resident r join tbl_official o on o.resident_id = r.resident_id where r.resident_contact = "'.$request->contact.'" and o.official_id != '.$request->id);

        if(empty($contact[0]->resident_id)){


        $resid = DB::select('select resident_id from tbl_official where official_id = '.$request->id);

        

        if(empty($request->file('file'))){

          
          DB::table('tbl_resident')->where('resident_id',$resid[0]->resident_id)->update(['resident_mname'=>$request->mname, 'resident_lname'=>$request->lname, 'resident_contact'=>$request->contact, 'resident_yearstayed'=>$request->year, 'resident_hno'=>$request->house, 'resident_street'=>$request->street]);   
        }
        else{

            try{
            $file = $request->file('file');
            $file->move('uploads', $file->getClientOriginalName());
            $official = 'uploads/'.$file->getClientOriginalName();
        

            DB::table('tbl_resident')->where('resident_id',$resid[0]->resident_id)->update(['resident_mname'=>$request->mname, 'resident_lname'=>$request->lname, 'resident_contact'=>$request->contact, 'resident_yearstayed'=>$request->year, 'resident_hno'=>$request->house, 'resident_street'=>$request->street, 'resident_image'=>$official]);
        }catch(Exception $e){
            return response("file exceed");
        }
       
        }

            DB::table('tbl_official')->where('official_id',$request->id)->update(['position_id'=>$request->pos]);


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
            return response("failed");
        }
    }

    public function create()
    {
        $streets = DB::select('select street_id, street_name, area_name from tbl_street join tbl_area on tbl_street.street_area=tbl_area.area_id order by area_name,street_name');

        $positions = DB::select("select position_id as 'Pos_ID', position_name as 'Pos_Name' from tbl_position where position_id not in(select p.position_id from tbl_position p left join tbl_official o on p.position_id=o.position_id where o.official_exists = 1 group by p.position_id, p.position_name, p.position_count having p.position_count = COUNT(o.position_id))");

        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

        return view('admin.maintenance_official')->with(array('positions'=>$positions, 'streets'=>$streets,'return'=>$return));
    }

    public function store(Request $request)
    {
        $contact = DB::select("select resident_id from tbl_resident where resident_contact = '".$request->contact."' and resident_exists = 1");

        if(empty($contact)){
        $resident = new TblResident;

        if(!$request->hasFile('file')){
            $resident->resident_image = 'uploads/human.png';
        }
        else{
            try{
                $file = $request->file('file');
                $file->move('uploads', $file->getClientOriginalName());
                $resident->resident_image = 'uploads/'.$file->getClientOriginalName();
            }catch(\Exception $e){
                return response("exceed");
            }
        }

        $resident->resident_fname = $request->fname;
        $resident->resident_mname = $request->mname;
        $resident->resident_lname = $request->lname;
        $resident->resident_bdate = $request->bdate;
        $resident->resident_hno = $request->house;
        $resident->resident_street = $request->street;
        $resident->resident_gender = $request->gender;
        $resident->resident_exists = 1;
        $resident->resident_yearstayed = $request->year;
        $resident->resident_contact = $request->contact;
        $resident->resident_allowmessage= 1;

        $resident->save();

        $resid = DB::select('select resident_id from tbl_resident order by resident_id desc limit 1 ');

        $official = new TblOfficial;

        $official->resident_id = $resid[0]->resident_id;
        $official->position_id = $request->pos;
        $official->official_exists = 1;

        $official->save();


        $official1 = DB::select('select o.official_id as Off_ID, r.resident_image as Off_Image, r.resident_fname as Off_Fname, r.resident_mname as Off_Mname, r.resident_lname as Off_Lname, r.resident_bdate as Off_Bdate, r.resident_hno as Off_House, s.street_name as Off_Street, a.area_name as Off_Area from tbl_official o join tbl_resident r on o.resident_id = r.resident_id join tbl_street s on s.street_id = r.resident_street join tbl_area a on a.area_id = s.street_area where r.resident_id = "'.$resid[0]->resident_id.'"');

        $return['official'] = $official1;

//         $check = DB::select('se')

        $positions = DB::select("select position_id as 'Pos_ID', position_name as 'Pos_Name' from tbl_position where position_id not in(select p.position_id from tbl_position p left join tbl_official o on p.position_id=o.position_id where o.official_exists = 1 group by p.position_id, p.position_name, p.position_count having p.position_count = COUNT(o.position_id))");
        $return['position'] = $positions;

        return response()->json($return);
    }
        else{
            return response()->json(null);
        }
    }

    public function getdetails($id){
        $details = DB::select('select r.resident_fname as Off_Fname, r.resident_mname as Off_Mname, r.resident_lname as Off_Lname, r.resident_image as Off_Image, r.resident_bdate as Off_Bdate, r.resident_contact as Off_Contact, r.resident_gender as Off_Sex, r.resident_hno as Off_House, s.street_id as Off_Street, r.resident_yearstayed as Off_Year, p.position_name as Pos_Name, p.position_id as Pos_ID from tbl_official o join tbl_position p on o.position_id = p.position_id join tbl_resident r on r.resident_id = o.resident_id join tbl_street s on s.street_id = r.resident_street where o.official_id = '.$id);

        return response()->json($details);
    }

    public function destroy($id)
    {
        DB::table('tbl_official')->where('official_id',$id)->update(['official_exists' => 0]);
        
        DB::table('tbl_officialuser')->where('official_id','=',$id)->delete();
        return response("success");
    }

    public function getOfficials(){
        $officials = DB::select("select lpad(o.official_id,6,'0') as official_id, r.resident_image,p.position_name, concat(r.resident_fname,' ',coalesce(r.resident_mname,''),' ',r.resident_lname) as name, r.resident_bdate, r.resident_contact, r.resident_gender, concat(r.resident_hno,' ',s.street_name,' ',a.area_name) as street from tbl_official o join tbl_resident r on r.resident_id = o.resident_id join tbl_street s on r.resident_street = s.street_id join tbl_area a on s.street_area = a.area_id join tbl_position p on p.position_id = o.position_id where o.official_exists = 1 and o.official_id != 0 order by 1");
        return response()->json($officials);
    }
}
