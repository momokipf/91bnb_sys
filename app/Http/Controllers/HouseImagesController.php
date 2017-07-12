<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HouseImagesController extends Controller
{
    //

    public function getImg($id){
    	$subpath = \App\Houseimage::find($id)->image;
    	return response()->file(storage_path($subpath));
    }
}
