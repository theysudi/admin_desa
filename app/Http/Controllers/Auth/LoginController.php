<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

			dd($request);
			$request->session()->regenerate();
			$this->clearLoginAttempts($request);
			// return redirect()->route('dashboard');
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

	public function doLogin(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required|string',
			'password' => 'required|min:5'
		]);

		if ($validator->fails()) {
			return response(['message' => $validator->errors()->all()[0]], 422);
		}

		$login = auth()->attempt($request->only('username', 'password'));
		if ($login) {
			$user = Auth::user();
			$token = AccessToken::create([
				'id' => Str::random(48),
				'aplikasi_id' => 2,
				'user_id' => $user->id,
				'device' => $request->header('User-Agent'),
				'expired_at' => Carbon::now()->addMonths(3),
			]);
			return response(['token' => $token, 'user' => $user], 200);
		} else {
			$this->incrementLoginAttempts($request);
			return response(["message" => "Username atau Password Salah"], 422);
		}
	}
}
