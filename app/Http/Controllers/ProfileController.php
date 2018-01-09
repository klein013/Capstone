<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class ProfileController extends Controller
{
    public function index()
    {
    	$profile = DB::select('select r.resident_fname, r.resident_mname, r.resident_lname, r.resident_bdate, r.resident_gender, r.resident_contact, r.resident_hno, r.resident_street, s.street_name, s.street_area, a.area_name,r.resident_yearstayed, .r.resident_image, r.resident_allowmessage from tbl_resident r join tbl_street s on s.street_id = r.resident_street join tbl_area a on s.street_area = a.area_id join tbl_official o on o.resident_id = r.resident_id where o.official_id = '.Session::get('official'));
     	$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

     	$streets = DB::select('select s.street_name, s.street_id, a.area_name from tbl_street s join tbl_area a on a.area_id = s.street_area where s.street_exists =1 ');

     	$user = DB::select('select official_username from tbl_officialuser where official_id ='.Session::get('official'));
        return view('admin.profile')->with(array('profile'=>$profile, 'return'=>$return, 'streets'=>$streets, 'user'=>$user));

    }

}
