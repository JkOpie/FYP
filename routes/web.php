<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/evidence', 'EvidenceController@index');
Route::get('/evidence/{id}', 'EvidenceController@delete');
Route::get('/evidence_search', 'EvidenceController@report_search');

Route::post('/createreport', 'EvidenceController@CreateReport');

Route::get('/report','EvidenceController@report');
Route::get('/report/{id}','EvidenceController@view_event');
Route::get('/report_delete/{id}','EvidenceController@delete_report');
Route::get('/report_delete_evidence/{id}', 'EvidenceController@delete_evidence_report');
Route::get('/report_search', 'EvidenceController@report_evidence_search');
Route::get('/report_search/go', 'EvidenceController@report_search_go');


Route::get('/pdf/{id}','EvidenceController@pdf');
Route::get('/test_pdf/{id}', 'EvidenceController@test_pdf');

Route::get('/user/{id}', 'EvidenceController@UserPage');
Route::post('/user/image', 'EvidenceController@imageUploadPost');
Route::post('/user/update', 'EvidenceController@UserUpdate');

Route::get('/maps/{id}', 'EvidenceController@maps');
Route::get('/fly/{id}', 'EvidenceController@flyto');
