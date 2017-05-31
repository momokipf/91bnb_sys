<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use View;
use App\Inquiry;

class HousesController extends Controller
{
    //

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function searchindex(Request $request)
    {
    	$fakequery = Inquiry::find(114);
    	return view('House/HouseSearch')
    			->with('Query',$fakequery)
    			->with('Rep',Auth::user());
    }

    //Different Reaction based on request 
    // if ($request->ajax() || $request->wantsJson())
    // {
    //     $json = [
    //         'success' => false,
    //         'error' => [
    //             'code' => $e->getCode(),
    //             'message' => $e->getMessage(),
    //         ],
    //     ];

    //     return response()->json($json, 400);
    // }

    public function addindex(Request $request)
    {
    	return view('House/HouseAdd')
    			->with('Rep',Auth::user());
    }


}
