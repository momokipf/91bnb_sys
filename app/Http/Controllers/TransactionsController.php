<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }	

    public function show(Request $request)
    {
        return view('transaction.showAll')
                ->with('Rep',Auth::user());
    }

    public function confirmInquiry(Request $request){

    	$inquiryID = $request->input('inquiryID');
    	$houseID = $request->input('houseID');

    	$inquiry = \App\Inquiry::with('quirer')->find($inquiryID);
    	$house = \App\House::with('houseowner')->with('houseprice')->find($houseID);
    	if($inquiry){
    		return view('transaction.confirmation')
    			->with('inquiry',$inquiry)
    			->with('house',$house)
                ->with('Rep',Auth::user());
    	}
    	else{

    	}
    }
}
