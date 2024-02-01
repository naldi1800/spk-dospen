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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $r) {
        $input = $r->all();
        $this->validate($r, [
            'email' => 'required|email',
            'password'=>'required',
        ]);

        if(auth()->attempt(['email'=>$input['email'], 'password'=>$input['password']])){
            if(auth()->user()->role == 'admin'){
                return redirect()->route('home');
            }
            else if(auth()->user()->role == 'ketjur'){
                return redirect()->route('ketjur.home');
            }
        }
        else{
            return redirect()
            ->route('login')
            ->with('error', 'Incorrect email or password');
        }


    }
}
