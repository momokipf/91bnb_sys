<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use View;
use App\Representative;

class PostController extends Controller
{


    public function index()
    {
      $reps=Representative::all();

      return view('child',compact('reps'));
    }

    //
   //  public function index(){
   //  	return view::make('home')
			// ->with('title','Main Page')
			// ->with('hello','action:index~~');
   //  }

    public function create(){
    	return view::make('home')
			->with('title','Main Page')
			->with('hello','action:create~~');
    }

    public function strore(Request $request){
    	return view::make('home')
			->with('title','Main Page')
			->with('hello','action:store $request~~');
    }

    public function show($id)
   	{
   		return view::make('home')
			->with('title','Main Page')
			->with('hello','action:show ~~'.$id);
   	}

   	public function edit($id){
   		return view::make('home')
			->with('title','Main Page')
			->with('hello','action:edit~~');
   	}

   	public function update(Request $request,$id){
   		return view::make('home')
			->with('title','Main Page')
			->with('hello','action:update~~');
   	}

   	public function destroy($id){
   		return view::make('home')
			->with('title','Main Page')
			->with('hello','action:destory~~');
   	}
}
