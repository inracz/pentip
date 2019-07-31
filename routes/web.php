<?php

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
Route::prefix('api')->name('api.')->group(function() {

    Route::post('/comments/{comment}/toggleLike', 'CommentsController@toggleLike')->name('comments.toggleLike');

    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', 'Api\\PostsController@index')->name('index');
        Route::get('feed', 'Api\\PostsController@feed')->name('feed');
        Route::get('bookmarks', 'Api\\PostsController@bookmarks')->name('bookmarks');
        Route::get('/{post}/pdf', 'Api\\PostsController@pdf')->name('pdf');
        Route::post('/{post}/toggleLike', 'Api\\PostsController@toggleLike')->name('toggleLike');
        Route::post('/{post}/toggleBookmark', 'Api\\PostsController@toggleBookmark')->name('toggleBookmark');
        Route::post('/', 'Api\\PostsController@store')->name('store');
        Route::patch('/{post}', 'Api\\PostsController@update')->name('update');
        Route::delete('/{post}', 'Api\\PostsController@destroy')->name('destroy');
    });

});



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
Route::get('/feed', 'PostsController@feed')->name('user.feed');
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
Route::post('/users/{user}/toggleSubscribe', 'UsersController@toggleSubscribe')->name('users.toggleSubscribe');
Route::get('/profile/edit', 'UsersController@edit')->name('users.edit');
Route::get('/notifications', 'UsersController@notifications')->name('users.notifications');
Route::patch('/profile', 'UsersController@update')->name('users.update');

Route::get('/search', function() {
    return view('posts.search');
})->name('posts.search');

Route::prefix('/posts')->name('posts.')->group(function () {

    Route::get('/bookmarks', 'PostsController@bookmarks')->name('bookmarks');
    Route::get('/create', 'PostsController@create')->name('create');
    Route::get('/{post}', 'PostsController@show')->name('show');
    Route::get('/{post}/edit', 'PostsController@edit')->name('edit');

});

Route::post('/posts/{post}/comments', 'CommentsController@store')->name('comments.store');

Auth::routes();
