<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class WebController extends Controller
{
    
	public function index(){
		$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position')];
	    return view('admin.index', compact('return'));
	}

	public function maintenance_info(){
		return view('admin.maintenance_info');
	}

	public function maintenance_official(){
		return view('admin.maintenance_official');
	}

	public function maintenance_hearing(){
		return view('admin.maintenance_hearing');
	}

	public function maintenance_clearance(){
		return view('admin.maintenance_clearance');
	}

	public function maintenance_holiday(){
		return view('admin.maintenance_holiday');
	}

	public function maintenance_branch(){
		return view('admin.maintenance_branches');
	}

}
