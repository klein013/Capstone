<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::post('/login', 'LoginController@login');

Route::get('/signup', 'RegistrationController@create');
Route::post('/signup_confirm', 'RegistrationController@store');
Route::get('/', 'LoginController@index');

Route::post('/login', 'LoginController@check');
Route::get('/logout', 'LoginController@logout');

Route::get('/trial', 'WebController@test');

Route::group(['middleware'=>'Login'], function(){
 
Route::get('/index', 'LoginController@signin');
Route::get('/indexcheck', 'LoginController@checkuser');

//Resident

Route::get('/resident', 'ResidentController@create');
Route::get('/resident/getResidents', 'ResidentController@getResidents');
Route::post('/resident', 'ResidentController@store');
Route::delete('/resident', 'ResidentController@destroy');
Route::get('/resident/update/{id}', 'ResidentController@showrecord');
Route::post('/resident/update', 'ResidentController@update');
Route::delete('/resident/delete', 'ResidentController@destroy');

//Resident

//Maintenance

Route::get('/maintenance/barangay/official', 'OfficialController@create');
Route::get('/maintenance/barangay/official/get', 'OfficialController@getOfficials');
Route::post('/maintenance/barangay/official', 'OfficialController@store');
Route::delete('/maintenance/barangay/official/{id}', 'OfficialController@destroy');
Route::get('/maintenance/barangay/official/{id}', 'OfficialController@getdetails');
Route::post('/maintenance/barangay/official/update', 'OfficialController@update');

Route::get('/maintenance/barangay/street', 'StreetController@create');
Route::post('/maintenance/barangay/street', 'StreetController@store');
Route::get('/maintenance/barangay/street/getStreets', 'StreetController@getStreets');
Route::delete('/maintenance/barangay/street', 'StreetController@destroy');
Route::get('/maintenance/barangay/street/{id}', 'StreetController@getdetails');
Route::post('/maintenance/barangay/street/update', 'StreetController@update');

Route::get('/maintenance/barangay/area', 'AreaController@create');
Route::get('/maintenance/barangay/area/getAreas', 'AreaController@getAreas');
Route::post('/maintenance/barangay/area', 'AreaController@store');
Route::delete('/maintenance/barangay/area', 'AreaController@destroy');
Route::get('/maintenance/barangay/area/{id}', 'AreaController@getdetails');
Route::post('/maintenance/barangay/area/update', 'AreaController@update');

Route::get('/maintenance/blotter/cases', 'CaseController@create');
Route::post('/maintenance/blotter/cases', 'CaseController@store');
Route::delete('/maintenance/blotter/cases/{id}', 'CaseController@destroy');
Route::get('/maintenance/blotter/cases/get/{id}', 'CaseController@getdetails');
Route::get('/maintenance/blotter/cases/getCases', 'CaseController@getCases');
Route::post('/maintenance/blotter/cases/updated', 'CaseController@updated');

Route::get('/maintenance/blotter/incident', 'IncidentcatController@create');
Route::post('/maintenance/blotter/incident', 'IncidentcatController@store');
Route::delete('/maintenance/blotter/incident/{id}', 'IncidentcatController@destroy');
Route::get('/maintenance/blotter/incident/get/{id}', 'IncidentcatController@getdetails');
Route::get('/maintenance/blotter/incident/getincident', 'IncidentcatController@getCases');
Route::post('/maintenance/blotter/incident/updated', 'IncidentcatController@updated');

Route::get('/maintenance/clearance/requirement', 'RequirementController@create');
Route::get('/maintenance/clearance/requirement/getRequirements','RequirementController@getRequirements');
Route::post('/maintenance/clearance/requirement', 'RequirementController@store');
Route::delete('/maintenance/clearance/requirement', 'RequirementController@destroy');
Route::get('/maintenance/clearance/requirement/{id}', 'RequirementController@getdetails');
Route::post('/maintenance/clearance/requirement/update', 'RequirementController@update');

Route::get('/maintenance/clearance/clearance', 'ClearanceController@create');
Route::post('/maintenance/clearance/clearance/{id}', 'ClearanceController@show');
Route::post('/maintenance/clearance/clearance/update/up', 'ClearanceController@update');
Route::post('/maintenance/clearance/clearance', 'ClearanceController@add');
Route::delete('/maintenance/clearance/clearance/{id}', 'ClearanceController@delete');
Route::get('/maintenance/clearance/clearance/getClearances', 'ClearanceController@getClearances');

//Maintenance

// Clearance
Route::get('/clearance/clearance', 'ClearanceReqController@create');
Route::get('/clearance/clearance/get', 'ClearanceReqController@getClearances');
Route::get('/clearance/clearance/clearancedetails/{id}', 'ClearanceReqController@getClearancesDetails');
Route::delete('/clearance/clearance/removerequest/{id}', 'ClearanceReqController@removeRequest');
Route::delete('/clearance/clearance/removetrans/{id}', 'ClearanceReqController@removeTransaction');
Route::get('/clearance/clearance/getforrelease', 'ClearanceReqController@getClearancesForRelease');
Route::get('/clearance/clearance/getrelease', 'ClearanceReqController@getClearancesRelease');
Route::get('/clearance/clearance/getpending', 'ClearanceReqController@getClearancesPending');
Route::get('/clearance/getclearancereq/{id}', 'ClearanceReqController@getClearanceRequirement');
Route::get('/clearance/getResidents/{id}', 'ClearanceReqController@getResidents');
Route::post('/clearance/storeClearance', 'ClearanceReqController@storeClearance');
Route::get('/clearance/release', 'ReleaseController@create');
Route::get('/clearance/release/get', 'ReleaseController@getTrans');
Route::get('/clearance/release/getForRelease', 'ReleaseController@getTransForRelease');
Route::get('/clearance/release/getRelease', 'ReleaseController@getTransRelease');
Route::get('/clearance/release/{id}', 'ReleaseController@createdoc');
Route::get('/clearance/release/check/{id}', 'ReleaseController@checkdeficiency');
Route::post('/clearance/release/req', 'ReleaseController@deficiency');
Route::get('/clearance/payments/getunpaid', 'PaymentController@getunpaid');
Route::get('/clearance/payments/getpaid', 'PaymentController@getpaid');
Route::post('/clearance/payments/pay', 'PaymentController@payment');
Route::get('/clearance/payments/makereceipt/{id}', 'PaymentController@makereceipt');
Route::get('/clearance/payments/payreceipt/{id}', 'PaymentController@getreceipt');
// Clearance

//Blotter

//Barangay Blotter
Route::get('/blotter/barangay/complaint', 'ComplaintController@create');
Route::get('/blotter/barangay/complaint_res', 'ComplaintController@com');
Route::post('/blotter/barangay/complaint_process', 'ComplaintController@process');

Route::get('/blotter/barangay/schedule', 'ScheduleController@create');
Route::get('/getSchedule', 'ScheduleController@view');

Route::get('/blotter/barangay/record', 'RecordController@create');
Route::get('/blotter/barangay/records', 'RecordController@show');
Route::get('/blotter/barangay/getcasestat', 'RecordController@getcase');
Route::post('/blotter/barangay/allocatecasecap', 'RecordController@allocatecap');
Route::post('/blotter/barangay/allocatecase', 'RecordController@allocate');
Route::delete('/blotter/barangay/delete/{id}', 'RecordController@delete');
Route::post('/blotter/barangay/reschedcap/{id}', 'RecordController@reschedcap');
Route::post('/blotter/barangay/resched/{id}', 'RecordController@resched');

Route::get('/blotter/barangay/getmed/{id}', 'RecordController@mediation');
Route::get('/blotter/barangay/getcon/{id}', 'RecordController@concillation');
Route::get('/blotter/barangay/getarb/{id}', 'RecordController@arbitration');

Route::get('/blotter/barangay/record/mres/{id}', 'RecordController@printmres');
Route::get('/blotter/barangay/record/mcom/{id}', 'RecordController@printmcom');
Route::get('/blotter/barangay/record/mwit/{id}', 'RecordController@printmwit');

Route::get('/blotter/barangay/record/cres/{id}', 'RecordController@printcres');
Route::get('/blotter/barangay/record/ccom/{id}', 'RecordController@printccom');
Route::get('/blotter/barangay/record/cwit/{id}', 'RecordController@printcwit');

Route::get('/blotter/barangay/schedule/{id}', 'HearingController@processhearing');
Route::get('/blotter/barangay/getdetails/{id}', 'ScheduleController@getdetails');
Route::post('/blotter/barangay/hearing', 'HearingController@addminutes');
Route::post('/blotter/barangay/starthearing', 'HearingController@startminutes');

Route::post('/blotter/barangay/resched', 'ScheduleController@resched');

Route::get('/blotter/barangay/show/{id}', 'RecordController@showblotter');
Route::get('/blotter/barangay/hearingshow/{id}', 'RecordController@showhearing');
//Barangay Blotter

// Incident Blotter
Route::get('/blotter/incident/incident', 'IncidentController@createIncident');
Route::get('/getIncident', 'IncidentController@getIncident');
Route::get('/getIncident/actiondone', 'IncidentController@getIncidentDone');
Route::get('/getIncident/pending', 'IncidentController@getIncidentPending');
Route::get('/getIncident/ongoing', 'IncidentController@getIncidentOngoing');
Route::post('/storeIncident', 'IncidentController@storeIncident');
Route::post('/deleteIncident', 'IncidentController@deleteIncident');
Route::get('/countincident', 'IncidentController@count');
Route::get('/sendMessages', 'IncidentController@sendMessages');
Route::get('/blotter/incident/updatestat/{id}', 'IncidentController@updatestat');
Route::get('/blotter/incident/getstat/{id}', 'IncidentController@getstat');
Route::post('/blotter/incident/updateincident', 'IncidentController@updateIncident');
Route::get('/blotter/incident/getdetails/{id}', 'IncidentController@getdetails');

Route::get('/blotter/incident/incident_mapping', 'MapController@createMap');
Route::post('/blotter/incident/getIncidentLoc', 'MapController@getIncidentLoc');
// Incident Blotter

//Blotter

//Reports

Route::get('/reports_incident', 'ReportController@incident');
Route::get('/reports_barangay', 'ReportController@barangay');
Route::get('/reports_clearance', 'ReportController@clearance');
Route::get('/reports_clearance/get', 'ReportController@get');
Route::get('/reports_incident/get', 'ReportController@getIncident');
Route::get('/reports_barangay/get', 'ReportController@getBarangay');

Route::post('/reports_clearance/daily', 'ReportController@getClearanceDaily');
Route::post('/reports_clearance/weekly', 'ReportController@getClearanceWeekly');
Route::post('/reports_clearance/monthly', 'ReportController@getClearanceMonthly');
Route::post('/reports_clearance/yearly', 'ReportController@getClearanceYearly');

Route::post('/reports_incident/daily', 'ReportController@getIncidentDaily');
Route::post('/reports_incident/weekly', 'ReportController@getIncidentWeekly');
Route::post('/reports_incident/monthly', 'ReportController@getIncidentMonthly');
Route::post('/reports_incident/yearly', 'ReportController@getIncidentYearly');


//Reports

//Queries

Route::get('/queries', 'QueriesController@index');

//Queries

Route::get('/clearance/payments', 'PaymentController@index');


//Utitlities
Route::get('/utilities/info', 'InfoController@create');
Route::post('/utilities/info/store', 'InfoController@store');

Route::get('/utilities/events', 'HolidayController@create');
Route::get('/utilities/events/show', 'HolidayController@show');
Route::post('/utilities/events/store', 'HolidayController@store');
Route::delete('/utilities/events/delete', 'HolidayController@delete');
Route::post('/utilities/events/update', 'HolidayController@update');
Route::get('/utilities/events/update/{id}', 'HolidayController@updaterec');

Route::get('/utilities/access', 'AccessController@create');
Route::get('/utilities/access/show', 'AccessController@showall');
Route::post('/utilities/access/update', 'AccessController@update');


Route::get('/profile', 'ProfileController@index');


});



