<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Representative;
use App\Inquiry;
use App\Inquirer;

class InquirersController extends Controller
{
    public function show()
    {
    	#Log::info('Showing user profile for user:');
    	$rep = Auth::user();

    	if ($rep->repPriority > 2) {
			$inquirers = $rep->inquirer()->paginate(10);
		}
		else {
    		$inquirers = Inquirer::paginate(10);
    	}
    	return view('inquirer.showAll')
    			->with('rep', $rep)
    			->with('inquirers', $inquirers);
    }
}
