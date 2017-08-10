<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblOfficialuser;

class RegistrationController extends Controller
{
    public function create(){
    	return view('signup');
    }

    public function store(Request $request){

    	$exists = DB::select('select official_id from tbl_officialuser where official_id = '.$request->official);

    	if(!empty($exists[0]->official_id)){

    		return response("Official already registered");
    	}
    	else{

    		$ifexists = DB::select('select official_id from tbl_official where official_id = '.$request->official);

    		if(!empty($ifexists[0]->official_id))
    		{
    			$userexists = DB::select('select official_id from tbl_officialuser where official_username = "'.$request->user.'"');

    			if(!empty($userexists[0]->official_id)){
    				return response("Username already exists");
	    		}
    			else{

    				$user = new TblOfficialuser;

    				$user->official_id = $request->official;
    				$user->official_username = $request->user;
    				$user->official_password = SHA1($request->pass);
	    			$user->save();

    				return response("Registration successful");
    			}
    		}
    		else{
    			return response("Official can't be found");
    		}
    	}

    }

}
