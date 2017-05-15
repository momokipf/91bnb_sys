<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Representative;
use App\Inquiry;
use Session;
use Log;

class MainPageController extends Controller
{
    //



	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index(Request $request)
    {

    	// if(Auth::check())
    	// {
    	// 	redirect('login');
    	// }
    	$itemsEachPage = 10;
    	$items = NULL;
    	$rep = Auth::user();
    	if($rep->repPriority >2 ){
    		$items = $rep->queries()->HotQuerys()->count();
    		//$hotInquiry = $rep->queries()->HotQuerys()->skip($offset*$itemsEachPage)->take($itemsEachPage)->get();
    		$hotquerys = $rep->queries()->HotQuerys()->paginate($itemsEachPage);
    	}
    	else
    	{
    		$items = Inquiry::HotQuerys()->count();
    		//$hotInquiry = Inquiry::HotQuerys()->skip($offset*$itemsEachPage)->take($itemsEachPage)->get();
    		$hotquerys = Inquiry::HotQuerys()->with('reprensent')->paginate($itemsEachPage);
    	}
    	$allreps = Representative::GetValuesinField('repName')->get()->toarray();

    	$allreps = array_flatten($allreps);
    	Log::info($allreps);
    	//$item = $hotInquirys->count();
    	// if(!$request->session()->has('page')){
    	// 	$page = intval($items/$itemsEachPage);
    	// 	if($page==0)
    	// 	{
    	// 		$page = 1;
    	// 	}
    	// 	$request->session()->put('page',$page);
    	// 	//Log::info('get page from calculate');
    	// }
    	// else{
    	// 	Log::info('get page from session');
    	// 	$page =  $request->session()->get('page');
    	// }
    	return view('MainPage')
    		->with('hotquerys',$hotquerys)
    		->with('items',$items)
    		->with('Allreps',$allreps)
    		->with('Rep',Auth::user());
    }
}
