<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Inquiry;
use App\Inquirer;
use App\Representative;

class RepresentativesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function showAll() {
		#Log::info('Showing user profile for user:');
		$rep = Auth::user();

		$reps = Representative::paginate(10);

		return view('rep.showAll')
				->with('rep', $rep)
				->with('reps', $reps);
	}

	public function update(Request $request) {
		Log::info($request->all());
		$updateinfo = $request->all();
		if (array_key_exists('password', $updateinfo)) {
			$updateinfo['password'] = bcrypt($updateinfo['password']);
		}
		Representative::where('repID', array_get($request->all(), 'repID'))
					->update($updateinfo);
	}

	public function store(Request $request) {
		Log::info($request->all());
		$storeInfo = array_slice($request->all(), 1);
		$storeInfo["active"] = 1;
		if (array_key_exists('password', $storeInfo)) {
			$storeInfo['password'] = bcrypt($storeInfo['password']);
		}
		$id = Representative::insertGetId($storeInfo);
		return $id;
	}
}
