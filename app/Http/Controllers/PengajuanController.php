<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MasterPenduduk;
use App\Models\Pengajuan;
use App\Models\SuketAhliWaris;
use App\Models\SuketBelumKawin;
use App\Models\SuketDataTercecer;
use App\Models\SuketDomisili;
use App\Models\SuketDomisiliAnakSekolah;
use App\Models\SuketDomisiliPura;
use App\Models\SuketDtks;
use App\Models\SuketJandaDuda;
use App\Models\SuketKelahiran;
use App\Models\SuketLetakTanah;
use App\Models\SuketMenempatiTanah;
use App\Models\SuketMenikah;
use App\Models\SuketMeninggal;
use App\Models\SuketNamaAlias;
use App\Models\SuketPindahDomisili;
use App\Models\SuketSudahMampu;
use App\Models\SuketTempatUsaha;
use App\Models\SuketTidakMampu;
use App\Models\SuketTidakMemilikiKeturunan;
use App\Models\SuketTidakMemilikiTempatTinggal;
use App\Models\SuketUsahaDagang;
use App\Models\SuketYatimPiatu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
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
  public function pengajuanadd()
  {
    $id_penduduk = Auth::user()->userable_id;
    $penduduk = MasterPenduduk::where('id', $id_penduduk)->first();
    $keluarga = MasterPenduduk::where('no_kk', $penduduk->no_kk)->get();
    $jenis_surat = JenisDokumen::all();
    return view('penduduk.pengajuan.pengajuanadd', ['jenis_surat' => $jenis_surat, 'keluarga' => $keluarga]);
  }

  public function permohonan()
  {

    return view('penduduk.pengajuan.permohonan');
  }

  public function masterpengajuan()
  {

    return view('masterpengajuan.pengajuan');
  }

  public function datamasterpengajuan()
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk', 'atasnama')->get();
    // dd($data);
    return DataTables::of($data)->addColumn('statustext', function ($d) {
      if ($d->status == 0) {
        return 'Menunggu';
      } else {
        return 'Selesai';
      }
    })->addColumn('action', function ($d) {

      return '<a href="' . route('masterpengajuan.prosessurat', $d->id) . '" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i> Proses</a>';
    })->toJson();
  }

  public function data()
  {
    $id_penduduk = Auth::user()->userable_id;
    $data = Pengajuan::with('jenis_surat', 'atasnama')->where('penduduk_id', $id_penduduk)->get();
    // dd($data);
    return DataTables::of($data)->addColumn('statustext', function ($d) {
      if ($d->status == 0) {
        return 'Menunggu';
      } else {
        return 'Selesai';
      }
    })->addColumn('action', function ($d) {
      if ($d->status == 0) {
        return '';
      } else {

        //Untuk Report
        if ($d->jenis_surat_id == 1) {
          return '<a href="' . route('report.suketbelumkawin', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 2) {
          return '<a href="' . route('report.suketahliwaris', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 3) {
          return '<a href="' . route('report.suketdomisilianaksekolah', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 4) {
          return '<a href="' . route('report.suketdomisilipura', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 5) {
          return '<a href="' . route('report.suketdtks', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 6) {
          return '<a href="' . route('report.suketjandaduda', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 7) {
          return '<a href="' . route('report.suketkelahiran', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 8) {
          return '<a href="' . route('report.suketletaktanah', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 9) {
          return '<a href="' . route('report.suketmenempatitanah', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 10) {
          return '<a href="' . route('report.suketmenikah', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 11) {
          return '<a href="' . route('report.suketmeninggal', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 12) {
          return '<a href="' . route('report.suketnamaalias', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 13) {
          return '<a href="' . route('report.suketpindahdomisili', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 14) {
          return '<a href="' . route('report.suketsudahmampu', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 15) {
          return '<a href="' . route('report.sukettempatusaha', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 16) {
          return '<a href="' . route('report.suketdatatercecer', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 17) {
          return '<a href="' . route('report.sukettidakmampu', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 18) {
          return '<a href="' . route('report.sukettidakmemilikitempattinggal', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 19) {
          return '<a href="' . route('report.sukettidakmemilikiketurunan', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 20) {
          return '<a href="' . route('report.suketusahadagang', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 21) {
          return '<a href="' . route('report.suketyatimpiatu', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        } elseif ($d->jenis_surat_id == 22) {
          return '<a href="' . route('report.suketdomisili', $d->id) . '" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
        }
      }
    })->toJson();
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

  public function store(Request $request)
  {
    try {
      $data = [
        'penduduk_id' => Auth::user()->userable_id,
        "jenis_surat_id" => $request->jenis_surat_id,
        "tujuan_permohonan" => $request->tujuan_permohonan,
        'penduduk_id_atas_nama' => $request->penduduk_id_atas_nama
      ];

      if ($request->jenis_surat_id == 20) {
        $urlFile = $this->storeFile($request->file('file_bukti'), 'bukti', $request->jenis_surat_id);
        $data['file_bukti'] = $urlFile;
      }

      Pengajuan::create($data);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('penduduk.pengajuan.home');
  }

  // milik suket belum kawin
  public function prosessurat($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();

    //Untuk suket
    if ($data->jenis_surat_id == 1) {
      return view('masterpengajuan.prosessurat',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 2) {
      return view('masterpengajuan.suketahliwaris',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 3) {
      return view('masterpengajuan.suketdomisilianaksekolah',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 4) {
      return view('masterpengajuan.suketdomisilipura',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 5) {
      return view('masterpengajuan.suketdtks',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 6) {
      return view('masterpengajuan.suketjandaduda',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 7) {
      return view('masterpengajuan.suketkelahiran',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 8) {
      return view('masterpengajuan.suketletaktanah',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 9) {
      return view('masterpengajuan.suketmenempatitanah',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 10) {
      return view('masterpengajuan.suketmenikah',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 11) {
      return view('masterpengajuan.suketmeninggal',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 12) {
      return view('masterpengajuan.suketnamaalias',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 13) {
      return view('masterpengajuan.suketpindahdomisili',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 14) {
      return view('masterpengajuan.suketsudahmampu',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 15) {
      return view('masterpengajuan.sukettempatusaha',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 16) {
      return view('masterpengajuan.suketdatatercecer',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 17) {
      return view('masterpengajuan.sukettidakmampu',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 18) {
      return view('masterpengajuan.sukettidakmemilikitempattinggal',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 19) {
      return view('masterpengajuan.sukettidakmemilikiketurunan',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 20) {
      return view('masterpengajuan.suketusahadagang',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 21) {
      return view('masterpengajuan.suketyatimpiatu',  ['data' => $data]);
    } elseif ($data->jenis_surat_id == 22) {
      return view('masterpengajuan.suketdomisili',  ['data' => $data]);
    }
  }

  public function storepengajuan(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketBelumKawin::where('pengajuan_id', $request->id)->delete();
      SuketBelumKawin::create([
        "nama" => $request->nama,
        "jenis_kelamin" => $request->jenis_kelamin,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "agama" => $request->agama,
        "pekerjaan" => $request->pekerjaan,
        "alamat" => $request->alamat,
        "nomor_surat" => $request->nomor_surat,
        "deskripsi_1" => $request->deskripsi_1,
        "deskripsi_2" => $request->deskripsi_2,
        "tgl_surat" => $request->tgl_surat,
        "penduduk_id" => $request->penduduk_id,
        "pengajuan_id" => $request->id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // milik suket belum kawin
  public function suketahliwaris($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketahliwaris',  ['data' => $data]);
  }

  public function storesuketahliwaris(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketAhliWaris::where('pengajuan_id', $request->id)->delete();
      SuketAhliWaris::create([
        "nomor_surat" => $request->nomor_surat,
        "tgl_surat" => $request->tgl_surat,
        "nama" => $request->nama,
        "nik" => $request->nik,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "pekerjaan" => $request->pekerjaan,
        "alamat" => $request->alamat,
        "deskripsi_1" => $request->deskripsi_1,
        "deskripsi_2" => $request->deskripsi_2,
        "penduduk_id" => $request->penduduk_id,
        "pengajuan_id" => $request->id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK DOMISILI ANAK SEKOLAH
  public function suketdomisilianaksekolah($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketdomisilianaksekolah',  ['data' => $data]);
  }

  public function storesuketdomisilianaksekolah(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketDomisiliAnakSekolah::where('pengajuan_id', $request->id)->delete();
      SuketDomisiliAnakSekolah::create([
        "nomor_surat" => $request->nomor_surat,
        "tgl_surat" => $request->tgl_surat,
        "nama_ortu" => $request->nama_ortu,
        "tempat_lahir_ortu" => $request->tempat_lahir_ortu,
        "tgl_lahir_ortu" => $request->tgl_lahir_ortu,
        "jenis_kelamin" => $request->jenis_kelamin,
        "agama" => $request->agama,
        "pekerjaan" => $request->pekerjaan,
        "status_perkawinan" => $request->status_perkawinan,
        "alamat_ortu" => $request->alamat_ortu,
        "deskripsi_1" => $request->deskripsi_1,
        "nama_anak" => $request->nama_anak,
        "tempat_lahir_anak"  => $request->tempat_lahir_anak,
        "tgl_lahir_anak"  => $request->tgl_lahir_anak,
        "alamat_anak" => $request->alamat_anak,
        "penduduk_id" => $request->penduduk_id,
        "pengajuan_id" => $request->id,

      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }


  // MILIK DOMISILI PURA
  public function suketdomisilipura($id)
  {
    $data = Pengajuan::with('jenis_surat')->where('id', $id)->first();
    return view('masterpengajuan.suketdomisilipura',  ['data' => $data]);
  }

  public function storesuketdomisilipura(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketDomisiliPura::where('pengajuan_id', $request->id)->delete();
      SuketDomisiliPura::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama_pengempon" => $request->nama_pengempon,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,

      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK DTKS
  public function suketdtks($id)
  {
    $data = Pengajuan::with('jenis_surat')->where('id', $id)->first();
    return view('masterpengajuan.suketdtks',  ['data' => $data]);
  }

  public function storesuketdtks(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketDtks::where('pengajuan_id', $request->id)->delete();
      SuketDtks::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama_anak" => $request->nama_anak,
        "nik" => $request->nik,
        "no_kk" => $request->no_kk,
        "id_dtks" => $request->id_dtks,
        "nama_anak" => $request->nama_anak,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id

      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK JANDA DUDA
  public function sukejandaduda($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketjandaduda',  ['data' => $data]);
  }

  public function storesuketjandaduda(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketJandaDuda::where('pengajuan_id', $request->id)->delete();
      SuketJandaDuda::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama_hidup" => $request->nama_hidup,
        "alamat_hidup" => $request->alamat_hidup,
        "nama" => $request->nama,
        "pangkat" => $request->pangkat,
        "nip" => $request->nip,
        "nomor_pensiun" => $request->nomor_pensiun,
        "instansi" => $request->instansi,
        "tanggal_meninggal" => $request->tanggal_meninggal,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id

      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK KELAHIRAN
  public function suketkelahiran($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketkelahiran',  ['data' => $data]);
  }

  public function storesuketkelahiran(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketKelahiran::where('pengajuan_id', $request->id)->delete();
      SuketKelahiran::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "pekerjaan" => $request->pekerjaan,
        "agama" => $request->agama,
        "status_perkawinan" => $request->status_perkawinan,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK LETAK TANAH
  public function suketletaktanah($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketletaktanah',  ['data' => $data]);
  }

  public function storesuketletaktanah(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketLetakTanah::where('pengajuan_id', $request->id)->delete();
      SuketLetakTanah::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "sertifikat" => $request->sertifikat,
        "luas" => $request->luas,
        "letak" => $request->letak,
        "kecamatan" => $request->kecamatan,
        "kabupaten" => $request->kabupaten,
        "atas_nama" => $request->atas_nama,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK MENEMPATI TANAH
  public function suketmenempatitanah($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketmenempatitanah',  ['data' => $data]);
  }

  public function storesuketmenempatitanah(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketMenempatiTanah::where('pengajuan_id', $request->id)->delete();
      SuketMenempatiTanah::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "nik" => $request->nik,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "pekerjaan" => $request->pekerjaan,
        "agama" => $request->agama,
        "status_kawin" => $request->status_kawin,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK SUKET MENIKAH
  public function suketmenikah($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketmenikah',  ['data' => $data]);
  }

  public function storesuketmenikah(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketMenikah::where('pengajuan_id', $request->id)->delete();
      SuketMenikah::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "agama" => $request->agama,
        "pekerjaan" => $request->pekerjaan,
        "alamat" => $request->alamat,
        "nama_pasangan" => $request->nama_pasangan,
        "tempat_lahir_pasangan" => $request->tempat_lahir_pasangan,
        "tgl_lahir_pasangan" => $request->tgl_lahir_pasangan,
        "agama_pasangan" => $request->agama_pasangan,
        "pekerjaan_pasangan" => $request->pekerjaan_pasangan,
        "alamat_pasangan" => $request->alamat_pasangan,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK SUKET MENINGGAL
  public function suketmeninggal($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketmeninggal',  ['data' => $data]);
  }

  public function storesuketmeninggal(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketMeninggal::where('pengajuan_id', $request->id)->delete();
      SuketMeninggal::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "nik" => $request->nik,
        "jenis_kelamin" => $request->jenis_kelamin,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "agama" => $request->agama,
        "pekerjaan" => $request->pekerjaan,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK SUKET NAMA ALIAS
  public function suketnamaalias($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketnamaalias',  ['data' => $data]);
  }

  public function storesuketnamaalias(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketNamaAlias::where('pengajuan_id', $request->id)->delete();
      SuketNamaAlias::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "agama" => $request->agama,
        "alamat" => $request->alamat,
        "nama_lain" => $request->nama_lain,
        "tempat_lahir_lain" => $request->tempat_lahir_lain,
        "tgl_lahir_lain" => $request->tgl_lahir_lain,
        "jenis_kelamin_lain" => $request->jenis_kelamin_lain,
        "agama_lain" => $request->agama_lain,
        "alamat_lain" => $request->alamat_lain,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }


  // MILIK SUKET PINDAH DOMISILI
  public function suketpindahdomisili($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketpindahdomisili',  ['data' => $data]);
  }

  public function storesuketpindahdomisili(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketPindahDomisili::where('pengajuan_id', $request->id)->delete();
      SuketPindahDomisili::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "nik" => $request->nik,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "agama" => $request->agama,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK SUKET SUDAH MAMPU
  public function suketsudahmampu($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketsudahmampu',  ['data' => $data]);
  }

  public function storesuketsudahmampu(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketSudahMampu::where('pengajuan_id', $request->id)->delete();
      SuketSudahMampu::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "nik" => $request->nik,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "agama" => $request->agama,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // SUKET TEMPAT USAHA
  public function sukettempatusaha($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.sukettempatusaha',  ['data' => $data]);
  }

  public function storesukettempatusaha(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketTempatUsaha::where('pengajuan_id', $request->id)->delete();
      SuketTempatUsaha::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "agama" => $request->agama,
        "pekerjaan" => $request->pekerjaan,
        "status_kawin" => $request->status_kawin,
        "alamat" => $request->alamat,
        "nama_usaha" => $request->nama_usaha,
        "jenis_usaha" => $request->jenis_usaha,
        "alamat_usaha" => $request->alamat_usaha,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK MENEMPATI TANAH
  public function suketdatatercecer($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketdatatercecer',  ['data' => $data]);
  }

  public function storesuketdatatercecer(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketDataTercecer::where('pengajuan_id', $request->id)->delete();
      SuketDataTercecer::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "nik" => $request->nik,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "pekerjaan" => $request->pekerjaan,
        "agama" => $request->agama,
        "status_kawin" => $request->status_kawin,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK MENEMPATI TIDAK MAMPU
  public function sukettidakmampu($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.sukettidakmampu',  ['data' => $data]);
  }

  public function storesukettidakmampu(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketTidakMampu::where('pengajuan_id', $request->id)->delete();
      SuketTidakMampu::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "nik" => $request->nik,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "pekerjaan" => $request->pekerjaan,
        "agama" => $request->agama,
        "status_kawin" => $request->status_kawin,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK MENEMPATI TIDAK MEMILIKI TEMPAT TINGGAL
  public function sukettidakmemilikitempattinggal($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.sukettidakmemilikitempattinggal',  ['data' => $data]);
  }

  public function storesukettidakmemilikitempattinggal(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketTidakMemilikiTempatTinggal::where('pengajuan_id', $request->id)->delete();
      SuketTidakMemilikiTempatTinggal::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "pekerjaan" => $request->pekerjaan,
        "agama" => $request->agama,
        "status_kawin" => $request->status_kawin,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK MENEMPATI TIDAK MEMILIKI KETURUNAN
  public function sukettidakmemilikiketurunan($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.sukettidakmemilikiketurunan',  ['data' => $data]);
  }

  public function storesukettidakmemilikiketurunan(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketTidakMemilikiKeturunan::where('pengajuan_id', $request->id)->delete();
      SuketTidakMemilikiKeturunan::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "agama" => $request->agama,
        "alamat" => $request->alamat,
        "nama_pasangan" => $request->nama_pasangan,
        "tempat_lahir_pasangan" => $request->tempat_lahir_pasangan,
        "tgl_lahir_pasangan" => $request->tgl_lahir_pasangan,
        "jenis_kelamin_pasangan" => $request->jenis_kelamin_pasangan,
        "agama_pasangan" => $request->agama_pasangan,
        "alamat_pasangan" => $request->alamat_pasangan,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK USAHA DAGANG
  public function suketusahadagang($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketusahadagang',  ['data' => $data]);
  }

  public function storesuketusahadagang(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketUsahaDagang::where('pengajuan_id', $request->id)->delete();
      SuketUsahaDagang::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "pekerjaan" => $request->pekerjaan,
        "agama" => $request->agama,
        "status_kawin" => $request->status_kawin,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK SUKET YATIM PIATU
  public function suketyatimpiatu($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketyatimpiatu',  ['data' => $data]);
  }

  public function storesuketyatimpiatu(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketYatimPiatu::where('pengajuan_id', $request->id)->delete();
      SuketYatimPiatu::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "pekerjaan" => $request->pekerjaan,
        "agama" => $request->agama,
        "status_kawin" => $request->status_kawin,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }

  // MILIK SUKET DOMISILI
  public function suketdomisili($id)
  {
    $data = Pengajuan::with('jenis_surat', 'penduduk')->where('id', $id)->first();
    return view('masterpengajuan.suketdomisili',  ['data' => $data]);
  }

  public function storesuketdomisili(Request $request)
  {
    try {
      Pengajuan::where('id', $request->id)->update([
        "status" => 1
      ]);
      SuketDomisili::where('pengajuan_id', $request->id)->delete();
      SuketDomisili::create([
        "nomor_surat" => $request->nomor_surat,
        "tanggal_surat" => $request->tanggal_surat,
        "nama" => $request->nama,
        "tempat_lahir" => $request->tempat_lahir,
        "tgl_lahir" => $request->tgl_lahir,
        "jenis_kelamin" => $request->jenis_kelamin,
        "pekerjaan" => $request->pekerjaan,
        "agama" => $request->agama,
        "status_kawin" => $request->status_kawin,
        "alamat" => $request->alamat,
        "deskripsi" => $request->deskripsi,
        "pengajuan_id" => $request->id,
        "penduduk_id" => $request->penduduk_id
      ]);

      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterpengajuan.home');
  }
}
