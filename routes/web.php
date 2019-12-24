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
Route::post('/home', 'HomeController@publish');

Route::get('/user/{id}', 'ProfileController@viewProfile');
Route::post('/user/{id}', 'ProfileController@updateInfo');


Route::post('/social-media', 'ProfileController@createSocialNetwork');
Route::post('/social-media/{id}/delete', 'ProfileController@deleteSocialNetwork');

Route::get('/post/{id}', 'PostController@viewPost');
Route::post('/post/{id}', 'PostController@updatePost');

Route::post('/post/{id}/delete', 'HomeController@deletePost');
Route::post('/profile/post/{id}/delete', 'ProfileController@deletePost');

Route::post('/follow/{id}', 'HomeController@follow');
Route::post('/unfollow/{id}', 'HomeController@unfollow');

Route::get('/event/{id}', 'EventController@index');
Route::post('/event', 'EventController@createEvent');
Route::post('/event/{id}/delete', 'ProfileController@deleteEvent');
