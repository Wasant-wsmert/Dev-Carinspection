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

// Route::get('/compaapi', function () {
//     return view('welcome');
// });



Route::get('/car_show', function () {
    return view('car_show');
});




Auth::routes();

Route::resource('/', 'ReportController');
Route::resource('/report', 'ReportController');
Route::resource('/service', 'ServiceController')->middleware('auth');
Route::resource('/edit', 'EditController');
Route::resource('/appointment', 'AppointmentController');
Route::resource('/add-inspection-appointment', 'AddInspectionCustoController');

// search
Route::get('/search','AppointmentController@search');
Route::get('/search_rep','ReportController@search');


Route::resource('/users', 'AddInspectionCarController');

// add data provin-district-subdistrict
Route::get('get-district-list','AddInspectionCustoController@getdistrictList');
Route::get('get-subdis-list','AddInspectionCustoController@getCityList');
// add data provin-model-submodel
Route::get('get-model-list','AddInspectionCustoController@getmodelList');
Route::get('get-submodel-list','AddInspectionCustoController@getsubmodelList');


// edit data provin-district-subdistrict
Route::get('get-districte-list','AppointmentController@getdistrictList');
Route::get('get-subdise-list','AppointmentController@getCityList');


// upload images arry
Route::get('images-upload', 'AddInspectionCarController@imagesUpload');
Route::post('images-upload', 'AddInspectionCarController@imagesUploadPost')->name('images.upload');



//fullcalender
// Route::get('/fullcalendar','FullCalendarController@index');
// Route::post('fullcalendar/create','FullCalendarController@create');
// Route::post('fullcalendar/update','FullCalendarController@update');
// Route::post('fullcalendar/delete','FullCalendarController@destroy');


// Route::get('events', 'EventController@index');

Route::resource('/technician', 'TechnicianController');

// from car_show
// Route::resource('car_show', 'car_showController');
