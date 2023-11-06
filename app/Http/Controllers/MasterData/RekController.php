<?php

namespace App\Http\Controllers\MasterData;


use App\Http\Controllers\Controller;
use App\Models\MasterData\Rek1;
use App\Models\MasterData\Rek2;
use App\Models\MasterData\Rek3;
use App\Models\MasterData\Rek4;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class RekController extends Controller
{
	private $msgGagal = "Gagal Menyimpan Perubahan Data";

	function index()
	{
		return view('masterdata.rek.index');
	}

	public function dtB1()
	{
		$query = Rek1::all();
		return DataTables::of($query)->make(true);
	}

	public function dtB2()
	{
		$query = Rek2::all();
		return DataTables::of($query)->make(true);
	}

	public function dtB3()
	{
		$query = Rek3::all();
		return DataTables::of($query)->make(true);
	}

	public function dtB4()
	{
		$query = Rek4::all();
		return DataTables::of($query)->make(true);
	}

	public function create(Request $request)
	{
		$b = $request->b;
		$kd = $request->kd;
		$data['rek'] = $b;

		if (isset($kd)) {
			$data['kd'] = substr($kd, 0, strpos($kd, "."));
			$data['ref_kd'] = substr($kd, 0, strrpos($kd, "."));
			$exp = explode('.', $kd);

			if ($b == 1) {
				$data['data'] = Rek1::select([
					DB::raw('nm_rek_1 as nm'),
					DB::raw('kd_rek_1 as kd'),
					DB::raw('CONCAT(kd_rek_1) as kd_gabung'),
				])->where(['kd_rek_1' => $exp[0]])->first();
			} elseif ($b == 2) {
				$data['data'] = Rek2::select([
					DB::raw('nm_rek_2 as nm'),
					DB::raw('kd_rek_2 as kd'),
					DB::raw('CONCAT(kd_rek_1, ".", kd_rek_2) as kd_gabung'),
				])->where(['kd_rek_1' => $exp[0], 'kd_rek_2' => $exp[1]])->first();
			} elseif ($b == 3) {
				$data['data'] = Rek3::select([
					DB::raw('nm_rek_3 as nm'),
					DB::raw('kd_rek_3 as kd'),
					DB::raw('CONCAT(kd_rek_1, ".", kd_rek_2, ".", kd_rek_3) as kd_gabung'),
				])->where(['kd_rek_1' => $exp[0], 'kd_rek_2' => $exp[1], 'kd_rek_3' => $exp[2]])->first();
			} elseif ($b == 4) {
				$data['data'] = Rek4::select([
					DB::raw('nm_rek_4 as nm'),
					DB::raw('kd_rek_4 as kd'),
					DB::raw('CONCAT(kd_rek_1, ".", kd_rek_2, ".", kd_rek_3, ".", kd_rek_4) as kd_gabung'),
				])->where(['kd_rek_1' => $exp[0], 'kd_rek_2' => $exp[1], 'kd_rek_3' => $exp[2], 'kd_rek_4' => $exp[3]])->first();
			}
		}

		if ($b == 2) {
			$data['ref'] = Rek1::select([
				DB::raw('nm_rek_1 as nama'),
				DB::raw('kd_rek_1 as kd_gabung'),
			])->get();
		}
		if ($b == 3) {
			$data['ref'] = Rek2::select([
				DB::raw('nm_rek_2 as nama'),
				DB::raw('CONCAT(kd_rek_1, ".", kd_rek_2) as kd_gabung'),
			])->get();
		}
		if ($b == 4) {
			$data['ref'] = Rek3::select([
				DB::raw('nm_rek_3 as nama'),
				DB::raw('CONCAT(kd_rek_1, ".", kd_rek_2, ".", kd_rek_3) as kd_gabung'),
			])->get();
		}

		return view('masterdata.rek.create', $data);
	}

	public function store(Request $request)
	{
		try {
			$b = $request->rek;
			$kd = $request->kode;
			$nm = $request->nama;

			if (isset($request->edit_kode)) {
				$ref = explode('.', $request->ref);
				$edit_kode = explode('.', $request->edit_kode);
				$edit_nama = $request->edit_nama;
				if ($b == 1) {
					Rek1::where(['kd_rek_1' => $edit_kode[0], 'nm_rek_1' => $edit_nama])
						->update(['kd_rek_1' => $kd, 'nm_rek_1' => $nm]);
				} elseif ($b == 2) {
					Rek2::where(['kd_rek_1' => $edit_kode[0], 'kd_rek_2' => $edit_kode[1], 'nm_rek_2' => $edit_nama])
						->update(['kd_rek_1' => $ref[0], 'kd_rek_2' => $kd, 'nm_rek_2' => $nm]);
				} elseif ($b == 3) {
					Rek3::where(['kd_rek_1' => $edit_kode[0], 'kd_rek_2' => $edit_kode[1], 'kd_rek_3' => $edit_kode[2], 'nm_rek_3' => $edit_nama])
						->update(['kd_rek_1' => $ref[0], 'kd_rek_2' => $ref[1], 'kd_rek_3' => $kd, 'nm_rek_3' => $nm]);
				} elseif ($b == 4) {
					Rek4::where(['kd_rek_1' => $edit_kode[0], 'kd_rek_2' => $edit_kode[1], 'kd_rek_3' => $edit_kode[2], 'kd_rek_4' => $edit_kode[3], 'nm_rek_4' => $edit_nama])
						->update(['kd_rek_1' => $ref[0], 'kd_rek_2' => $ref[1], 'kd_rek_3' => $ref[2], 'kd_rek_4' => $kd, 'nm_rek_4' => $nm]);
				}
			} else {
				if ($b == 1) {
					Rek1::create(['kd_rek_1' => $kd, 'nm_rek_1' => $nm]);
				} elseif ($b > 1) {
					$ref = explode('.', $request->ref);
					if ($b == 2) {
						Rek2::create(['kd_rek_1' => $ref[0], 'kd_rek_2' => $kd, 'nm_rek_2' => $nm]);
					} elseif ($b == 3) {
						Rek3::create(['kd_rek_1' => $ref[0], 'kd_rek_2' => $ref[1], 'kd_rek_3' => $kd, 'nm_rek_3' => $nm]);
					} elseif ($b == 4) {
						Rek4::create(['kd_rek_1' => $ref[0], 'kd_rek_2' => $ref[1], 'kd_rek_3' =>  $ref[2], 'kd_rek_4' => $kd, 'nm_rek_4' => $nm]);
					}
				}
			}
			Alert::toast('Data Berhasil Disimpan', 'success');
		} catch (QueryException $e) {
			Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
		}
		return redirect()->route('masterdata.rek.home');
	}

	public function destroy(Request $request)
	{

		try {
			$b = $request->b;
			$kd = $request->kd;

			$exp = explode('.', $kd, 3);
			if ($b == 1) {
				Rek1::where(['kd_rek_1' => $exp[0]])
					->delete();
			} elseif ($b == 2) {
				Rek2::where(['kd_rek_1' => $exp[0], 'kd_rek_2' => $exp[1]])
					->delete();
			} elseif ($b == 3) {
				Rek3::where(['kd_rek_1' => $exp[0], 'kd_rek_2' => $exp[1], 'kd_rek_3' => $exp[2]])
					->delete();
			} elseif ($b == 4) {
				Rek4::where(['kd_rek_1' => $exp[0], 'kd_rek_2' => $exp[1], 'kd_rek_3' => $exp[2], 'kd_rek_4' => $exp[3]])
					->delete();
			}
			Alert::toast('Data Berhasil Dihapus', 'success');
		} catch (QueryException $e) {
			Alert::toast('Data Gagal Dihapus' . ' ' . $e->errorInfo[2], 'error');
		}
		return redirect()->route('masterdata.rek.home');
	}
}
