<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use DB;
use App\Houseowner;


class HouseOwnersController extends Controller
{
    //

    private $searchFields = array('houseOwnerID','first','last','ownerWechatID','ownerWechatUserName','ownerUsPhoneNumber');

	public function __construct() {
		$this->middleware('auth');
	}

    public function ownerinfo(Request $request, $ownerid,$forhouse = null)
    {

    	$owner = Houseowner::find($ownerid);
        Log::info($forhouse);
		if ($request->ajax() || $request->wantsJson())
		{
            if($forhouse){
                if($owner)
                    return response($owner->houses)
                    ->header('Content-Type', 'json');
                else 
                    return response($owner)
                        ->header('Content-Type', 'json');
            }
            else{
                return response($owner)
                    ->header('Content-Type', 'json');
            }
    	}
    	else 
    		return view('house.Houseowner')
    				->with('Rep',Auth::user())
    				->with('houseowner',$owner);
    }

    /*
    * Search houseowner 
    * @para $keypair: is a array of key-value pairs that need to match in database
    *       $andOr: 1."AND" 2."OR"
    * Author: Moki
    * 
    */
    public function search(Request $request,$similar=null){
        $houseownerSearchField = $request->only($this->searchFields);
        Log::info($houseownerSearchField);
        $querybuilder = null;

        // foreach($this->searchFields as $field){
        //     if(!$houseownerSearchField[$field]){
        //         continue;
        //     }
        //     if(!$querybuilder){
        //         $querybuilder = Houseowner::where($field,'LIKE',$houseownerSearchField[$field]);
        //     }
        //     else{
        //         $querybuilder = $querybuilder->orwhere($field,'LIKE',$houseownerSearchField[$field]);
        //     }
        // }

        if($similar){
            Log::info("similar has been set".$similar);
            $querybuilder = Houseowner::FindSimilar($houseownerSearchField,'OR');
        }
        else{
            Log::info("similar has not been set");
            $querybuilder = Houseowner::FindSimilar($houseownerSearchField,'AND');
        }   

        $similarowner = $querybuilder->get();

        Log::info(DB::getQueryLog());

        if($request->ajax() || $request->wantsJson()){
            return response($similarowner)
                        ->header('Content','json');
        }

    }

    public function add(Request $request){
        Log::info($request->all());
        $houseownerSearchField = $request->only($this->searchFields);
        $isduplicate = !(Houseowner::FindSimilar($houseownerSearchField,'AND')->count()==0);
        $houseownerSearchField = $request->only($this->searchFields);
        if($isduplicate==TRUE){
            $duplicateRecords = Houseowner::FindSimilar($houseownerSearchField,'AND')->get();
            Log::info($duplicateRecords);
            if($request->ajax() || $request->wantsJson()){
                return response()
                    ->json(['duplicate'=>$isduplicate,'ownerid'=>$duplicateRecords])
                    ->header('Content','json');
            }
        }
        else{
            $input = $request->all();
            $usPhoneNumber = preg_replace("/[^0-9,.]/", "", $_POST['ownerUsPhoneNumber']);
            $usPhoneNumber = "(".substr($usPhoneNumber,0,3).")".substr($usPhoneNumber,3,3)."-".substr($usPhoneNumber,6,4);
            $newowner = new \App\Houseowner([
                'first' => $input['first'],
                'last' => $input['last'],
                'ownerCompanyName' => $input['ownerCompanyName'],
                'ownerUsPhoneNumber' => $usPhoneNumber,
                'ownerPhone2Country' => $input['ownerPhone2Country'],
                'ownerPhone2Number' => $input['ownerPhone2Number'],
                'ownerEmail' => $input['ownerEmail'],
                'ownerWechatUserName' => $input['ownerWechatUserName'],
                'ownerWechatID' => $input['ownerWechatID'],
                'ownerOtherID' => $input['ownerOtherID'],
                'bankAccountName' => $input['bankAccountName'],
                'bankName'=> $input['bankName'],
                'bankRountingNumber'=> $input['bankRountingNumber'],
                'bankAccountNumber' => $input['bankAccountNumber'],
                'houseownerID' => 0,
                ]);
            $houseownerID = $newowner->getownerID();
            $newowner->save();
            if($request->ajax() || $request->wantsJson()){
                return response()
                    ->json(['duplicate'=>$isduplicate,'ownerid'=>$houseownerID])
                    ->header('Content','json');
            }
        }

    }
}
