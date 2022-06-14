<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/events', 'ApiController@events')->name('api.events');
Route::get('/events/active-event', 'ApiController@activeEvents')->name('api.activeEvents');
Route::get('/events/{id}', 'ApiController@getEvent')->name('api.getEvent');
Route::post('/events', 'ApiController@saveEvents')->name('api.saveEvents');
Route::put('/events/{id}', 'ApiController@addOrUpdateEvent')->name('api.addOrUpdateEvent');
Route::patch('/events/{id}', 'ApiController@updateEvent')->name('api.updateEvent');
Route::delete('/events/{id}', 'ApiController@deleteEvent')->name('api.deleteEvent');
