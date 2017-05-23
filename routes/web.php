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

Route::get('resource/{typename}','ResourceController@getlist');

Route::get('inquiry/add','InquirysController@addIndex');
Route::post('inquiry/add','InquirysController@store');
Route::get('inquiry/search','InquirysController@searchIndex');
Route::get('inquiry/search/result','InquirysController@search');

Route::get('inquiry/{post}','InquirysController@show');
Route::get('test','InquirysController@result');


//Route::get('addinquiry',    function(){return view('inquiry');});

Route::get('MainPage','MainPageController@index')
	->name('MainPage');
Route::post('MainPage/addfollow','FollowUpController@store');


Route::post('inquirer/search/{similar?}','InquirersController@search');


Route::get('inquirer/showAll', 'InquirersController@show');

Route::post('inquirer/search/{similar?}','InquirersController@searchForModify');
Route::get('inquirer/searchAndModify', 'InquirersController@searchAndModify');
Route::post('inquirer/searchAndModify', 'InquirersController@searchAndModify');

//Route::resource('/postmech','PostController');
Route::get('/post','PostController@index');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

