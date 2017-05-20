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

	public function searchAndModify() {
		$rep = Auth::user();
		return view('inquirer.searchAndModify')
				->with('rep', $rep);
	}

	public function searchForModify(Request $request,$similar = null){
		Log::info($request->all());
		$search = Inquirer::searchablefield($request->all());
		if($search->isEmpty())
		{
			return response($search)->header('Content-Type', 'json');
		}

		$rep = Auth::user();
		if($similar==null) {
			if ($rep->repPriority > 2) {
				Log::info($rep);
				$ret = $rep->inquirer()->FindSimilar($search,'AND')->get();
			}
			else {
				$ret = Inquirer::FindSimilar($search,'AND')->get();				
			}
		} else {
			if ($rep->repPriority > 2) {
				$ret = $rep->inquirer()->FindSimilar($search,'OR')->get();
			}
			else {
				$ret = Inquirer::FindSimilar($search,'OR')->get();				
			}
		}
		//Log::info(response($ret)->header('Content-Type', 'json'));
		return  response($ret)->header('Content-Type', 'json');
	}

	public function search(Request $request,$similar = null){
		Log::info($request->all());
		$search = Inquirer::searchablefield($request->all());
		if($search->isEmpty())
		{
			return response($search)->header('Content-Type', 'json');
		}
		if($similar==null) 
			$ret = Inquirer::FindSimilar($search,'AND')->get();
		else 
			$ret = Inquirer::FindSimilar($search,'OR')->get();
		//Log::info(response($ret)->header('Content-Type', 'json'));
		return  response($ret)->header('Content-Type', 'json');
	}
}
