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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('index');
Route::match(['get','post'],'/login', 'Auth\LoginController@login')->name('login');

Route::get('/all-events', 'ApiController@showAllEvents')->name('showAllEvents');


Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/logout', 'HomeController@logout')->name('logout');


	Route::get('/events', 'HomeController@events')->name('events');
	Route::match(['get','post'],'/events/create', 'HomeController@newEvent')->name('newEvent');
    Route::get('/events/{id}/edit', 'HomeController@editEvent')->name('editEvent');
    Route::post('/delete-event', 'HomeController@deleteEvent')->name('deleteEvent');
	Route::match(['get','post'],'/update-event', 'HomeController@updateEvent')->name('updateEvent');
});
