<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /*after login, redirect for previous page*/
    public function showLoginForm()
    {
        if(!session()->has('from')){
            session()->put('from', url()->previous());
        }
        return view('auth.login');
    }

    public function authenticated($request,$user)
    {
        Session::flash('success',$user->name.'님이 로그인 하셨습니다.');
        return redirect(session()->pull('from',$this->redirectTo));
    }
    //end after login

    //for socialite
    public function redirectToProvider()
        {
           // return Socialite::driver('github')->redirect();
        }

        /**
         * Obtain the user information from GitHub.
         *
         * @return \Illuminate\Http\Response
         */
        public function handleProviderCallback()
        {
              // $userSocial  = Socialite::driver('facebook')->user();
              // dd($userSocial);
               //check if user exists and log user in
               // $user = User::where('email', $userSocial->user['email'])->first();
               // if($user){
               //     if(Auth::loginUsingId($user->id)){
               //        return redirect()->route('');
               //     }
               // }
            //else sign the user up
            // $userSignup = User::create([
            //        'name' => $userSocial->user['name'],
            //        'email' => $userSocial->user['email'],
            //        'password' => bcrypt('1234'),
                   //'avatar'=> $userSocial->avatar,
                  // 'facebook_profile'=> $userSocial->user['link'],
                  // 'gender' => $userSocial->user['gender']
               // ]);
             
               //finally log the user in
               // if($userSignup){
               //     if(Auth::loginUsingId($userSignup->id)){
               //         return redirect()->route('');
               //     }
               // }

        }
   

   
}
