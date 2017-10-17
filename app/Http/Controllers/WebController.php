<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use PDF;

class WebController extends Controller
{
   public function test(){

   	    $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];
        return view('admin.hearing', compact('return'));
   }

}
