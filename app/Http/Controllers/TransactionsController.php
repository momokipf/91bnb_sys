<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Transaction;

class TransactionsController extends Controller
{
    public function show(Request $request)
    {
    	$tran = Transaction::all();
        return view('transaction.ShowAll')
                ->with('Rep', Auth::user())
                ->with('tran', $tran);
    }
}
