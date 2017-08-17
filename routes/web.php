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
Route::get('/resident', 'ResidentController@create');
Route::get('/resident/getResidents', 'ResidentController@getResidents');
Route::post('/resident', 'ResidentController@store');
Route::delete('/resident', 'ResidentController@destroy');
Route::patch('/resident', 'ResidentController@update');

Route::get('/maintenance_info', 'InfoController@create');
Route::post('/maintenance_info', 'InfoController@store');

Route::get('/maintenance_pos', 'PositionController@create');
Route::get('/maintenance_pos/getPositions', 'PositionController@getPositions');
Route::get('/maintenance_pos/{id}', 'PositionController@getdetails');
Route::post('/maintenance_pos/update', 'PositionController@update');
Route::post('/maintenance_pos', 'PositionController@store');
Route::delete('/maintenance_pos', 'PositionController@destroy');

Route::get('/maintenance_official', 'OfficialController@create');
Route::get('/maintenance_official/get', 'OfficialController@getOfficials');
Route::post('/maintenance_official', 'OfficialController@store');
Route::delete('/maintenance_official/{id}', 'OfficialController@destroy');
Route::get('/maintenance_official/{id}', 'OfficialController@getdetails');
Route::post('/maintenance_official/update', 'OfficialController@update');

Route::get('/maintenance_luponsched', 'LuponSchedController@create');

Route::get('/maintenance_street', 'StreetController@create');
Route::post('/maintenance_street', 'StreetController@store');
Route::get('/maintenance_street/getStreets', 'StreetController@getStreets');
Route::delete('/maintenance_street', 'StreetController@destroy');
Route::get('/maintenance_street/{id}', 'StreetController@getdetails');
Route::post('/maintenance_street/update', 'StreetController@update');

Route::get('/maintenance_area', 'AreaController@create');
Route::get('/maintenance_area/getAreas', 'AreaController@getAreas');
Route::post('/maintenance_area', 'AreaController@store');
Route::delete('/maintenance_area', 'AreaController@destroy');
Route::get('/maintenance_area/{id}', 'AreaController@getdetails');
Route::post('/maintenance_area/update', 'AreaController@update');

Route::get('/maintenance_requirement', 'RequirementController@create');
Route::get('/maintenance_requirement/getRequirements', 'RequirementController@getRequirements');
Route::post('/maintenance_requirement', 'RequirementController@store');
Route::delete('/maintenance_requirement', 'RequirementController@destroy');
Route::get('/maintenance_requirement/{id}', 'RequirementController@getdetails');
Route::post('/maintenance_requirement/update', 'RequirementController@update');

Route::get('/maintenance_cases', 'CaseController@create');
Route::post('/maintenance_cases', 'CaseController@store');
Route::delete('/maintenance_cases/{id}', 'CaseController@destroy');
Route::get('/maintenance_cases/get/{id}', 'CaseController@getdetails');
Route::get('/maintenance_cases/getCases', 'CaseController@getCases');
Route::post('/maintenance_cases/updated', 'CaseController@updated');

Route::get('/maintenance_incident', 'IncidentcatController@create');
Route::post('/maintenance_incident', 'IncidentcatController@store');
Route::delete('/maintenance_incident/{id}', 'IncidentcatController@destroy');
Route::get('/maintenance_incident/get/{id}', 'IncidentcatController@getdetails');
Route::get('/maintenance_incident/getincident', 'IncidentcatController@getCases');
Route::post('/maintenance_incident/updated', 'IncidentcatController@updated');

Route::get('/maintenance_clearance', 'ClearanceController@create');
Route::post('/maintenance_clearance/{id}', 'ClearanceController@show');
Route::post('/maintenance_clearance/update/up', 'ClearanceController@update');
Route::post('/maintenance_clearance', 'ClearanceController@add');
Route::delete('/maintenance_clearance/{id}', 'ClearanceController@delete');
Route::get('/maintenance_clearance/getClearances', 'ClearanceController@getClearances');

Route::get('/maintenance_branch', 'BranchController@create');
Route::post('/maintenance_branch', 'BranchController@store');
Route::delete('/maintenance_branch', 'BranchController@destroy');

Route::get('/maintenance_access', 'AccessController@create');

Route::get('/complaint', 'ComplaintController@create');
Route::get('/complaint_res', 'ComplaintController@com');
Route::post('/complaint_process', 'ComplaintController@process');

Route::get('/schedule', 'ScheduleController@create');
Route::get('/getSchedule', 'ScheduleController@view');

Route::get('/record', 'RecordController@create');
Route::get('/records', 'RecordController@show');

Route::get('/clearance', 'ClearanceReqController@create');
Route::get('/getResidents', 'ClearanceReqController@getResidents');

Route::get('/incident', 'IncidentController@createIncident');
Route::get('/getIncident', 'IncidentController@getIncident');
Route::post('/storeIncident', 'IncidentController@storeIncident');
Route::post('/deleteIncident', 'IncidentController@deleteIncident');
Route::get('/sendMessages', 'IncidentController@sendMessages');

Route::get('/incident_mapping', 'MapController@createMap');
Route::post('/getIncidentLoc', 'MapController@getIncidentLoc');

Route::get('/reports_incident', 'ReportController@incident');
Route::get('/reports_barangay', 'ReportController@barangay');
Route::get('/reports_clearance', 'ReportController@clearance');
Route::get('/reports_clearance/get', 'ReportController@get');
Route::get('/reports_incident/get', 'ReportController@getIncident');
Route::get('/reports_barangay/get', 'ReportController@getBarangay');

Route::get('/queries', 'QueriesController@index');

Route::get('/payments', 'PaymentController@index');

Route::get('/maintenance_luponsched', 'LuponSchedController@create');
Route::get('/maintenance_luponsched/nosched', 'LuponSchedController@nosched');
Route::get('/maintenance_luponsched/add', 'LuponSchedController@add');
Route::get('/maintenance_luponsched/subtract', 'LuponSchedController@subtract');

Route::get('/maintenance_holidays', 'HolidayController@create');

Route::get('/profile', 'ProfileController@index');

});

