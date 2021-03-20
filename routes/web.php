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

// Route::get('/', function () { return view('welcome');});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// form
// Route::get('/form', function () { return view('form.form');});
// ------FormsController ------
Route::get('form','App\Http\Controllers\FormsController@locationCR');
Route::get('/getdistrict/{id}', 'App\Http\Controllers\FormsController@getDistrict');
Route::get('/getTumbol/{id}', 'App\Http\Controllers\FormsController@getTumbol');
Route::get('/getVillage/{amp}/{tambol}', 'App\Http\Controllers\FormsController@getVillage');

Route::POST('form/formsubmit', 'App\Http\Controllers\FormsController@formSubmit')->name('form.formsubmit');
Route::POST('form/formupdate', 'App\Http\Controllers\FormsController@formUpdate')->name('form.formupdata');
Route::get('/remove/{id}', 'App\Http\Controllers\FormsController@formDelete');


Route::get('/', function () { return view('guest.index');})->name('form');
// Route::get('/list', function () { return view('form.list');})->name('list');
Route::get('/list', 'App\Http\Controllers\DataSurveyController@getDatatoTable')->name('list');;
Route::get('/edit/{weir_code}', 'App\Http\Controllers\DataSurveyController@formEdit');


// data to Display
Route::get('form/getDataSurvey/{amp}', 'App\Http\Controllers\DataSurveyController@getDataSurvey')->name('form.getDataSurvey');

// report
Route::get('/pdf/{id}', 'App\Http\Controllers\ReportPDFController@pdf_index');
