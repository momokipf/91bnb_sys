<?php

namespace App\Http\Controllers;


use App\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use App\Inquiry;
use Validator;
use View;
use Log;

class LoginController extends Controller
{

    //protected $redirectTo = '/welcome';   // this can be the pre-definede or use protected function redirectTO(){}



    // protected function formatValidationErrors(Validator $validator){
    //  $errors = $validator->errors();
    //  // foreach ($validator->errors()->all()  as $key => $error) {
    //  //  # code...
    //  //  Log::info($key .' '. $error);

    //  // }

    //  Log::info($errors->has('userID'));
    //  Log::info($errors->has('userID.required'));
    //  Log::info($errors->has('userPwd'));
    //  Log::info($errors->first('userPwd.required'));


    //  return   $validator->errors()->all();
    // }

    // public function __construct()
    // {
    //  $this->middleware('auth:web');
    // }


    // public function authenticate()
    // {
    //  if(Auth::attempt(['userID'=>'repUserName','userPwd'=>'repPassword']))
    //  {
    //      return redirect()->intented('welcome');
    //  }
    // }




    public function show(){
        return View::make('login');
    }

    public function login(Request $request){
        $input = $request->all();

        $messages = array(
        'userID.required' => 'The User ID field is required.',
        'email' => 'The User ID field must be a valid email address',
        'userPwd.required' => 'The password field is required',
        'required' => 'The :attribute field is required.',  
        );

        $validator = Validator::make($input, [
                'userID'=>'bail|required|max:50|email',
                'userPwd'=>'required',],
                $messages);

        if($validator->fails())
        {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($validator->errors());
        }

        //if safety is important

        if(Auth::attempt([
                'repUserName'=>$input['userID'],
                'password'=>$input['userPwd'],
                'active' => 1
            ])){
            $off = 0;
            //Log::info(Auth::user());
            return redirect('MainPage/'.$off);
                    //->with('userID',Auth::user()->repUserName);

            //return redirect('/welcome');
        }
        else{
            return redirect('/login')
                ->withInput()
                ->with('status','login failed');
        }
        // $rep = Representative::where('active',1)
        //      ->where('repUserName',$input['userID'])
        //      ->where('repPassword',$input['userPwd'])
        //      ->first();

        // if($rep)
        // {
        //  $number = Inquiry::getHotQuery();
        //  //return redirect('/MainPage');
        //  return view('MainPage')->with('num',$number)
        //                  ->with('userID',$input['userID']);
        // }
        // else{
        //  return redirect('/login')
        //      ->withInput()
        //      ->with('status','login failed');
        // }




    }

    public function logout(){

    }


    public function username()
    {
        return 'repUserName';
    }

    

    protected function guard()
    {
        return Auth::guard('web');
    }

}
