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

    public function modify($id)
    {
    	Log::info($id);
    	$tran = Transaction::find($id);
        return view('transaction.Modify')
                ->with('Rep', Auth::user())
                ->with('tran', $tran);
    }

    public function update(Request $request)
    {
    	$data = $request->all();
    	// Log::info($request);
    	unset($data['fullHouseID']);
    	Transaction::where('transactionID', $data['transactionID'])->update($data);
    }

    public function delete(Request $request)
    {
        Log::info($request->all());
        $info = $request->all();
        Transaction::where('transactionID', $info['transactionID'])->delete();
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

    public function add(Request $request){
        Log::info($request->all());
        $inquiryID = $request->input('inquiryID');
        if($inquiryID){

            $inquiry = \App\Inquiry::find($inquiryID);

            if($inquiry){

                $inquiry->status = "Completed";

                $trans =  new Transaction();
                $trans->inquiryID = $request->input('inquiryID');
                $trans->numberID = $request->input('numberID');
                $trans->status = 0;
                $trans->dayprice = $request->input('dayprice');
                if($request->input('discount')!=NULL)
                    $trans->discount = $request->input('discount');
                else 
                    $trans->discount = 1;
                $inquiry->save();
                $trans->save();
            }
            else{
                return response()->json(['status'=>'error','info'=>'No such inquiry in database'])
                                    ->header('Content-Type','json');
            }
        }

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
