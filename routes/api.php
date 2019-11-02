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


Route::post('exams/store', 'ExamsController@store');
Route::post('exams/update/{id}', 'ExamsController@update');
Route::post('exams/delete/{id}', 'ExamsController@destroy');
Route::get('exams/list', 'ExamsController@list');
Route::get('exams','ExamsController@index')

?>