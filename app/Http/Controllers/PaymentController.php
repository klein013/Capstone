<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];
        return view('admin.cashier')->with(array('return'=>$return));
    }

    
}
