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

Route::get('/external-books{name?}', 'BookController@index');
Route::post('/v1/book', 'BookController@store');
Route::get('/v1/book', 'BookController@show');
Route::get('/v1/book/{id}', 'BookController@showBook');
Route::patch('/v1/book/{id}', 'BookController@update');
Route::delete('/v1/book/{id}', 'BookController@destroy');
