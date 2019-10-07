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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users','UserController@getAll');
Route::post('/users','UserController@set');
Route::get('/users/{id}','UserController@get');
Route::post('/users/{id}','UserController@update');
Route::delete('/users/{id}','UserController@destroy');
