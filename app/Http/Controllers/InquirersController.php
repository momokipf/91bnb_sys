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
	public function __construct() {
		$this->middleware('auth');
	}

	public function show() {
		#Log::info('Showing user profile for user:');
		$rep = Auth::user();

		if ($rep->repPriority > 2) {
			$inquirers = $rep->inquirer()->paginate(10);
		}
		else {
			$inquirers = Inquirer::paginate(10);
		}
		return view('inquirer.ShowAll')
				->with('Rep', $rep)
				->with('inquirers', $inquirers);
	}

	public function searchAndModify() {
		$rep = Auth::user();
		return view('inquirer.SearchAndModify')
				->with('Rep', $rep)
				->with('success', 0);
	}

	public function searchForModify(Request $request,$similar = null){
		//Log::info($request->all());
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

	public function modifyInquirer(Request $request) {
		$updateInfo = array_slice($request->all(), 2);
		Log::info($request->all());
		Log::info($updateInfo);
		if (array_key_exists('inquirerState', $updateInfo) && $updateInfo['inquirerState'] == 'InputState') {
			$updateInfo['inquirerState'] = $updateInfo['inquirerStateOther'];
		}
		if (array_key_exists('inquirerCity', $updateInfo) && ($updateInfo['inquirerCity'] == 'InputCity' || $updateInfo['inquirerCity'] == 'Other')) {
			$updateInfo['inquirerCity'] = $updateInfo['inquirerCityOther'];
		}

		/*array_splice($updateInfo, 13, 1);*/
		unset($updateInfo['inquirerStateOther']);
		unset($updateInfo['inquirerCityOther']);
		foreach ($updateInfo as $key => $value) {
			if ($value == null) {
				$updateInfo[$key] = '';
			}
		}
		Inquirer::where('inquirerID', array_get($request->all(), 'inquirerID'))
					->update($updateInfo);
		/*
		return view('inquirer.searchAndModify')
				->with('rep', Auth::user())
				->with('success', 1);
		*/
		$request->session()->flash('status', 'Task was successful!');
		return back()->withInput();
	}

	public function search(Request $request,$similar = null){
		Log::info($request->all());
		$search = Inquirer::searchablefield($request->all());
		if($search->isEmpty())
		{
			return response($search)->header('Content-Type', 'json');
		}
		Log::info($search);
		if($similar==null) 
			$ret = Inquirer::FindSimilar($search,'AND')->get();
		else 
			$ret = Inquirer::FindSimilar($search,'OR')->get();
		// Log::info(response($ret)->header('Content-Type', 'json'));
		return  response($ret)->header('Content-Type', 'json');
	}

	public function store(Request $request) {
		Log::info($request->all());
		$storeInfo = array_slice($request->all(), 1);

		if (array_key_exists('inquirerState', $storeInfo) && $storeInfo['inquirerState'] == 'InputState') {
			$storeInfo['inquirerState'] = $storeInfo['inquirerStateOther'];
		}
		if (array_key_exists('inquirerCity', $storeInfo) && ($storeInfo['inquirerCity'] == 'InputCity' || $storeInfo['inquirerCity'] == 'Other')) {
			$storeInfo['inquirerCity'] = $storeInfo['inquirerCityOther'];
		}

		unset($storeInfo['inquirerStateOther']);
		unset($storeInfo['inquirerCityOther']);

		foreach ($storeInfo as $key => $value) {
			if ($value == null) {
				$storeInfo[$key] = '';
			}
		}

		$id = Inquirer::insertGetId($storeInfo);

		return $id;
	}
}
