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
Route::get('/notifications', 'UsersController@notifications')->name('users.notifications');
Route::patch('/profile', 'UsersController@update')->name('users.update');

Route::get('/search', function() {
    return view('posts.search');
})->name('posts.search');

Route::get('/feed', 'PostsController@feed')->name('posts.feed');

Route::prefix('/posts')->name('posts.')->group(function () {
    Route::get('/', 'PostsController@index')->name('index');
    Route::get('/create', 'PostsController@create')->name('create');
    Route::get('/{post}', 'PostsController@show')->name('show');
    Route::get('/{post}/pdf', 'PostsController@pdf')->name('pdf');
    Route::get('/{post}/edit', 'PostsController@edit')->name('edit');

    Route::post('/{post}/toggleLike', 'PostsController@toggleLike')->name('toggleLike');
    Route::post('/', 'PostsController@store')->name('store');
    Route::patch('/{post}', 'PostsController@update')->name('update');

    Route::delete('/{post}', 'PostsController@destroy')->name('destroy');
});

Route::post('/posts/{post}/comments', 'CommentsController@store')->name('comments.store');

Route::post('/comments/{comment}/toggleLike', 'CommentsController@toggleLike')->name('comments.toggleLike');

Auth::routes();
