<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Inquiry; 
use App\InquiryFollow;


class FollowUpController extends Controller
{
    //
    public function __construct()
	{
		$this->middleware('auth');
	}


	public function store(Request $request)
	{
		$inquiry = Inquiry::find($request->input('inquiryID'));
		$newfollow = new InquiryFollow;
		$followup = $inquiry->getfollowup()->count()+1;
		$newfollow->followupStatus = $request->input('followupStatus');
		$newfollow->followupDate = $request->input('followupDate');
		$newfollow->followupID = $followup;
		$inquiry->getfollowup()->save($newfollow);
		Log::info($request->all());
		Log::info($newfollow);
		return redirect()->back();
	}
}
