<?php

namespace App\Http\Controllers;

use App\Models\LayananKesehatan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MasterPenduduk;
use App\Models\MasterPerangkatDesa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class LayananKesehatanController extends Controller
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

		return view('layanankesehatan.index');
	}

	public function data()
	{
		//tambah hari caranya, buat kolom baru, terusan codingan di bawah add column
		$data = LayananKesehatan::where('isaktif', 1);
		return DataTables::of($data)->addColumn('action', function ($d) {
			return '<a href="' . route('layanankesehatan.edit', $d->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> Edit</a> <a style="cursor:pointer;" class="btn btn-xs btn-danger Hapus" ids=' . $d->id . '><i class="fa fa-trash-alt"></i> Hapus</a>';
		})->addColumn('hari', function ($d) {
			$hari = date("N", strtotime($d->tanggal));
			$arr_hari = ['1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu', '7' => 'Minggu'];
			return $arr_hari[$hari];
		})->toJson();
	}

	public function create()
	{
		return view('layanankesehatan.create');
	}

	public function edit($id)
	{
		$layanankesehatan = LayananKesehatan::where('id', $id)->first();
		return view('layanankesehatan.edit', ['layanankesehatan' => $layanankesehatan]);
	}

	public function store(Request $request)
	{
		try {
			if ($request->id) {
				if ($request->mode == 'del') {
					LayananKesehatan::where('id', $request->id)->update([
						"isaktif" => 0
					]);
				} else {
					LayananKesehatan::where('id', $request->id)->update([
						"tanggal" => $request->tanggal,
						"kegiatan" => $request->kegiatan,
						"uraian" => $request->uraian,
						"waktu_mulai" => $request->waktu_mulai,
						"waktu_selesai" => $request->waktu_selesai,
						"tempat" => $request->tempat,
					]);
				}
			} else {
				LayananKesehatan::create([
					"tanggal" => $request->tanggal,
					"kegiatan" => $request->kegiatan,
					"uraian" => $request->uraian,
					"waktu_mulai" => $request->waktu_mulai,
					"waktu_selesai" => $request->waktu_selesai,
					"tempat" => $request->tempat,
				]);
			}
			Alert::toast('Data Berhasil Disimpan', 'success');
		} catch (QueryException $e) {
			Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
		}
		return redirect()->route('layanankesehatan.home');
	}
}
