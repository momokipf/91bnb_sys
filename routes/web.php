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
use Illuminate\Support\Facades\View;


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
Route::get('image/{imageID}','HouseImagesController@getImg');
//Route::get()


Route::get('inquiry/add','InquirysController@addIndex');
Route::post('inquiry/add','InquirysController@store');
Route::get('inquiry/search','InquirysController@searchIndex');
Route::get('inquiry/search/modify/{inquiryID}','InquirysController@modifyinquiry');
Route::get('inquiry/search/result','InquirysController@search');
Route::post('inquiry/update/{inquiryID}','InquirysController@update');
Route::get('inquiry/housepair','InquirysController@housepair');

Route::post('inquiry/search/addfollow','FollowUpController@store');

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
Route::get('houses/results','HousesController@searchpage');
Route::get('houses/realsearch','HousesController@search');


Route::get('house/info/{id}','HousesController@showhouse');
Route::get('house/add','HousesController@addindex');
Route::post('house/add','HousesController@store');
Route::post('house/search','HousesController@search');
Route::get('house/modify','HousesController@modify');
Route::post('house/searchByAddress','HousesController@searchByAddress');
Route::post('house/searchByID','HousesController@searchByID');
Route::post('house/searchByOwner','HousesController@searchByOwner');
Route::get('house/modify/{numberID}','HousesController@modifyHouse');
Route::post('house/modify/store','HousesController@update');



Route::get('houseowner/{id}/{house?}','HouseOwnersController@ownerinfo');
Route::post('houseowner/search/{similar?}','HouseOwnersController@search');
Route::post('houseowner/add','HouseOwnersController@store');

Route::get('houseavailability/{id}','HouseAvailabilityController@get');
Route::post('houseavailability/{id}/insert','HouseAvailabilityController@insert');
Route::post('houseavailability/{id}/update','HouseAvailabilityController@update');


Route::get('calendar',function(){
	return view('admin.checkinoutCal')->with('Rep',Auth::user());
});



//tmp put this function in houseavailabilitycontroller
Route::get('calendar/data','HouseAvailabilityController@fromSource');

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


Route::get('transaction/showAll', 'TransactionsController@show');




//Route::resource('/postmech','PostController');
Route::get('/post','PostController@index');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

