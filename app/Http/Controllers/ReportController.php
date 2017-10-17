<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ReportController extends Controller
{
    public function incident(){
    	$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

         $yearavail = DB::select('select YEAR(trans_date) as yeardate from tbl_trans group by YEAR(trans_date)');
        

        return view('admin.incidentprintreport')->with(['return'=>$return, 'years'=>$yearavail]);
    }

    public function barangay(){
    	return view('admin.reports_barangay');
    }

    public function clearance(){
    	$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];

         $yearavail = DB::select('select YEAR(trans_date) as yeardate from tbl_trans group by YEAR(trans_date)');
        

        return view('admin.clearanceprintreport')->with(['return'=>$return, 'years'=>$yearavail]);
    }

    public function get(){
    	// $report = DB::select('select ClearanceReq_Date, Clearance_Type, concat(Resident_Fname," ",Resident_Lname) as Name, ClearanceReq_Purpose from tbl_clearancereq join tbl_clearance on tbl_clearancereq.ClearanceReq_Type = tbl_clearance.Clearance_ID join tbl_residents on tbl_clearancereq.ClearanceReq_Resident = tbl_residents.Resident_ID order by ClearanceReq_Date DESC, 3 DESC');

    	return response()->json(null);
    }

    public function getIncident(){

    	$report = DB::select("Select Incident_ID, concat(Incident_House,' ',Incident_Street,' ',Incident_Area) as Place, Incident_Datetime, Incident_Statement, Incident_Status from tbl_incident;");

    	return response()->json($report);
    }

    public function getBarangay(){

        $report = DB::select('select BrgyBlotter_ID,BrgyBlotter_Datetime, GROUP_CONCAT(concat(Involve_Type," : ",Resident_Fname," ",Resident_Lname) SEPARATOR "\n") as Name, CasesKP_Name, concat(BrgyBlotter_House," ",BrgyBlotter_Street," ",BrgyBlotter_Area) as Street,BrgyBlotter_Status from tbl_brgyblotter join tbl_caseskp on tbl_brgyblotter.BrgyBlotter_CaseKP = tbl_caseskp.CasesKP_ID join tbl_involve on Involve_BrgyBlotter=BrgyBlotter_ID join tbl_residents on Resident_ID = Involve_Resident where BrgyBlotter_Delete = 0 group by BrgyBlotter_ID, CasesKP_Name order by 1 asc, 3 desc');

        return response()->json($report);
    }

    public function getClearanceDaily(Request $request){

        $chartdata = DB::select('select count(*) as shit, c.clearance_name, r.request_status as hours from tbl_trans t join tbl_request r on r.request_transaction = t.trans_id join tbl_clearancevalidity v on v.validity_id = r.request_validity join tbl_clearance c on c.clearance_id = v.clearance_id where DATE(t.trans_date) = "'.$request->date.'" group by r.request_status, c.clearance_id order by 2');

        $tabledata = DB::select('select lpad(t.trans_id,8,"0") as trans_id, c.clearance_name, DATE(t.trans_date)as trans_date, re.request_status, p.price_amt, concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name from tbl_trans t join tbl_request re on re.request_transaction=t.trans_id join tbl_price p on p.price_id = re.request_price join tbl_clearance c on p.clearance_id = c.clearance_id join tbl_resident r on r.resident_id = t.trans_resident where DATE(t.trans_date) = "'.$request->date.'" order by c.clearance_name, re.request_status asc');

        $return =['chartdata'=>$chartdata, 'tabledata'=>$tabledata];
        return response()->json($return);
    }

    public function getClearanceWeekly(Request $request){

        $chartdata = DB::select('select count(*) as shit, c.clearance_name, r.request_status as hours from tbl_trans t join tbl_request r on r.request_transaction = t.trans_id join tbl_clearancevalidity v on v.validity_id = r.request_validity join tbl_clearance c on c.clearance_id = v.clearance_id where DATE(t.trans_date) between "'.$request->fromdate.'" and "'.$request->todate.'" group by r.request_status, c.clearance_id order by 2');

        $tabledata = DB::select('select lpad(t.trans_id,8,"0") as trans_id, c.clearance_name, DATE(t.trans_date)as trans_date, re.request_status, p.price_amt, concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name from tbl_trans t join tbl_request re on re.request_transaction=t.trans_id join tbl_price p on p.price_id = re.request_price join tbl_clearance c on p.clearance_id = c.clearance_id join tbl_resident r on r.resident_id = t.trans_resident where DATE(t.trans_date) between "'.$request->fromdate.'" and "'.$request->todate.'" order by c.clearance_name, re.request_status asc');

        $return =['chartdata'=>$chartdata, 'tabledata'=>$tabledata];
        return response()->json($return);
    }

    public function getClearanceMonthly(Request $request){

        $chartdata = DB::select('select count(*) as shit, c.clearance_name, r.request_status as hours from tbl_trans t join tbl_request r on r.request_transaction = t.trans_id join tbl_clearancevalidity v on v.validity_id = r.request_validity join tbl_clearance c on c.clearance_id = v.clearance_id where MONTH(t.trans_date) = '.$request->monthlymonth.' and YEAR(t.trans_date) = '.$request->monthlyyear.' group by r.request_status, c.clearance_id order by 2');

        $tabledata = DB::select('select lpad(t.trans_id,8,"0") as trans_id, c.clearance_name, DATE(t.trans_date)as trans_date, re.request_status, p.price_amt, concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name from tbl_trans t join tbl_request re on re.request_transaction=t.trans_id join tbl_price p on p.price_id = re.request_price join tbl_clearance c on p.clearance_id = c.clearance_id join tbl_resident r on r.resident_id = t.trans_resident where MONTH(t.trans_date) = '.$request->monthlymonth.' and YEAR(t.trans_date) = '.$request->monthlyyear.' order by c.clearance_name, re.request_status asc');

        $return =['chartdata'=>$chartdata, 'tabledata'=>$tabledata];
        return response()->json($return);
    }

    public function getClearanceYearly(Request $request){

        $chartdata = DB::select('select count(*) as shit, c.clearance_name, r.request_status as hours from tbl_trans t join tbl_request r on r.request_transaction = t.trans_id join tbl_clearancevalidity v on v.validity_id = r.request_validity join tbl_clearance c on c.clearance_id = v.clearance_id where YEAR(t.trans_date) = '.$request->yearlyyear.' group by r.request_status, c.clearance_id order by 2');

        $tabledata = DB::select('select lpad(t.trans_id,8,"0") as trans_id, c.clearance_name, DATE(t.trans_date)as trans_date, re.request_status, p.price_amt, concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name from tbl_trans t join tbl_request re on re.request_transaction=t.trans_id join tbl_price p on p.price_id = re.request_price join tbl_clearance c on p.clearance_id = c.clearance_id join tbl_resident r on r.resident_id = t.trans_resident where YEAR(t.trans_date) = '.$request->yearlyyear.' order by trans_date, c.clearance_name, re.request_status asc');

        $return =['chartdata'=>$chartdata, 'tabledata'=>$tabledata];
        return response()->json($return);
    }

    public function getIncidentDaily(Request $request){

         $chartdata = DB::select('select count(*) as shit, c.incidentcat_name as clearance_name, i.incident_status as hours from tbl_incident i join tbl_incidentcat c on c.incidentcat_id = i.incident_cat where DATE(i.incident_datetime) = "'.$request->date.'" and i.incident_exists = 1 group by c.incidentcat_name');

        $tabledata = DB::select('select lpad(i.incident_id,8,"0") as trans_id, c.incidentcat_name as clearance_name, i.incident_datetime as trans_date, i.incident_status as request_status, s.street_name as price_amt, null as name from tbl_incident i join tbl_incidentcat c on c.incidentcat_id = i.incident_cat join tbl_street s on s.street_id = i.incident_street where DATE(i.incident_datetime) = "'.$request->date.'" and i.incident_exists =1 order by 2,4 asc');

        $return =['chartdata'=>$chartdata, 'tabledata'=>$tabledata];
        return response()->json($return);
    }

    public function getIncidentMonthly(Request $request){


        $chartdata = DB::select('select count(*) as shit, c.incidentcat_name as clearance_name, i.incident_status as hours from tbl_incident i join tbl_incidentcat c on c.incidentcat_id = i.incident_cat where MONTH(i.incident_datetime) = '.$request->monthlymonth.' and YEAR(i.incident_datetime) = '.$request->monthlyyear.' and i.incident_exists = 1 group by c.incidentcat_name');

        $tabledata = DB::select('select lpad(i.incident_id,8,"0") as trans_id, c.incidentcat_name as clearance_name, i.incident_datetime as trans_date, i.incident_status as request_status, s.street_name as price_amt, null as name from tbl_incident i join tbl_incidentcat c on c.incidentcat_id = i.incident_cat join tbl_street s on s.street_id = i.incident_street where MONTH(i.incident_datetime) = '.$request->monthlymonth.' and YEAR(i.incident_datetime) = '.$request->monthlyyear.' and i.incident_exists =1 order by 2,4 asc');

        $return =['chartdata'=>$chartdata, 'tabledata'=>$tabledata];
        return response()->json($return);

    }

    public function getIncidentWeekly(Request $request){

        $chartdata = DB::select('select count(*) as shit, c.incidentcat_name as clearance_name, i.incident_status as hours from tbl_incident i join tbl_incidentcat c on c.incidentcat_id = i.incident_cat where DATE(i.incident_datetime) between "'.$request->fromdate.'" and "'.$request->todate.'" and i.incident_exists = 1 group by c.incidentcat_name');

        $tabledata = DB::select('select lpad(i.incident_id,8,"0") as trans_id, c.incidentcat_name as clearance_name, i.incident_datetime as trans_date, i.incident_status as request_status, s.street_name as price_amt, null as name from tbl_incident i join tbl_incidentcat c on c.incidentcat_id = i.incident_cat join tbl_street s on s.street_id = i.incident_street where DATE(i.incident_datetime) between "'.$request->fromdate.'" and "'.$request->todate.'" and i.incident_exists =1 order by 2,4 asc');

        $return =['chartdata'=>$chartdata, 'tabledata'=>$tabledata];
        return response()->json($return);

    }

    public function getIncidentYearly(Request $request){

        $chartdata = DB::select('select count(*) as shit, c.incidentcat_name as clearance_name, i.incident_status as hours from tbl_incident i join tbl_incidentcat c on c.incidentcat_id = i.incident_cat where YEAR(i.incident_datetime) = "'.$request->yearlyyear.'" and i.incident_exists = 1 group by c.incidentcat_name');

        $tabledata = DB::select('select lpad(i.incident_id,8,"0") as trans_id, c.incidentcat_name as clearance_name, i.incident_datetime as trans_date, i.incident_status as request_status, s.street_name as price_amt, null as name from tbl_incident i join tbl_incidentcat c on c.incidentcat_id = i.incident_cat join tbl_street s on s.street_id = i.incident_street where YEAR(i.incident_datetime) = "'.$request->yearlyyear.'" and i.incident_exists =1 order by 2,4 asc');

        $return =['chartdata'=>$chartdata, 'tabledata'=>$tabledata];
        return response()->json($return);

    }
}
