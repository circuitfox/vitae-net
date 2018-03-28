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
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::middleware('auth')->get('/home', 'HomeController@index');

Route::get('/medication', function() {
    return view('medication');
});

Route::get('/scan', function() {
    return view('summary');
});

Route::post('/scan', 'SignatureController@store');

Route::get('/signatures', 'SignatureController@index')->name('signatures.index');

Route::middleware('auth')
    ->post('/signatures/delete', 'SignatureController@delete')
    ->name('signatures.delete');

Route::middleware('auth')->post('/orders/complete', 'OrderController@complete')->name('complete');

Route::middleware('auth')->get('/medformatter', function() {
    return view('medformatter');
});

Route::middleware('auth')->get('/patientformatter', function() {
    return view('patientformatter');
});

Route::middleware('auth')->resource('users', 'UserController');
Route::middleware('auth')->resource('medications', 'MedicationController');
Route::middleware('auth')->resource('patients', 'PatientController');
Route::middleware('auth')->resource('orders', 'OrderController');
Route::middleware('auth')->resource('labs', 'LabController');

Route::middleware('auth')->resource('mars', 'MarEntryController', ['only' => [
    'store', 'update'
]]);

Route::middleware('auth')
    ->get('/mars/create/{medical_record_number}', 'MarEntryController@create')
    ->name('mars.create');

Route::middleware('auth')
    ->get('/assessments/{medical_record_number}', 'AssessmentController@index')
    ->name('assessments');

Route::middleware('auth')
    ->post('/assessments/update/', 'AssessmentController@update')
    ->name('assessments.update');
