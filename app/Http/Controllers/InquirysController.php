<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Inquiry;
use App\Inquirer;
use View;
use Log;

class InquirysController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
    {
    	$inquirys = Inquiry::all();

    	//return view('test',compact('inquirys'));
    }


    public function show($inquiryid)
    {
    	$inquiry = Inquiry::find($inquiryid);

    	return $inquiry;
    }

    public function search(Request $request){
        $search = Inquirer::searablefield($request->all());
        $ret = Inquirer::FindSimilar($search)->get();
        Log::info($ret);
        return $ret;
    }

}
