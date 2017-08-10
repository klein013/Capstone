<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class ScheduleController extends Controller
{
   	public function create(){
   		$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position')];
	    return view('admin.schedule', compact('return'));
   	}
}
