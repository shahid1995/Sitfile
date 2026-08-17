<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    //protected $redirectTo = '/home';
	protected $redirectTo = '/user/profile';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('login');
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;

    }


    /*protected function credentials(Request $request)
    {
        if(is_numeric($request->get('login'))){
          return ['phone'=>$request->get('login'),'password'=>$request->get('password')];
        }
        elseif (filter_var($request->get('login'))) {
          return ['email' => $request->get('login'), 'password'=>$request->get('password')];
        }
          return $request->only($this->username(), 'password');
    }*/

    public function username()
    {
        return $this->username;
    }

    #Restricting Un-Verified User Access
    public function authenticated(Request $request, $user)
    {
        if ($user->status == 0) {
            auth()->logout();
            return back()->with('error', 'You need to verify your account. We have sent you an activation link, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }
}
