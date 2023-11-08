<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\MasterData\Bidang3;
use App\Models\MasterData\Rek4;
use App\Models\MasterData\SumberDana;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class KeuanganController extends Controller
{
	function index()
	{
		return view('keuangan.index');
	}

	function dt()
	{
		$query = Keuangan::orderBy('created_at', 'desc');
		return DataTables::of($query)->make(true);
	}

	function create(Request $request)
	{
		$data = null;
		if (isset($request->id)) {
			$data = Keuangan::where('id', $request->id)->first();
		}

		return view('keuangan.create', ['data' => $data]);
	}

	function store(Request $request)
	{
		try {
			$data = [
				'nama' => $request->nama,
				'keterangan' => $request->keterangan,
				'isaktif' => 1,
			];

			if ($request->file) {
				$urlFile = $this->storeFile($request->file('file'), 'keuangan', null);
				$data['file'] = $urlFile;
			}

			if (!isset($request->id)) {
				Keuangan::create($data);
			} else {
				Keuangan::where('id', $request->id)->update($data);
			}

			Alert::toast('Data Berhasil Disimpan', 'success');
		} catch (QueryException $e) {
			Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
		}
		return redirect()->route('keuangan.home');
	}

	function destroy(Request $request)
	{
		try {
			if (isset($request->id)) {
				Keuangan::where('id', $request->id)->delete();
			}

			Alert::toast('Data Berhasil Dihapus', 'success');
		} catch (QueryException $e) {
			Alert::toast('Data Gagal Dihapus' . ' ' . $e->errorInfo[2], 'error');
		}
		return redirect()->route('keuangan.home');
	}

	private function storeFile($file, $prefix, $file_upload)
	{
		$timeStamp = Carbon::now()->timestamp;
		$ext = $file->extension();
		$directory = "/dokumen/" . $file_upload;
		$namaFie =  $prefix . $timeStamp . ".{$ext}";
		$file->move(storage_path('app/public' . $directory), $namaFie);
		return 'storage' . $directory . '/' . $namaFie;
	}

	// // Kelola
	// public function kelola(Request $request)
	// {
	// 	if (isset($request->tahun)) {
	// 		$data['tahun'] = $request->tahun;
	// 		$data['sumber_dana'] = SumberDana::all();
	// 		$data['bidang'] = Bidang3::select(['*', DB::raw('CONCAT(kd_bidang_1, ".", kd_bidang_2, ".", kd_bidang_3) as kd_gabung')])
	// 			->orderBy('kd_bidang_1', 'asc')
	// 			->orderBy('kd_bidang_2', 'asc')
	// 			->orderBy('kd_bidang_3', 'asc')
	// 			->get();
	// 		$data['rekening'] = Rek4::select(['*', DB::raw('CONCAT(kd_rek_1, ".", kd_rek_2, ".", kd_rek_3, ".", kd_rek_4) as kd_gabung')])
	// 			->orderBy('kd_rek_1', 'asc')
	// 			->orderBy('kd_rek_2', 'asc')
	// 			->orderBy('kd_rek_3', 'asc')
	// 			->orderBy('kd_rek_4', 'asc')
	// 			->get();
	// 		return view('keuangan.kelola', $data);
	// 	} else {
	// 		return redirect()->route('keuangan.home');
	// 	}
	// }

	// function kelolaDt(Request $request)
	// {
	// 	$query = Keuangan::where(['tahun' => $request->tahun])
	// 		->orderBy('kd_bidang_1', 'asc')
	// 		->orderBy('kd_bidang_2', 'asc')
	// 		->orderBy('kd_bidang_3', 'asc')
	// 		->orderBy('kd_rek_1', 'asc')
	// 		->orderBy('kd_rek_2', 'asc')
	// 		->orderBy('kd_rek_3', 'asc')
	// 		->orderBy('kd_rek_4', 'asc');
	// 	return DataTables::of($query)->make(true);
	// }

	// function kelolaStore(Request $request)
	// {
	// 	try {
	// 		$data = [
	// 			'tahun' => $request->tahun,
	// 			'anggaran' => $request->anggaran,
	// 			'realisasi' => $request->realisasi,
	// 			'sumber_dana_id' => $request->sumber_dana_id,
	// 			'sumber_dana' => $request->sumber_dana,
	// 		];

	// 		$exp = explode(' - ', $request->rekening_nama);
	// 		$data['nm_rek_4'] = trim($exp[1]);

	// 		$exp = explode('.', $request->rekening);
	// 		$data['kd_rek_1'] = $exp[0];
	// 		$data['kd_rek_2'] = $exp[1];
	// 		$data['kd_rek_3'] = $exp[2];
	// 		$data['kd_rek_4'] = $exp[3];

	// 		if ($data['kd_rek_1'] == 5) {
	// 			$exp = explode(' - ', $request->bidang_nama);
	// 			$data['nm_bidang_3'] = trim($exp[1]);

	// 			$exp = explode('.', $request->bidang);
	// 			$data['kd_bidang_1'] = $exp[0];
	// 			$data['kd_bidang_2'] = $exp[1];
	// 			$data['kd_bidang_3'] = $exp[2];
	// 		}

	// 		if (empty($request->id)) {
	// 			$keuangan = Keuangan::create($data);
	// 		} else {
	// 			$keuangan = Keuangan::where('id', $request->id)->update($data);
	// 		}
	// 		return response()->json($keuangan);
	// 	} catch (\Throwable $th) {
	// 		return response()->json(['msg' => 'Gagal'], 456);
	// 	}
	// }

	// function kelolaDestroy(Request $request)
	// {
	// 	try {
	// 		Keuangan::where('id', $request->id)->delete();
	// 		Alert::toast('Data Berhasil Dihapus', 'success');
	// 	} catch (QueryException $e) {
	// 		Alert::toast('Data Gagal Dihapus' . ' ' . $e->errorInfo[2], 'error');
	// 	}
	// 	return redirect()->route('keuangan.kelola.home', ['tahun' => $request->tahun]);
	// }
}
