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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

	Route::middleware(['admin'])->group(function () {

		Route::get('dashboard', 'DashboardController@index');
	});

	Route::middleware(['teacher'])->group(function () {
		
		Route::get('panel', 'DashboardController@panel');
		Route::get('parents' , 'UsersController@parents');
	});

	Route::middleware(['parent'])->group(function () {
		Route::get('/home', 'HomeController@index');
		Route::get('/inbox', 'FeedbackController@index');
	});

	Route::resource('logbook','LogbookController');
	Route::get('profile','HomeController@profile');
	// Sharable Link Between roles
	Route::resource('feedback','FeedbackController');
	Route::resource('users','UsersController');
	Route::resource('students','StudentController');

	Route::get('change', 'UsersController@cp');
	Route::post('ch','UsersController@reset')->name('reset');
});



