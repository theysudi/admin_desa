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

class MasterPerangkatDesaController extends Controller
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
	public function index()
	{

		return view('masterdata.perangkatdesa.index');
	}

	public function data()
	{
		$data = MasterPerangkatDesa::all();
		return DataTables::of($data)->addColumn('action', function ($d) {
			return '<a href="' . route('masterdata.perangkatdesa.edit', $d->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> Edit</a>';
		})->toJson();
	}

	public function create()
	{
		// $perangkatdesa = MasterPerangkatDesa::all();
		return view('masterdata.perangkatdesa.create');
	}

	public function edit($id)
	{
		$perangkatdesa = MasterPerangkatDesa::where('id', $id)->first();
		return view('masterdata.perangkatdesa.edit', ['perangkatdesa' => $perangkatdesa], ['perangkatdesa' => $perangkatdesa]);
	}

	public function store(Request $request)
	{
		try {
			if ($request->id) {
				if ($request->mode == 'del') {
					MasterPerangkatDesa::where('id', $request->id)->update([
						"isaktif" => 0
					]);
				} else {
					MasterPerangkatDesa::where('id', $request->id)->update([
						"nama" => $request->nama,
						"no_hp" => $request->no_hp,
						"jenis" => $request->jenis,
						"jabatan" => $request->jabatan,
					]);
				}
			} else {
				$id = MasterPerangkatDesa::create([
					"nama" => $request->nama,
					"no_hp" => $request->no_hp,
					"jenis" => $request->jenis,
					"jabatan" => $request->jabatan,
				]);
			}
			Alert::toast('Data Berhasil Disimpan', 'success');
		} catch (QueryException $e) {
			Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
		}
		return redirect()->route('masterdata.perangkatdesa.home');
	}
}
