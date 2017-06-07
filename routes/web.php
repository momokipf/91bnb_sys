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
use Illuminate\Support\Facades\Log;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('login','LoginController@show')->name('login');
Route::post('login','LoginController@login')->name('login');
Route::get('logout','LoginController@logout');

Route::get('resource/{typename}','ResourceController@getlist');
Route::get('resource/{country}/{state}','ResourceController@getCity');

Route::get('inquiry/add','InquirysController@addIndex');
Route::post('inquiry/add','InquirysController@store');
Route::get('inquiry/search','InquirysController@searchIndex');
Route::get('inquiry/search/result','InquirysController@search');

Route::get('inquiry/{post}','InquirysController@show');


//Route::get('addinquiry',    function(){return view('inquiry');});

Route::get('MainPage','MainPageController@index')
	->name('MainPage');
Route::post('MainPage/addfollow','FollowUpController@store');


Route::post('inquirer/search/{similar?}','InquirersController@search');
Route::get('inquirer/showAll', 'InquirersController@show');
Route::post('inquirer/searchForModify/{similar?}','InquirersController@searchForModify');
Route::patch('inquirer/modifyInquirer', 'InquirersController@modifyInquirer');
Route::get('inquirer/searchAndModify', 'InquirersController@searchAndModify');
Route::post('inquirer/searchAndModify', 'InquirersController@searchAndModify');
Route::post('inquirer/add', 'InquirersController@store');


Route::get('house','HousesController@searchindex');
Route::get('house/add','HousesController@addindex');
Route::post('house/search','HousesController@search');


Route::post('houseowner/search',function(){
	$ret = collect([['houseOwnerID'=>'5','first'=>'Jay','last'=>'Chou','ownerWechatUserName'=>'jaywechat']]);
	Log::info(response($ret)
			->header('Content-Type','json'));
	return response($ret)
			->header('Content-Type','json');
});

Route::get('representatives', 'RepresentativesController@showAll');
Route::post('representatives/update', 'RepresentativesController@update');
Route::post('representatives/add', 'RepresentativesController@store');

Route::get('report/houseReport', 'HousesController@report');
Route::get('report/houseVisual', function() {
	return view('report.houseVisual');
});



//Route::resource('/postmech','PostController');
Route::get('/post','PostController@index');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

