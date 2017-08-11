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

Route::get('/index', 'LoginController@signin');
Route::get('/indexcheck', 'LoginController@checkuser');
Route::get('/', 'LoginController@index');
Route::post('/login', 'LoginController@check');

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
Route::post('/clearance', 'ClearanceReqController@store');
Route::delete('/clearance', 'ClearanceReqController@destroy');

Route::post('/clearance_indigency', 'ClearanceReqController@create_indigency');
Route::post('/clearance_residency', 'ClearanceReqController@create_residency');
Route::post('/clearance_businessliquor', 'ClearanceReqController@create_businessliquor');
Route::post('/clearance_transpo', 'ClearanceReqController@create_transpo');
Route::post('/clearance_noDerogatory', 'ClearanceReqController@create_noDerogatory');
Route::post('/clearance_businessa', 'ClearanceReqController@create_businessa');
Route::post('/clearance_businessb', 'ClearanceReqController@create_businessb');
Route::post('/clearance_businessc', 'ClearanceReqController@create_businessc');
Route::post('/clearance_businessd', 'ClearanceReqController@create_businessd');
Route::post('/clearance_businesse', 'ClearanceReqController@create_businesse');
Route::post('/clearance_water', 'ClearanceReqController@create_water');
Route::post('/clearance_electric', 'ClearanceReqController@create_electric');
Route::post('/clearance_construction', 'ClearanceReqController@create_construction');
Route::post('/clearance_excavation', 'ClearanceReqController@create_excavation');
Route::post('/clearance_addtl', 'ClearanceReqController@create_addtl');

Route::post('/clearance_residency/{id}', 'ClearanceReqController@get_transpo');
Route::post('/clearance_indigency/{id}', 'ClearanceReqController@get_indigency');
Route::post('/clearance_noDerogatory/{id}', 'ClearanceReqController@get_noDerogatory');
Route::post('/clearance_businessa/{id}', 'ClearanceReqController@get_businessa');
Route::post('/clearance_businessb/{id}', 'ClearanceReqController@get_businessb');
Route::post('/clearance_businessc/{id}', 'ClearanceReqController@get_businessc');
Route::post('/clearance_businessd/{id}', 'ClearanceReqController@get_businessd');
Route::post('/clearance_businesse/{id}', 'ClearanceReqController@get_businesse');
Route::post('/clearance_water/{id}', 'ClearanceReqController@get_water');
Route::post('/clearance_electric/{id}', 'ClearanceReqController@get_electric');
Route::post('/clearance_construction/{id}', 'ClearanceReqController@get_construction');
Route::post('/clearance_excavation/{id}', 'ClearanceReqController@get_excavation');

Route::get('/incident', 'IncidentController@createIncident');
Route::get('/incident/index', 'IncidentController@index');
Route::get('/incident_getstat/{id}', 'IncidentController@getstat');
Route::post('/incidentput', 'IncidentController@store');
Route::post('/incident_update', 'IncidentController@update');
Route::delete('/incident_delete/{id}', 'IncidentController@delete');
Route::get('/incident_mapping', 'IncidentController@createMap');

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

