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

// Route::get('/', 'Admin\AdminController@getIndex');
// Route::get('dashboard', 'Admin\AdminController@getIndex');
// Route::get('dashboard2', function(){
//     return view('admin.pages.dashboard2');
// });

Route::middleware('auth:api')->group(function () {
    Route::get('/', 'ObserverResponseController@index');
});
Route::get('dashboard', 'ObserverResponseController@index');

Route::get('observers', 'Admin\AdminController@getObservers');
Route::get('questions', 'Admin\AdminController@getQuestions');
Route::get('open-messages', 'Admin\AdminController@getOpenMessages');
Route::get('observer-checklist', 'Admin\AdminController@getObserverChecklist');
Route::get('map-overview', 'Admin\AdminController@getMapOverview');
Route::get('open-reports', 'Admin\AdminController@getOpenReports');
Route::get('checklist-reports', 'Admin\AdminController@getChecklistReports');
Route::get('presidential-results', 'ResultsController@index');
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

// Admin authorized
Route::group(['middleware' => ['admin']], function(){
    Route::get('users', 'Admin\AdminController@getUsers');
    Route::get('edit-user/{id}', 'UserController@editUser');
    Route::get('edit-user', function(){
        $user = Session::get('user')? Session::get('user') : [];
        if($user !== []){
            return view('auth.edit', compact('user'));
        }
        return redirect('users');
    });
    Route::post('update-user', 'UserController@updateUser');
});

Route::post('update-message', 'ObserverResponseController@update');

Route::get('retro', 'ObserverController@retro');

Route::Resource('observer_response', 'ObserverResponseController');
Route::get('morning', 'ObserverResponseController@index');
Route::get('afternoon', 'ObserverResponseController@afternoon');
Route::get('evening', 'ObserverResponseController@evening');

Route::get('observer-reports', function(){
    return view('clerk.index');
});
Route::get('add-results', 'ResultsController@create');
Route::post('result-new','ResultsController@resultNew');

Route::get('responses', 'ObserverResponseController@responses');
Route::get('flagged-responses', 'ObserverResponseController@flagged');
Route::get('observer-questions', 'ObserverChecklistController@questions');

Route::get('rco', function(){
    return view('rco.index');
});
Route::post('flag-message', 'ObserverResponseController@flag');
Route::post('resolve', 'ObserverResponseController@resolve');
Route::get('resolving', 'ObserverResponseController@resolving');
Route::post('resolved', 'ObserverResponseController@resolved');
Route::get('completed', 'ObserverResponseController@completed');

Route::get('centres-all', 'CentreController@centres');
Route::get('centre/{id}', 'CentreController@centre');

// Results
Route::get('districts', 'DistrictsController@districts');
Route::get('district/{id}', 'DistrictsController@district');
Route::get('district', function(){
    $district = Session::get('district')? Session::get('district') : [];
    if($district !== []){
        return view('results.district', compact('district'));
    }
    return redirect('districts');
});

Route::get('constituencies', 'ConstituenciesController@constituencies');
Route::get('constituency/{id}', 'ConstituenciesController@constituency');
Route::get('constituency', function(){
    $constituency = Session::get('constituency')? Session::get('constituency') : [];
    if($constituency !== []){
        return view('results.constituency', compact('constituency'));
    }
    return redirect('constituencies');
});

Route::get('wards', 'WardsController@wards');
Route::get('centres', 'CentreController@centresAll');
Route::get('candidate/{id}', 'CandidateController@candidate');
Route::get('candidate', function(){
    $id = Session::get('id')? Session::get('id') : [];
    if($id !== []){
        return view('results.candidate', compact('id'));
    }
    return redirect('presidential-results');
});

Route::get('ward/{id}', 'WardsController@ward');
Route::get('ward', function(){
    $ward = Session::get('ward')? Session::get('ward') : [];
    if($ward !== []){
        return view('results.ward', compact('ward'));
    }
    return redirect('wards');
});

Route::get('response-reports', 'ReportsController@responses');

// ZODIAK ROUTES
Route::get('zodiak', 'ZodiakController@index');
Route::post('zodiak-results', 'ZodiakController@results')->name('zodiak-results');
Route::get('zodiak-edit', 'UserController@zodiakEdit');
Route::get('unresponsive', 'ObserverController@dosile');
Route::get('dosile', 'ObserverController@unresponsive');

Route::get('incident-data/{timeline}', 'ObserverResponseController@incidents');

Route::get('checklist/{question_no}', 'ObserverResponseController@checklistpage');
Route::get('checklist', function(){
    $question_no = Session::get('question_no')? Session::get('question_no') : [];
    if($question_no !== []){
        return view('admin.pages.checklist', compact('question_no'));
    }
    return redirect('/');
});
Route::get('checklist-response/{question_no}', 'ObserverResponseController@checklist');


