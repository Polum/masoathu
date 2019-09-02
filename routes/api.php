<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', 'UserController@apiUsers');

Route::get('regions','DistrictsController@regions');
// Districts
Route::get('districts','DistrictsController@index');
Route::get('districts/all','DistrictsController@indexAll');
Route::get('districts/list','DistrictsController@listAll');
Route::get('district/{id}','DistrictsController@show');

// Constituencies
Route::get('constituencies','ConstituenciesController@index');
Route::get('constituencies/all','ConstituenciesController@indexAll');
Route::get('constituencies/list','ConstituenciesController@listAll');
Route::get('constituency/{id}','ConstituenciesController@show');

// ward 
Route::get('wards','WardsController@index');
Route::get('wards/all','WardsController@indexAll');
Route::get('wards/list','WardsController@listAll');
Route::get('ward/{id}','WardsController@show');

// centres
Route::get('centres','CentreController@index');
Route::get('centres/all','CentreController@indexAll');
Route::get('centres/list','CentreController@listAll');

// Parties
Route::get('parties','PartiesController@index');
Route::get('parties/all','PartiesController@indexAll');

// Results
Route::get('results','ResultsController@listed');
Route::get('results/all','ResultsController@all');
    //List Single
Route::get('result/{id}','ResultsController@show');
    //create new
Route::post('result-new','ResultsController@store');
    //update articles
Route::post('result-update','ResultsController@update');

// Observer
Route::get('observers','ObserverController@apiIndex');
Route::get('observers/all','ObserverController@apiIndexAll');
    //List Single
Route::get('observer/{id}','ObserverController@apiShow');
Route::get('observer-questions', 'ObserverChecklistController@questions');

// Response
Route::post('response-new', 'ObserverResponseController@store');
Route::post('sms/recieve', 'ObserverResponseController@sms');
Route::post('response-update','ObserverResponseController@update');
Route::get('resolving', 'ObserverResponseController@resolving');

Route::get('ontime', 'ObserverResponseController@ontime');
Route::post('flag-message', 'ObserverResponseController@flag');
Route::post('seen-message', 'ObserverResponseController@seen');

Route::get('candidates','ResultsController@candidates');
Route::get('candidates/results','ResultsController@candidatesAll');
Route::get('candidates/all','CandidateController@indexAll');
Route::get('candidates/list','CandidateController@show');
Route::get('candidate/{id}','CandidateController@showOne');