<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;

use App\Inquiry;
use App\Inquirer;
use App\Representative;
use Validator;
use View;

class InquirysController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');
    }

	public function addIndex()
    {

        $allreps = Representative::GetValuesinField('repName')->get()->toarray();

        $allreps = array_flatten($allreps);

    	return view('inquiry')
                 ->with('Allreps',$allreps)
                 ->with('Rep',Auth::user());
    }


    public function show($inquiryid)
    {
    	$inquiry = Inquiry::find($inquiryid);

    	return $inquiry;
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Log::info($input);
        $validator= Validator::make($input,[
                    'inquirerID' => 'bail|required',
                    'repID' => 'bail|required',
                    'inquiryDate' => 'bail|required',
                    'checkIn' => 'required',
                    'inquirySourceOther' => 'max:20',
                    'purposeOther' =>'max:50',]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        if($input["repID"] == Auth::user()->repID)
        {
            $newquiry = new Inquiry($input);
            Log::info($newquiry);
            
        }   


    }
}
