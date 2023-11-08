<?php

namespace App\Http\Controllers;

use App\Models\DesaCerdas;
use App\Models\JenisDokumen;
use App\Models\Keuangan;
use App\Models\LayananKesehatan;
use App\Models\MasterPenduduk;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
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
			->addColumn('dok_link_pemohon', function ($d) {
				if ($d->jenis_surat_id == 20) {
					return URL::to($d->file_bukti);
				} else {
					return '';
				}
			})
			->addColumn('dok_link_kadus', function ($d) {
				if ($d->jenis_surat_id == 20) {
					return route('report.suketusahadagangkadus', $d->id);
				} else {
					return '';
				}
			})
			->addColumn('dok_link', function ($d) {
				if ($d->jenis_surat_id == 1) {
					return route('report.suketbelumkawin', $d->id);
				} elseif ($d->jenis_surat_id == 2) {
					return route('report.suketahliwaris', $d->id);
				} elseif ($d->jenis_surat_id == 3) {
					return route('report.suketdomisilianaksekolah', $d->id);
				} elseif ($d->jenis_surat_id == 4) {
					return route('report.suketdomisilipura', $d->id);
				} elseif ($d->jenis_surat_id == 5) {
					return route('report.suketdtks', $d->id);
				} elseif ($d->jenis_surat_id == 6) {
					return route('report.suketjandaduda', $d->id);
				} elseif ($d->jenis_surat_id == 7) {
					return route('report.suketkelahiran', $d->id);
				} elseif ($d->jenis_surat_id == 8) {
					return route('report.suketletaktanah', $d->id);
				} elseif ($d->jenis_surat_id == 9) {
					return route('report.suketmenempatitanah', $d->id);
				} elseif ($d->jenis_surat_id == 10) {
					return route('report.suketmenikah', $d->id);
				} elseif ($d->jenis_surat_id == 11) {
					return route('report.suketmeninggal', $d->id);
				} elseif ($d->jenis_surat_id == 12) {
					return route('report.suketnamaalias', $d->id);
				} elseif ($d->jenis_surat_id == 13) {
					return route('report.suketpindahdomisili', $d->id);
				} elseif ($d->jenis_surat_id == 14) {
					return route('report.suketsudahmampu', $d->id);
				} elseif ($d->jenis_surat_id == 15) {
					return route('report.sukettempatusaha', $d->id);
				} elseif ($d->jenis_surat_id == 16) {
					return route('report.suketdatatercecer', $d->id);
				} elseif ($d->jenis_surat_id == 17) {
					return route('report.sukettidakmampu', $d->id);
				} elseif ($d->jenis_surat_id == 18) {
					return route('report.sukettidakmemilikitempattinggal', $d->id);
				} elseif ($d->jenis_surat_id == 19) {
					return route('report.sukettidakmemilikiketurunan', $d->id);
				} elseif ($d->jenis_surat_id == 20) {
					return route('report.suketusahadagang', $d->id);
				} elseif ($d->jenis_surat_id == 21) {
					return route('report.suketyatimpiatu', $d->id);
				} elseif ($d->jenis_surat_id == 22) {
					return route('report.suketdomisili', $d->id);
				} else {
					return '';
				}
			})
			->addColumn('dok_link_tte', function ($d) {
				if (isset($d->file_tte)) {
					return URL::to($d->file_tte);
				} else {
					return '';
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

	public function pengajuanVerif(Pengajuan $pengajuan, Request $request)
	{
		$user = Auth::user();

		if ($user->role_id == 5 || $user->role_id == 6) {
			try {
				$status = 0;
				if (isset($request->status)) {
					$status = $request->status;
				} else {
					if ($user->role_id == 5) {
						$status = 2;
					} else if ($user->role_id == 6) {
						$status = 4;
					}
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

	public function desaCerdas()
	{
		$result = DesaCerdas::where('isaktif', 1)
			->orderBy('created_at', 'desc')
			->take(25);
		$data = DataTables::of($result)->addColumn('file', function ($d) {
			return URL::to($d->file);
		})->addColumn('dok_link_file', function ($d) {
			return URL::to($d->file);
		})->toJson();
		return response(["data" => $data->original['data']], 200);
	}

	public function lyKesehatan()
	{
		$arr_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

		$result = LayananKesehatan::where('isaktif', 1)
			->orderBy('tanggal', 'desc')
			->take(25);
		$data = DataTables::of($result)->addColumn('tanggal_format', function ($d) {
			return Carbon::parse($d->tanggal)->format('d-m-Y');
		})->addColumn('hari', function ($d) use ($arr_hari) {
			$hari = date("N", strtotime($d->tanggal));
			return $arr_hari[$hari];
		})->toJson();
		return response(["data" => $data->original['data']], 200);
	}

	public function keuangan()
	{
		$result = Keuangan::where('isaktif', 1)
			->orderBy('created_at', 'desc')
			->take(25);
		$data = DataTables::of($result)->addColumn('tanggal_format', function ($d) {
			return Carbon::parse($d->created_at)->format('d-m-Y');
		})->addColumn('dok_link_file', function ($d) {
			return URL::to($d->file);
		})->toJson();
		return response(["data" => $data->original['data']], 200);
	}
}
