<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class QueriesController extends Controller
{
     public function index()
    {
       $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];
	    return view('admin.queries', compact('return'));
    }
}
