<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MasterPenduduk;
use App\Models\MasterPerangkatDesa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function edit()
	{
		$user = Auth::user();
		return view('profile.edit', ['user' => $user]);
	}

	public function store(Request $request)
	{

		if ($request->password_old == Auth::user()->password) {
			Alert::toast('Konfirmasi Password Baru tidak Sama ', 'error');
		}
		if ($request->password_new == $request->password_new_confirm) {
			Alert::toast('Konfirmasi Password Baru tidak Sama ', 'error');
		}

		try {

			User::find($request->id)->update([
				'password' => Hash::make($request->password_new_confirm)
			]);

			Alert::toast('Data Berhasil Disimpan', 'success');
		} catch (QueryException $e) {
			Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
		}
		return redirect()->route('penduduk.pengajuan.home');
	}
}
