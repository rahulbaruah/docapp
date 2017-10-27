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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function()
{
    Route::group(['namespace' => 'Admin'], function() {
        Route::group(['middleware' => ['role:admin']], function()
        {
            Route::resource('admin/users', 'UsersController');
        });
    });
    
    Route::group(['middleware' => ['role:admin,operator']], function()
    {
        Route::resource('doctors', 'DoctorsController');
            
        Route::get('searchpatient', 'PatientController@ShowSearch');
            
        Route::get('searchpatientform', 'PatientController@SearchPatient');
            
        Route::get('showreferred/{id}', 'PatientController@ShowReferredPatient');
        
        Route::post('updatereferred/{id}', 'PatientController@ReferredPatientEntry');
        
        Route::get('newpatient', 'PatientController@ShowNewPatientForm');
        
        Route::post('newpatient', 'PatientController@ReferPatientAdmin');
    });
    
});

/*Route::group(['middleware' => ['role:admin']], function()
{
    //Route::resource('admin/users', 'UsersController');
});*/
    

