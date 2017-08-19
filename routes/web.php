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

Route::group(['middleware'=>'Login'], function(){

Route::get('/index', 'LoginController@signin');
Route::get('/indexcheck', 'LoginController@checkuser');

//Resident

Route::get('/resident', 'ResidentController@create');
Route::get('/resident/getResidents', 'ResidentController@getResidents');
Route::post('/resident', 'ResidentController@store');
Route::delete('/resident', 'ResidentController@destroy');
Route::patch('/resident', 'ResidentController@update');

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
Route::get('/clearance/getResidents/{id}', 'ClearanceReqController@getResidents');
Route::post('/clearance/storeClearance', 'ClearanceReqController@storeClearance');
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
//Barangay Blotter

// Incident Blotter
Route::get('/blotter/incident/incident', 'IncidentController@createIncident');
Route::get('/getIncident', 'IncidentController@getIncident');
Route::post('/storeIncident', 'IncidentController@storeIncident');
Route::post('/deleteIncident', 'IncidentController@deleteIncident');
Route::get('/countincident', 'IncidentController@count');
Route::get('/sendMessages', 'IncidentController@sendMessages');

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

//Reports

//Queries

Route::get('/queries', 'QueriesController@index');

//Queries

Route::get('/payments', 'PaymentController@index');


Route::get('/profile', 'ProfileController@index');

});

