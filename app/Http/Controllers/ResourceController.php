<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class ResourceController extends Controller
{
    //

    //protected $resource


    public function getlist($type){
    	$content = File::get(storage_path('list/'.$type));
    	return response($content)->header('Content-Type', 'json');
    }
}
