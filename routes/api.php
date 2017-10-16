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

Route::middleware(['auth:api'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/referpatient', 'PatientController@ReferPatient');
    
    Route::get('/report', 'ReportController@AppReport');
    
    Route::get('/last2report', 'ReportController@Last2Report');
    
    Route::get('/filterreport', 'ReportController@filterReport');
    
    Route::get('/doctorprofile', 'DoctorsController@profile');
    
});
