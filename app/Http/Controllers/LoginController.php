<?php

namespace App\Http\Controllers;


use App\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Log;

use App\Inquiry;
use Validator;
use View;

class LoginController extends Controller
{

    //use ThrottlesLogins;
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


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        // if ($this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);

        //     return $this->sendLockoutResponse($request);
        // }

        // if ($this->attemptLogin($request)) {
        //     return $this->sendLoginResponse($request);
        // }
        if(Auth::attempt([
                'repUserName'=>$input['userID'],
                'password'=>$input['userPwd'],
                'active' => 1
            ])){
            //Log::info(Auth::user());
            return redirect('MainPage/');

            //return redirect('/welcome');
        }
        else{
            $this->incrementLoginAttempts($request);

            return redirect('login')
                ->withInput()
                ->with('status','login failed');
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        //return $this->sendFailedLoginResponse($request);

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/login');
    }





    public function username()
    {
        return 'repUserName';
    }

    

    protected function guard()
    {
        return Auth::guard();
    }

}
