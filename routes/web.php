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

Route::get('/', 'ViewBookController@home')->name('refresh');

Route::get('/view-books', 'ViewBookController@displayBooks')->name('books-view');
Route::get('/edit-book/{id}', 'ViewBookController@editBook')->name('book-edit');
Route::match(['put','patch'],'/edit-book/{id}', 'ViewBookController@updateBook')->name('book-update');
Route::delete('/delete-book/{id}', 'ViewBookController@destroy')->name('book-delete');
