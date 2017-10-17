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


        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

        $complaintsforadmin = DB::select('select count(*) as number from tbl_case where DATE(case_filed) = curdate() and case_exists = 1');

        $hearingsforadmin = DB::select('select count(*) as number  from tbl_hearing where hearing_status in("Pending","For Process") and hearing_exists = 1');

        $clearancesrequest = DB::select('select count(*) as number  from tbl_request r join tbl_trans t on t.trans_id = r.request_transaction where DATE(t.trans_date) = curdate()');

        $clearancereleased = DB::select('select count(*) as number  from tbl_request r join tbl_trans t on t.trans_id = r.request_transaction where DATE(t.trans_date) = curdate() and r.request_status = "Released"');

        $clearancepending = DB::select('select count(*) as number  from tbl_request r join tbl_trans t on t.trans_id = r.request_transaction where DATE(t.trans_date) = curdate() and r.request_status = "Pending"');

        $clearancecollected = DB::select('select sum(p.price_amt) as number from tbl_request r join tbl_trans t on t.trans_id = r.request_transaction join tbl_price p on r.request_price = p.price_id where DATE(r.request_paymentdate) = curdate()');

        $complaintsfornon = DB::select('select count(*) as number  from tbl_case c join tbl_caseallocation a on c.case_id = a .caseallocation_case where DATE(c.case_filed) = curdate() and c.case_exists = 1 and a.caseallocation_official = '.Session::get('official'));

        $hearingsfornon = DB::select('select count(*) as number  from tbl_hearing h join tbl_caseallocation c on c.caseallocation_case =  h.hearing_case where h.hearing_status in("Pending","For Process") and h.hearing_exists = 1 and c.caseallocation_official = '.Session::get('official'));

        $incidentsreported = DB::select('select count(*) as number  from tbl_incident where incident_status = "Pending" and incident_exists = 1 and DATE(incident_filed) = curdate()');

        $incidentsall = DB::select('select count(*) as number  from tbl_incident where incident_exists = 1 and DATE(incident_filed) = curdate()');

      return view('admin.index')->with(['return'=>$return, 'complaintsforadmin'=>$complaintsforadmin, 'hearingsforadmin'=>$hearingsforadmin, 'clearancesrequest'=>$clearancesrequest, 'clearancereleased'=>$clearancereleased, 'clearancecollected'=>$clearancecollected, 'clearancepending'=>$clearancepending, 'complaintsfornon'=>$complaintsfornon, 'hearingsfornon'=>$hearingsfornon, 'incidentsreported'=>$incidentsreported, 'incidentsall'=>$incidentsall ]);
    }

    public function login(Request $request){

        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

        $complaintsforadmin = DB::select('select count(*) as number from tbl_case where DATE(case_filed) = curdate() and case_exists = 1');

        $hearingsforadmin = DB::select('select count(*) as number  from tbl_hearing where hearing_status in("Pending","For Process") and hearing_exists = 1');

        $clearancesrequest = DB::select('select count(*) as number  from tbl_request r join tbl_trans t on t.trans_id = r.request_transaction where DATE(t.trans_date) = curdate()');

        $clearancepending = DB::select('select count(*) as number  from tbl_request r join tbl_trans t on t.trans_id = r.request_transaction where DATE(t.trans_date) = curdate() and r.request_status = "Pending"');


        $clearancereleased = DB::select('select count(*) as number  from tbl_request r join tbl_trans t on t.trans_id = r.request_transaction where DATE(t.trans_date) = curdate() and r.request_status = "Released"');

        $clearancecollected = DB::select('select sum(p.price_amt) as number  from tbl_request r join tbl_trans t on t.trans_id = r.request_transaction join tbl_price p on r.request_price = p.price_id where DATE(r.request_paymentdate) = curdate() group by r.request_id');

        $complaintsfornon = DB::select('select count(*) as number  from tbl_case c join tbl_caseallocation a on c.case_id = a .caseallocation_case where DATE(c.case_filed) = curdate() and c.case_exists = 1 and a.caseallocation_official = '.Session::get('official'));

        $hearingsfornon = DB::select('select count(*) as number  from tbl_hearing h join tbl_caseallocation c on c.caseallocation_case =  h.hearing_case where h.hearing_status in("Pending","For Process") and h.hearing_exists = 1 and c.caseallocation_official = '.Session::get('official'));

        $incidentsreported = DB::select('select count(*) as number  from tbl_incident where incident_status = "Pending" and incident_exists = 1 and DATE(incident_filed) = curdate()');

        $incidentsall = DB::select('select count(*) as number  from tbl_incident where incident_exists = 1 and DATE(incident_filed) = curdate()');

      return view('admin.index')->with(['return'=>$return, 'complaintsforadmin'=>$complaintsforadmin, 'hearingsforadmin'=>$hearingsforadmin, 'clearancesrequest'=>$clearancesrequest, 'clearancereleased'=>$clearancereleased, 'clearancecollected'=>$clearancecollected, 'clearancepending'=>$clearancepending, 'complaintsfornon'=>$complaintsfornon, 'hearingsfornon'=>$hearingsfornon, 'incidentsreported'=>$incidentsreported, 'incidentsall'=>$incidentsall ]);
    }

    public function logout(){
        session()->flush();
        return redirect("/");
    }

    public function check(Request $request){
    	
    	$user = DB::select('select official_username from tbl_officialuser where official_username = "'.$request->user.'"');
    	
    	if(!empty($user)){

    		$pass = DB::select('select o.official_id, p.position_id, concat(r.resident_fname," ",r.resident_lname) as name, r.resident_image, o.official_admin from tbl_officialuser o join tbl_official p on o.official_id = p.official_id join tbl_resident r on r.resident_id = p.resident_id where o.official_password = SHA1("'.$request->pass.'") and o.official_username = "'.$request->user.'"');
    		if(!empty($pass)){                                                                                   
    			session(['position'=>$pass[0]->position_id]);
    			session(['name'=> $pass[0]->name]);
    			session(['image'=> $pass[0]->resident_image]);
                session(['official'=> $pass[0]->official_id]);
                session(['admin'=> $pass[0]->official_admin]);
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
