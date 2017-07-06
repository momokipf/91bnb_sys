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
use App\RoomRequirement;

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

        $allreps = Representative::GetValuesinField('repName')->get();

        // $allreps = array_flatten($allreps);

    	return view('inquiry.Add')
                 ->with('Allreps',$allreps)
                 ->with('Rep',Auth::user());
    }


    public function show($inquiryid)
    {
    	$inquiry = Inquiry::find($inquiryid);

    	return $inquiry;
    }

    /** 
      * @desc:
      * @parameter
      * @return:         
      * @author: Moki Yichen(patch_1) 
      * @required
    */

    public function store(Request $request)
    {
        $input = $request->all();
        Log::info($input);
        $validator= Validator::make($input,[
                    'inquirerID' => 'bail|required',
                    // 'repID' => 'bail|required',
                    'inquiryDate' => 'bail|required',
                    'checkIn' => 'required',
                    'inquirySourceOther' => 'max:20',
                    'purposeOther' =>'max:50',]);
        if($validator->fails())
        {
            return $validator->errors();
        }

        // $input["repID"] = Representative::where('repUserName', $input['repWithOwner'])->first()->repID;
        // unset($input['_token']);
        // unset($input['repWithOwner']);
        // unset($input["room1Type"]);
        // unset($input["room1TypeOther"]);
        // unset($input["room2Type"]);
        // unset($input["room2TypeOther"]);
        // Log::info($input);
        // $id = Inquiry::insertGetId($input);

        // $data = $request->all();
        // $room = array();
        // for ($i = 1; $i <= 2; $i++) {
        //     if ($data["room".$i."Type"] != null) {
        //         $room["inquiryID"] = $id;
        //         $room["roomID"] = $i;
        //         $room["roomType"] = $data["room".$i."Type"];
        //         $room["roomTypeOther"] = $data["room".$i."TypeOther"];
        //         Log::info($room);
        //         RoomRequirement::insert($room);
        //     }
        // }

        $input["repID"] = Representative::where('repUserName', $input['repWithOwner'])->first()->repID;
        $newinquiry = new Inquiry($input);
        Log::info($newinquiry);
        $inquirer = Inquirer::find($input["inquirerID"]);
        $inquirer->queries()->save($newinquiry);

        if($request->ajax()||$request->wantsJson()){
            return response()->json(['status'=>'success']);
        }
    }

    public function searchIndex()
    {

        return view('inquiry.Search')
                //->with('Allreps',$allreps)
                ->with('Rep',Auth::user());
    }




    public function search(Request $request)
    {
        $itemsEachPage = 10;
        // find by inquiry ID
        $inquiryid = $request->input('inquiryID');
        if($inquiryid)
        {
            $inquiry = Inquiry::where('InquiryID','=',$inquiryid);
            if($inquiry)
            {
                //return response($inquiry)->header('Content-Type', 'json');
                $hotquerys = $inquiry->paginate($itemsEachPage);
                //dd($hotquerys);
                return view('inquiry.Search') 
                    ->with('hotquerys',$hotquerys)
                    ->with('Rep',Auth::user());

            }
        }

        // find by other data
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
        
        //$hotquerys = $querybuilder->with('roomType')->with('quirer')->get();
        $hotquerys = $querybuilder->with('roomType')->with('quirer')->paginate($itemsEachPage);
        

        return view('inquiry.Search') 
                    ->with('hotquerys',$hotquerys)
                    ->with('Rep',Auth::user());
                
        // return response($hotquerys)
        //         ->header('Content-Type', 'json');
    }


    public function modifyinquiry($inquiryID) {
        $allreps = Representative::GetValuesinField('repName')->get();
        Log::info($inquiryID);
        $inquiry = Inquiry::where('inquiryID', $inquiryID)->with('represent')->first();
        return view('inquiry.ModifyInquiry')
                ->with('Allreps',$allreps)
                ->with('inquiry', $inquiry)
                ->with('Rep',Auth::user());
    }

    public function update(Request $request){
        Log::info($request->all());
    }

    // public function result(Request $request){


    //     $queries = session('result');
    //     $paginator = new Paginator($queries,3,1,[ 'path'  => $request->url()]);

    //     Log::info($request->url());
    //     return view('test')
    //             ->with('paginator',$paginator);
    // }


}
