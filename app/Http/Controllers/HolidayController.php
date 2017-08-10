<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HolidayController extends Controller
{

    public function create()
    {
        return view('admin.maintenance_holidays');
    }
    
}
