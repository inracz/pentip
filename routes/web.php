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

Route::get('/', function () {
    return view('home');
});

Route::get('/users/{user}', 'UsersController@show')->name('users.show');
Route::get('/profile/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/profile', 'UsersController@update')->name('users.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
