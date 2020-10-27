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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('users','UsersController',['only'=>['index','show','edit','update']]);

    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

    Route::resource('tweets', 'TweetsController',['only'=>['index','create','store','show','edit', 'update','destroy']]);

    Route::resource('comments', 'CommentsController',['only'=> ['store']]);
    Route::resource('favorites', 'FavoritesController', ['only'=>['store','destroy']]);
});
