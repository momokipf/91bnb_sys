<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Houseowner;


class HouseOwnersController extends Controller
{
    //

    private $searchFields = array('first','last','ownerWechatID','ownerWechatUserName');

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


    public function search(Request $request){
        $houseownerSearchField = $request->only($this->searchFields);
        Log::info($houseownerSearchField);
        $querybuilder = null;


        foreach($this->searchFields as $field){
            if(!$houseownerSearchField[$field]){
                continue;
            }
            if(!$querybuilder){
                $querybuilder = Houseowner::where($field,'LIKE',$houseownerSearchField[$field]);
            }
            else{
                $querybuilder = $querybuilder->orwhere($field,'LIKE',$houseownerSearchField[$field]);
            }
        }

        $similarowner = $querybuilder->get();

        if($request->ajax() || $request->wantsJson()){
            return response($similarowner)
                        ->header('Content','json');
        }

    }
}
