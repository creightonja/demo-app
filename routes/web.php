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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    #### Studies
    Route::get('studies', 'StudyController@indexAll')->name('studies.index');
	Route::get('sponsors/{sponsor}/studies/selectcro', 'StudyController@selectCro')->name('sponsors.studies.selectcro');
	Route::resource('sponsors.studies', 'StudyController');

	### Studies.study-services
	Route::resource('studies.study-services', 'StudyServiceController');

	### Studies.study-services
	Route::resource('studies.study-costs', 'StudyCostController');

 
});
