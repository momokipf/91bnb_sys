<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Transaction;

class TransactionsController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
    	$tran = Transaction::all();
        return view('transaction.ShowAll')
                ->with('Rep', Auth::user())
                ->with('tran', $tran);
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
    public function store(Request $request) {
		Log::info($request->all());
		$storeInfo = array_slice($request->all(), 1);

		Inquirer::insert($storeInfo);
	}

    public function add(Request $request){
        Log::info($request->all());
        $trans =  new Transaction();
        $trans->inquiryID = $request->input('inquiryID');
        $trans->numberID = $request->input('numberID');
        $trans->status = 0;
        $trans->dayprice = $request->input('dayprice');
        if($request->input('discount')!=NULL)
            $trans->discount = $request->input('discount');
        else 
            $trans->discount = 1;

        $trans->save();

        if($request->ajax() || $request->wantsJson())
        {
            $json = [
                'status' => 'success'
            ];
            return response()->json(['status'=>"success"])
                            ->header('Content-Type', 'json');
        } 
        else{
            return ;
        }
    }
}
