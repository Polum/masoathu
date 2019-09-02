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

Route::get('/login', 'Admin\AdminController@getLogin');

Route::get('/', 'Admin\AdminController@getIndex');
Route::get('/home', 'Admin\AdminController@getIndex');
Route::get('dashboard', 'Admin\AdminController@getIndex');
Route::get('dashboard2', function(){
    return view('admin.pages.dashboard2');
});
Route::get('observers', 'Admin\AdminController@getObservers');
Route::get('users', 'Admin\AdminController@getUsers');
Route::get('questions', 'Admin\AdminController@getQuestions');
Route::get('open-messages', 'Admin\AdminController@getOpenMessages');
Route::get('observer-checklist', 'Admin\AdminController@getObserverChecklist');
Route::get('map-overview', 'Admin\AdminController@getMapOverview');
Route::get('open-reports', 'Admin\AdminController@getOpenReports');
Route::get('checklist-reports', 'Admin\AdminController@getChecklistReports');
Route::get('candidate-reports', 'Admin\AdminController@getCandidateReports');
Route::get('incident-reports', 'Admin\AdminController@getIncidentReports');
Route::get('observer-checklist-report', 'Admin\AdminController@getObserverChecklistReport');
Route::get('administrative-divisions', 'Admin\AdminController@getAdministrativeDivision');
Route::get('administrative-divisions-levels-data/{id}', 'Admin\AdminController@getAdministrativeLevels');
Route::get('admin-levels', 'AdminDivisionLevelsController@create');

Route::get('import', 'Admin\AdminController@getAdminDivImport');

//Route::get('filtered-sms', 'SMSApiController@getFilteredData');
Route::get('filter-sms', 'CorrectSMSController@filterSms');
Route::get('add-sms', 'CorrectSMSController@addMessages');
Route::get('add-sms-incident', 'CorrectSMSController@addIncidents');

//correct Messages Routes
Route::get('sms-by-question-number/{id}', 'CorrectSMSController@getMessagesByQuestion');
Route::get('sms-by-incident', 'CorrectSMSController@getMessagesIncidents');
Route::get('sms-by-region/{id}', 'CorrectSMSController@getMessagesByRegion');
Route::get('sms-by-district/{id}', 'CorrectSMSController@getMessagesByDistrict');
Route::get('sms-by-constituency/{id}', 'CorrectSMSController@getMessagesByConstituency');
Route::get('sms-by-ward/{id}', 'CorrectSMSController@getMessagesByWard');
Route::get('sms-by-center/{id}', 'CorrectSMSController@getMessagesByCenter');
Route::get('sms-with-original/{id}', 'CorrectSMSController@messageWithOriginal');
//Route::get('import-observers', 'Admin\ExcelController@uploadObservers');
//Route::get('import-questions', 'Admin\ExcelController@uploadQuestions');



/**
 * Routes for the excel import and export
 */
// Route for view/blade file.
Route::get('importExport', 'Admin\ExcelController@importExport');
// Route for export/download tabledata to .csv, .xls or .xlsx
Route::get('downloadExcel/{type}', 'Admin\ExcelController@downloadExcel');
// Route for import excel data to database.
Route::post('import-all-admin-divisions', 'Admin\ExcelController@uploadExcel');
Route::post('import-all-observers', 'Admin\ExcelController@uploadObservers');
Route::post('import-all-Question', 'Admin\ExcelController@uploadQuestions');

/**
 * Resource Routes
 */
Route::resources([
    //'admin-division-level' => 'AdminDivisionLevelsController',
    'sms-resources' => 'SMSApiController',
    'observer-resources' => 'ObserverController',
    'question-resources' => 'QuestionController',
    'question-category-resources' => 'QuestionCategoryController',
    'question-type-resources' => 'QuestionTypeController',
    'admin-division-resources' => 'AdminDivisionController',
    'incident-type-resources' => 'IncidentController',
    'polling-station-resources' => 'PollingStationController',
    'user-resources' => 'UserController',
    'flagged-resources' => 'FlaggedIncidentController',
    'correct-sms-resources' => 'CorrectSMSController',
]);
Auth::routes();
Route::get('edit-user/{id}', 'UserController@editUser');
Route::post('update-user', 'UserController@updateUser');

Route::get('retro', 'ObserverController@retro');

