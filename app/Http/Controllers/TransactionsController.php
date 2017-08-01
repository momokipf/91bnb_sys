<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Transaction;

class TransactionsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
    	$tran = Transaction::all();
        return view('transaction.ShowAll')
                ->with('Rep', Auth::user())
                ->with('tran', $tran);
    }

    public function store(Request $request) {
		Log::info($request->all());
		$storeInfo = array_slice($request->all(), 1);

		Inquirer::insert($storeInfo);
	}
}
