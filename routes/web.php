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

Route::get('/',function(){
	 return redirect('/MainPage');
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


Route::get('housesearchindex','HousesController@searchindex');
Route::get('house/info/{id}','HousesController@showhouse');
Route::get('house/add','HousesController@addindex');
Route::post('house/add','HousesController@store');
Route::post('house/search','HousesController@search');
Route::get('house/modify','HousesController@modify');
Route::post('house/searchByAddress','HousesController@searchByAddress');
Route::post('house/searchByID','HousesController@searchByID');
Route::post('house/searchOwner','HousesController@searchOwner');
Route::post('house/searchByOwner','HousesController@searchByOwner');
Route::get('house/modify/{numberID}','HousesController@modifyHouse');




Route::get('houseowner/{id}/{house?}','HouseOwnersController@ownerinfo');
Route::post('houseowner/search','HouseOwnersController@search');

Route::get('representatives', 'RepresentativesController@showAll');
Route::post('representatives/update', 'RepresentativesController@update');
Route::post('representatives/add', 'RepresentativesController@store');

Route::get('report/houseReport', 'HousesController@report');
Route::get('report/houseVisual', function() {
	return view('report.houseVisual');
});
Route::get('report/getHouse', 'HousesController@reportingSearch');
Route::get('report/houseTotal', 'HousesController@houseTotal');
Route::get('report/houseLocation', 'HousesController@houseLocation');
Route::get('report/getCityCount/{state}', 'HousesController@getCityCount');



//Route::resource('/postmech','PostController');
Route::get('/post','PostController@index');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

