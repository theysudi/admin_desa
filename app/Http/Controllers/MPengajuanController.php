<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use App\Models\MasterPenduduk;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MPengajuanController extends Controller
{

	public function dokJenisMD()
	{
		$result = JenisDokumen::all();
		$data = DataTables::of($result)
			->addColumn('show_bukti', function ($row) {
				if ($row->status == 1) {
					return true;
				} else {
					return false;
				}
			})
			->toJson();
		return response(["data" => $data->original['data']], 200);
	}

	public function keluargaMD()
	{
		$user = Auth::user();
		$data = MasterPenduduk::where('no_kk', $user->penduduk->no_kk)->get();
		return response(["data" => $data], 200);
	}

	private function storeFile($file, $prefix, $jenis_surat_id)
	{
		$timeStamp = Carbon::now()->timestamp;
		$ext = $file->extension();
		$directory = "/dokumen/" . $jenis_surat_id;
		$namaFie =  $prefix . $timeStamp . ".{$ext}";
		$file->move(storage_path('app/public' . $directory), $namaFie);
		return 'storage' . $directory . '/' . $namaFie;
	}

	public function pengajuanDt()
	{
		$user = Auth::user();
		$result = Pengajuan::with('jenis_surat', 'penduduk', 'atasnama')
			->where(function ($query) use ($user) {
				if ($user->role_id == 5) {
					$query->where('status', 1);
				}
				if ($user->role_id == 6) {
					$query->where('status', 3);
				}
				if ($user->role_id == 3) {
					$query->where('penduduk_id', $user->userable_id);
				}
			})
			->orderBy('created_at', 'desc');

		$data = DataTables::of($result)
			->addColumn('status_text', function ($row) {
				if ($row->status == 0) {
					return 'Menunggu';
				} elseif ($row->status == 1) {
					return 'Di Proses ke Kepala Dusun';
				} elseif ($row->status == 2 || $row->status == 3) {
					return 'Di Proses ke Kepala Desa';
				} elseif ($row->status == 4) {
					return 'Selesai';
				} else {
					return '';
				}
			})
			->addColumn('can_verif', function ($row) {
				$user = Auth::user();
				if ($user->role_id == 5 && $row->status == 1) {
					return true;
				} else if ($user->role_id == 6 && $row->status == 3) {
					return true;
				} else {
					return false;
				}
			})
			->toJson();

		return response(["data" => $data->original['data']], 200);
	}

	public function pengajuanStore(Request $request)
	{
		try {
			$data = [
				'penduduk_id' => Auth::user()->userable_id,
				'jenis_surat_id' => $request->jenis_surat_id,
				'penduduk_id_atas_nama' => $request->penduduk_id_atas_nama,
				'tujuan_permohonan' => $request->tujuan_permohonan,
			];

			if ($request->jenis_surat_id == 20) {
				$urlFile = $this->storeFile($request->file('file_bukti'), 'bukti', $request->jenis_surat_id);
				$data['file_bukti'] = $urlFile;
			}

			$pengajuan = Pengajuan::create($data);

			return response(["data" => $pengajuan, "msg" => 'Berhasil Tambah Data Pengajuan'], 200);
		} catch (\Throwable $th) {
			return response(["msg" => 'Gagal Tambah Data Pengajuan'], 456);
		}
	}

	public function pengajuanVerif(Pengajuan $pengajuan)
	{
		$user = Auth::user();

		if ($user->role_id == 5 || $user->role_id == 6) {
			try {
				$status = 0;
				if ($user->role_id == 5) {
					$status = 2;
				} else if ($user->role_id == 6) {
					$status = 4;
				}

				$pengajuan->update(['status' => $status]);

				return response(["data" => $pengajuan, "msg" => 'Berhasil Verifikasi Data Pengajuan'], 200);
			} catch (\Throwable $th) {
				return response(["msg" => 'Gagal Verifikasi Data Pengajuan'], 456);
			}
		} else {
			return response(["msg" => 'User tidak memiliki Hak Akses'], 456);
		}
	}
}
