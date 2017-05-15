<?php

namespace App\Http\Controllers;


use App\Inquiry;
use Illuminate\Http\Request;


use View;
use Log;

class InquirysController extends Controller
{
    //


	public function index()
    {
    	$inquirys = Inquiry::all();

    	return view('test',compact('inquirys'));
    }


    public function show($inquiryid)
    {
    	$inquiry = Inquiry::find($inquiryid);

    	return $inquiry;
    }

}
