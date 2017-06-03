<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Representative;
use App\Inquiry;
use Session;

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
    		$hotquerys = Inquiry::HotQuerys()->with('represent')->paginate($itemsEachPage);
    	}

    	$allreps = Representative::RepName()->get()->toarray();

    	$allreps = array_flatten($allreps);

        //dd($allreps);
    	return view('MainPage')
    		->with('Hotquerys',$hotquerys)
    		->with('Items',$items)
    		->with('Allreps',$allreps)
    		->with('Rep',Auth::user());
    }
}
