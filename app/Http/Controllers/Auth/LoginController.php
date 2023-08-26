<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function postLogin(Request $request)
    {
        //  dd($request);
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|min:5'
        ]);
        if (auth()->guard('user')->attempt($request->only('username', 'password'))) { 

            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return redirect()->route('dashboard'); 
        } else {
            $this->incrementLoginAttempts($request);
            // return redirect()
            //     ->back()
            //     ->withInput()
            //     ->withErrors(["Incorrect user login details!"]);

                return back()->withInput()->withErrors([
                    'match' => [trans('auth.failed')],
                ]);

        }
      }
}
