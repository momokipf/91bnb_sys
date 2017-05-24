<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Redirector;

use App\Inquiry;
use App\Inquirer;
use App\Representative;
use Validator;
use View;
use DB;

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

    	return view('inquiry/add')
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
            $inquirer = Inquirer::find($input["inquirerID"]);
            $inquirer->queries()->save($newquiry);
        }   
    }

    public function searchIndex()
    {

        return view('inquiry/search')
                //->with('Allreps',$allreps)
                ->with('Rep',Auth::user());
    }




    public function search(Request $request)
    {
        Log::info($request->all());
        $inquiryid = $request->input('inquiryID');
        if($inquiryid)
        {
            $inquiry = Inquiry::find($inquiryid);
            if($inquiry)
            {
                return response($inquiry)->header('Content-Type', 'json');
            }
        }

        $inquirysearchField = $request->only('inquiryDate','inquiryDateFrom','inquiryDateTo','inquiryPriorityLevel','inquirycity');
        $querybuilder = null;
        $rep = Auth::user();
        if($rep->repPriority>3){
            $querybuilder = $rep->queries()->SearchbyField($inquirysearchField);
        }
        else{
            $querybuilder = Inquiry::SearchbyField($inquirysearchField);
        }

        $inquirerinfo = $request->only(['inquirerFirst','inquirerLast','wechatname','inquirerWechatID']);
        if($inquirerinfo['inquirerFirst'])
        {
                $querybuilder = $querybuilder->whereHas('quirer',function($query) use($inquirerinfo){
                    $query->where('inquirerFirst','LIKE',$inquirerinfo['inquirerFirst']);
                });
        }

        if($inquirerinfo['inquirerLast'])
        {
                $querybuilder = $querybuilder->whereHas('quirer',function($query) use($inquirerinfo){
                    $query->where('inquirerLast','LIKE',$inquirerinfo['inquirerLast']);
                });
        }
        if($inquirerinfo['inquirerWechatID'])
        {
                $querybuilder = $querybuilder->whereHas('quirer',function($query) use($inquirerinfo){
                    $query->where('inquirerWechatID','LIKE',$inquirerinfo['inquirerWechatID']);
                });
        }
        $ret = $querybuilder->paginate(4);

        $allreps = Representative::GetValuesinField('repName')->get()->toarray();

        $allreps = array_flatten($allreps);
        // return response($ret)
        //         ->header('Content-Type', 'json');
        return view('test')
                ->with('Rep',$rep)
                ->with('Hotquerys',$ret)
                ->with('Allreps',$allreps);
    }

}
