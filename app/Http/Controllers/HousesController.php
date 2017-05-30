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

    public function index(Request $request)
    {
    	$fakequery = Inquiry::find(114);
    	return view('HouseSearch')
    			->with('Query',$fakequery)
    			->with('Rep',Auth::user());
    }
}
