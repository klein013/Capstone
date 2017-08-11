<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblOfficialuser;
use App\Http\Controllers\Controller;
use Session;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function signin(){
        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position')];
        return view('admin.index', compact('return'));

    }

    public function login(Request $request){
      return view('admin.index');
    }

    public function check(Request $request){
    	
    	$user = DB::select('select official_username from tbl_officialuser where official_username = "'.$request->user.'"');
    	
    	if(!empty($user)){

    		$pass = DB::select('select o.official_id, p.position_id, concat(r.resident_fname," ",r.resident_lname) as name, r.resident_image from tbl_officialuser o join tbl_official p on o.official_id = p.official_id join tbl_resident r on r.resident_id = p.resident_id where o.official_password = SHA1("'.$request->pass.'") and o.official_username = "'.$request->user.'"');
    		if(!empty($pass)){                                                                                   
    			session(['position'=>$pass[0]->position_id]);
    			session(['name'=> $pass[0]->name]);
    			session(['image'=> $pass[0]->resident_image]);
                session(['official'=> $pass[0]->official_id]);
    			return response("success");
    		}
    		else{
    			return response("incorrect password");
    		}
    	}
    	else{
    		return response("username not found");
    	}
    }

    public function checkuser(){
	    if(!session()->has('position')){
	    	return redirect()->action('LoginController@index');
	    }
	    else{
	    	return redirect()->action('LoginController@signin');
	    }

    }

}
