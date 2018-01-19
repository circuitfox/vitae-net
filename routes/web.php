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

Route::middleware('auth')->get('/admin', function() {
    return view('admin');
})->name('admin');

Route::get('/medication', function() {
    return view('medication');
});

Route::get('/scan', function() {
    return view('summary');
});

Route::post('/scan', function() {
    return redirect('/');
});

Route::middleware('auth')->resource('users', 'UserController');
Route::middleware('auth')->resource('medications', 'MedicationController');
Route::middleware('auth')->resource('patients', 'PatientController');
