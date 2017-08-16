<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HolidayController extends Controller
{

    public function create()
    {
    	$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];
        return view('admin.maintenance_holidays', compact('return'));
    }
    
}
