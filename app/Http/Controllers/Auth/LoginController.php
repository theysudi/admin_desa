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

	public function doLogin(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required|string',
			'password' => 'required|min:5'
		]);

		if ($validator->fails()) {
			return response(['msg' => $validator->errors()->all()[0]], 422);
		}

		$login = auth()->attempt($request->only('username', 'password'));
		if ($login) {
			$user = Auth::user();

			if (in_array($user->role_id, [3, 5, 6])) {
				$token = Str::random(32);
				$user->penduduk;

				AccessToken::create([
					'id' => hash('sha256', $token),
					'aplikasi_id' => 2,
					'revoked' => 0,
					'user_id' => $user->id,
					'expired_at' => Carbon::now()->addMonths(3),
					'device' => $request->header('User-Agent'),
				]);
				return response(['token' => $token, 'user' => $user], 200);
			} else {
				return response(["msg" => "User tidak memiliki Hak Akses pada Aplikasi"], 422);
			}
		} else {
			$this->incrementLoginAttempts($request);
			return response(["msg" => "Username atau Password Salah"], 422);
		}
	}

	public function doLogout()
	{
		$token = Auth::accessToken();
		$token->update(['revoked' => 1]);
		return response(["msg" => "Berhasil Logout"], 200);
	}
}
