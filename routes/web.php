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

Route::get('/', function() {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

// TODO: Merge this with the other admin dashboard (/home)?
Route::middleware('auth')->get('/admin', function() {
    return view('admin');
})->name('admin');

Route::middleware('auth')->get('/home', 'HomeController@index');

Route::get('/medication', function() {
    return view('medication');
});

Route::get('/scan', function() {
    return view('summary');
});

Route::post('/scan', function() {
    return redirect('/');
});

Route::middleware('auth')->post('/orders/complete', 'OrderController@complete')->name('complete');

Route::get('/medformatter', function(){
    return view('medformatter');
});

Route::get('/patientformatter', function(){
    return view('patientformatter');
});

// TODO: Add policies to control access to patients, orders, labs routes
Route::middleware('auth')->resource('users', 'UserController');
Route::middleware('auth')->resource('medications', 'MedicationController');
Route::middleware('auth')->resource('patients', 'PatientController');
Route::middleware('auth')->resource('orders', 'OrderController');
Route::middleware('auth')->resource('labs', 'LabController');
