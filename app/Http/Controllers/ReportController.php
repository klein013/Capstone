<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function incident(){
    	return view('admin.reports_incident');
    }

    public function barangay(){
    	return view('admin.reports_barangay');
    }

    public function clearance(){
    	return view('admin.reportS_clearance');
    }

    public function get(){
    	$report = DB::select('select ClearanceReq_Date, Clearance_Type, concat(Resident_Fname," ",Resident_Lname) as Name, ClearanceReq_Purpose from tbl_clearancereq join tbl_clearance on tbl_clearancereq.ClearanceReq_Type = tbl_clearance.Clearance_ID join tbl_residents on tbl_clearancereq.ClearanceReq_Resident = tbl_residents.Resident_ID order by ClearanceReq_Date DESC, 3 DESC');

    	return response()->json($report);
    }

    public function getIncident(){

    	$report = DB::select("Select Incident_ID, concat(Incident_House,' ',Incident_Street,' ',Incident_Area) as Place, Incident_Datetime, Incident_Statement, Incident_Status from tbl_incident;");

    	return response()->json($report);
    }

    public function getBarangay(){

        $report = DB::select('select BrgyBlotter_ID,BrgyBlotter_Datetime, GROUP_CONCAT(concat(Involve_Type," : ",Resident_Fname," ",Resident_Lname) SEPARATOR "\n") as Name, CasesKP_Name, concat(BrgyBlotter_House," ",BrgyBlotter_Street," ",BrgyBlotter_Area) as Street,BrgyBlotter_Status from tbl_brgyblotter join tbl_caseskp on tbl_brgyblotter.BrgyBlotter_CaseKP = tbl_caseskp.CasesKP_ID join tbl_involve on Involve_BrgyBlotter=BrgyBlotter_ID join tbl_residents on Resident_ID = Involve_Resident where BrgyBlotter_Delete = 0 group by BrgyBlotter_ID, CasesKP_Name order by 1 asc, 3 desc');

        return response()->json($report);
    }
}
