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


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('login','LoginController@show')->name('login');
Route::post('login','LoginController@login')->name('login');
Route::get('logout','LoginController@logout');


Route::get('inquiry/index','InquirysController@index');
Route::get('inquiry/{post}','InquirysController@show');

Route::get('MainPage','MainPageController@index')
	->name('MainPage');
Route::post('MainPage/addfollow','FollowUpController@store');


//Route::resource('/postmech','PostController');
Route::get('/post','PostController@index');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');