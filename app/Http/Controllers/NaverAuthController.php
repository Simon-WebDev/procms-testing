<?php
namespace App\Http\Controllers;

use App\User;
use Auth;
use Socialite;
use Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use App\Role;


class NaverAuthController extends Controller
{
    protected $redirectTo = '/';
    
    public function index()
    {
        return Auth::user();
    }

    public function redirectToProvider()
    {
        return Socialite::with('naver')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::with('naver')->user();
       
        $userToLogin = User::where([
            'provider' => 'naver',
            'socialid' => $user->getId(),
        ])->first();
        if (!$userToLogin) {
            $userToLogin = new User([
                'provider' => 'naver',
                'socialid' => $user->getId(),
                'token' => $user->token,
                'name' => $user->getName(),
                'email'=>$user->getEmail(),
                'password' =>bcrypt('secret'),
                // 'is_active' => 1,
                'site_agree' =>1,
                'privacy_agree' =>1,
                'slug'  => str_random(20),
                'bio'  => $user->getName()
            ]);
            $userToLogin->save();
            /*added. new user role subscriber*/
            $userToLogin->attachRole('subscriber');
            /*end*/
        }

        Auth::login($userToLogin);
        Session::flash('success',$user->name.'님이 로그인 하셨습니다.');
        return redirect(session()->pull('from',$this->redirectTo));
    }
}