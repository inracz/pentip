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

Route::get('/posts/create', 'PostsController@create')->name('posts.create');
Route::get('/posts/{post}', 'PostsController@show')->name('posts.show');
Route::post('/posts', 'PostsController@store')->name('posts.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
