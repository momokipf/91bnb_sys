<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    public function show(Request $request)
    {
        return view('transaction.showAll')
                ->with('Rep',Auth::user());
    }
}
