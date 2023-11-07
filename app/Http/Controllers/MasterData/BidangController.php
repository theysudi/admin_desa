<?php

namespace App\Http\Controllers\MasterData;


use App\Http\Controllers\Controller;
use App\Models\MasterData\Bidang1;
use App\Models\MasterData\Bidang2;
use App\Models\MasterData\Bidang3;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class BidangController extends Controller
{
	private $msgGagal = "Gagal Menyimpan Perubahan Data";

	function index()
	{
		return view('masterdata.bidang.index');
	}

	public function dtB1()
	{
		$query = Bidang1::all();
		return DataTables::of($query)->make(true);
	}

	public function dtB2()
	{
		$query = Bidang2::all();
		return DataTables::of($query)->make(true);
	}

	public function dtB3()
	{
		$query = Bidang3::all();
		return DataTables::of($query)->make(true);
	}

	public function create(Request $request)
	{
		$b = $request->b;
		$kd = $request->kd;
		$data['bidang'] = $b;

		if (isset($kd)) {
			$data['kd'] = substr($kd, 0, strpos($kd, "."));
			$data['ref_kd'] = substr($kd, 0, strrpos($kd, "."));
			$exp = explode('.', $kd);

			if ($b == 1) {
				$data['data'] = Bidang1::select([
					DB::raw('nm_bidang_1 as nm'),
					DB::raw('kd_bidang_1 as kd'),
					DB::raw('CONCAT(kd_bidang_1) as kd_gabung'),
				])->where(['kd_bidang_1' => $exp[0]])->first();
			} elseif ($b == 2) {
				$data['data'] = Bidang2::select([
					DB::raw('nm_bidang_2 as nm'),
					DB::raw('kd_bidang_2 as kd'),
					DB::raw('CONCAT(kd_bidang_1, ".", kd_bidang_2) as kd_gabung'),
				])->where(['kd_bidang_1' => $exp[0], 'kd_bidang_2' => $exp[1]])->first();
			} elseif ($b == 3) {
				$data['data'] = Bidang3::select([
					DB::raw('nm_bidang_3 as nm'),
					DB::raw('kd_bidang_3 as kd'),
					DB::raw('CONCAT(kd_bidang_1, ".", kd_bidang_2, ".", kd_bidang_3) as kd_gabung'),
				])->where(['kd_bidang_1' => $exp[0], 'kd_bidang_2' => $exp[1], 'kd_bidang_3' => $exp[2]])->first();
			}
		}

		if ($b == 2) {
			$data['ref'] = Bidang1::select([
				DB::raw('nm_bidang_1 as nama'),
				DB::raw('kd_bidang_1 as kd_gabung'),
			])->get();
		}
		if ($b == 3) {
			$data['ref'] = Bidang2::select([
				DB::raw('nm_bidang_2 as nama'),
				DB::raw('CONCAT(kd_bidang_1, ".", kd_bidang_2) as kd_gabung'),
			])->get();
		}

		return view('masterdata.bidang.create', $data);
	}

	public function store(Request $request)
	{
		try {
			$b = $request->bidang;
			$kd = $request->kode;
			$nm = $request->nama;

			if (isset($request->edit_kode)) {
				$ref = explode('.', $request->ref);
				$edit_kode = explode('.', $request->edit_kode, 3);
				$edit_nama = $request->edit_nama;
				if ($b == 1) {
					Bidang1::where(['kd_bidang_1' => $edit_kode[0], 'nm_bidang_1' => $edit_nama])
						->update(['kd_bidang_1' => $kd, 'nm_bidang_1' => $nm]);
				} elseif ($b == 2) {
					Bidang2::where(['kd_bidang_1' => $edit_kode[0], 'kd_bidang_2' => $edit_kode[1], 'nm_bidang_2' => $edit_nama])
						->update(['kd_bidang_1' => $ref[0], 'kd_bidang_2' => $kd, 'nm_bidang_2' => $nm]);
				} elseif ($b == 3) {
					Bidang3::where(['kd_bidang_1' => $edit_kode[0], 'kd_bidang_2' => $edit_kode[1], 'kd_bidang_3' => $edit_kode[2], 'nm_bidang_3' => $edit_nama])
						->update(['kd_bidang_1' => $ref[0], 'kd_bidang_2' => $ref[1], 'kd_bidang_3' => $kd, 'nm_bidang_3' => $nm]);
				}
			} else {
				if ($b == 1) {
					Bidang1::create(['kd_bidang_1' => $kd, 'nm_bidang_1' => $nm]);
				} elseif ($b > 1) {
					$ref = explode('.', $request->ref);
					if ($b == 2) {
						Bidang2::create(['kd_bidang_1' => $ref[0], 'kd_bidang_2' => $kd, 'nm_bidang_2' => $nm]);
					} elseif ($b == 3) {
						Bidang3::create(['kd_bidang_1' => $ref[0], 'kd_bidang_2' => $ref[1], 'kd_bidang_3' => $kd, 'nm_bidang_3' => $nm]);
					}
				}
			}
			Alert::toast('Data Berhasil Disimpan', 'success');
		} catch (QueryException $e) {
			Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
		}
		return redirect()->route('masterdata.bidang.home');
	}

	public function destroy(Request $request)
	{
		try {
			$b = $request->b;
			$kd = $request->kd;

			$exp = explode('.', $kd, 3);
			if ($b == 1) {
				Bidang1::where(['kd_bidang_1' => $exp[0]])
					->delete();
			} elseif ($b == 2) {
				Bidang2::where(['kd_bidang_1' => $exp[0], 'kd_bidang_2' => $exp[1]])
					->delete();
			} elseif ($b == 3) {
				Bidang3::where(['kd_bidang_1' => $exp[0], 'kd_bidang_2' => $exp[1], 'kd_bidang_3' => $exp[2]])
					->delete();
			}
			Alert::toast('Data Berhasil Dihapus', 'success');
		} catch (QueryException $e) {
			Alert::toast('Data Gagal Dihapus' . ' ' . $e->errorInfo[2], 'error');
		}
		return redirect()->route('masterdata.bidang.home');
	}
}
