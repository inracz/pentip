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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/users/{user}', 'UsersController@show')->name('users.show');
Route::post('/users/{user}/toggleSubscribe', 'UsersController@toggleSubscribe')->name('users.toggleSubscribe');
Route::get('/profile/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/profile', 'UsersController@update')->name('users.update');

Route::get('/posts/create', 'PostsController@create')->name('posts.create');
Route::get('/posts/{post}', 'PostsController@show')->name('posts.show');
Route::post('/posts', 'PostsController@store')->name('posts.store');
Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy');

Route::post('/posts/{post}/comments', 'CommentsController@store')->name('comments.store');

Auth::routes();
