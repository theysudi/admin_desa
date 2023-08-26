<?php

namespace App\Http\Controllers;

use PDF;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use App\Models\Pengajuan;
use App\Models\KonsultasiDokumen;
use App\Models\SuketAhliWaris;
use App\Models\SuketBelumKawin;
use App\Models\SuketDataTercecer;
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
use App\Models\SuketTidakMemilikiTempatTinggal;
use Illuminate\Support\Facades\Storage;


class ReportController extends Controller
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
    return view('penduduk.pengajuan.permohonan');
  }

  public function suketbelumkawin($id)
  {
    $setting = Setting::first();
    $data = SuketBelumKawin::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tgl_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tgl_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tgl_surat)->format('d');
    $tahun = Carbon::parse($data->tgl_surat)->format('Y');
    $bulanlhr = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallhr = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlhr = Carbon::parse($data->tgl_lahir)->format('Y');
    $pdf = PDF::loadView('report.suketbelumkawin', ['data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'bulanlhr' => $bulanlhr, 'tanggallhr' => $tanggallhr, 'tahunlhr' => $tahunlhr]);

    return $pdf->stream('Surat Keterangan  Belum Menikah' . ' ' . '.pdf');
  }

  public function suketahliwaris($id)
  {
    $setting = Setting::first();
    $data = SuketAhliWaris::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tgl_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tgl_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tgl_surat)->format('d');
    $tahun = Carbon::parse($data->tgl_surat)->format('Y');
    $bulanlhr = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallhr = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlhr = Carbon::parse($data->tgl_lahir)->format('Y');
    $pdf = PDF::loadView('report.suketahliwaris', ['data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'tahun' => $tahun,  'bulanlhr' => $bulanlhr, 'tanggallhr' => $tanggallhr, 'tahunlhr' => $tahunlhr]);

    return $pdf->stream('Surat Keterangan Ahli Waris' . ' ' . '.pdf');
  }

  public function suketdomisilianaksekolah($id)
  {
    $setting = Setting::first();
    $data = SuketDomisiliAnakSekolah::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tgl_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tgl_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tgl_surat)->format('d');
    $tahun = Carbon::parse($data->tgl_surat)->format('Y');
    $bulanlhr = Carbon::parse($data->tgl_lahir_ortu)->locale('id')->isoFormat('MMMM');
    $tanggallhr = Carbon::parse($data->tgl_lahir_ortu)->format('d');
    $tahunlhr = Carbon::parse($data->tgl_lahir_ortu)->format('Y');
    $bulanlhranak = Carbon::parse($data->tgl_lahir_anak)->locale('id')->isoFormat('MMMM');
    $tanggallhranak = Carbon::parse($data->tgl_lahir_anak)->format('d');
    $tahunlhranak = Carbon::parse($data->tgl_lahir_anak)->format('Y');
    $pdf = PDF::loadView('report.suketdomisilianaksekolah', ['data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'tahun' => $tahun,  'bulanlhr' => $bulanlhr, 'tanggallhr' => $tanggallhr, 'tahunlhr' => $tahunlhr, 'bulanlhranak' => $bulanlhranak, 'tanggallhranak' => $tanggallhranak, 'tahunlhranak' => $tahunlhranak]);

    return $pdf->stream('Surat Keterangan Domisili Anak Sekolah' . ' ' . '.pdf');
  }

  public function suketdomisilipura($id)
  {
    $setting = Setting::first();
    $data = SuketDomisiliPura::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');

    $pdf = PDF::loadView('report.suketdomisilipura', ['data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'tahun' => $tahun]);

    return $pdf->stream('Surat Keterangan Domisili Pura' . ' ' . '.pdf');
  }

  public function suketdtks($id)
  {
    $setting = Setting::first();
    $data = SuketDtks::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');

    $pdf = PDF::loadView('report.suketdtks', ['data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'tahun' => $tahun]);

    return $pdf->stream('Surat Keterangan Domisili Pura' . ' ' . '.pdf');
  }

  public function suketjandaduda($id)
  {
    $setting = Setting::first();
    $data = SuketJandaDuda::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanmeninggal = Carbon::parse($data->tanggal_meninggal)->locale('id')->isoFormat('MMMM');
    $tanggalmeninggal = Carbon::parse($data->tanggal_meninggal)->format('d');
    $tahunmeninggal = Carbon::parse($data->tanggal_meninggal)->format('Y');

    $pdf = PDF::loadView('report.suketjandaduda', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'bulanmeninggal' => $bulanmeninggal, 'tanggalmeninggal' => $tanggalmeninggal, 'tahunmeninggal' => $tahunmeninggal,
    ]);

    return $pdf->stream('Surat Keterangan Janda / Duda' . ' ' . '.pdf');
  }

  public function suketkelahiran($id)
  {
    $setting = Setting::first();
    $data = SuketKelahiran::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanlahir = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallahir = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlahir = Carbon::parse($data->tgl_lahir)->format('Y');

    $pdf = PDF::loadView('report.suketkelahiran', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'bulanlahir' => $bulanlahir, 'tanggallahir' => $tanggallahir, 'tahunlahir' => $tahunlahir
    ]);

    return $pdf->stream('Surat Keterangan Kelahiran' . ' ' . '.pdf');
  }

  public function suketletaktanah($id)
  {
    $setting = Setting::first();
    $data = SuketLetakTanah::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');

    $pdf = PDF::loadView('report.suketletaktanah', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun
    ]);

    return $pdf->stream('Surat Keterangan Letak Tanah' . ' ' . '.pdf');
  }

  public function suketmenempatitanah($id)
  {
    $setting = Setting::first();
    $data = SuketMenempatiTanah::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanlahir = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallahir = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlahir = Carbon::parse($data->tgl_lahir)->format('Y');

    $pdf = PDF::loadView('report.suketmenempatitanah', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'bulanlahir' => $bulanlahir, 'tanggallahir' => $tanggallahir, 'tahunlahir' => $tahunlahir
    ]);

    return $pdf->stream('Surat Keterangan Kelahiran' . ' ' . '.pdf');
  }

  public function suketmenikah($id)
  {
    $setting = Setting::first();
    $data = SuketMenikah::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanlahir = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallahir = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlahir = Carbon::parse($data->tgl_lahir)->format('Y');
    $bulanlahirpsg = Carbon::parse($data->tgl_lahir_pasangan)->locale('id')->isoFormat('MMMM');
    $tanggallahirpsg = Carbon::parse($data->tgl_lahir_pasangan)->format('d');
    $tahunlahirpsg = Carbon::parse($data->tgl_lahir_pasangan)->format('Y');

    $pdf = PDF::loadView('report.suketmenikah', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal,
      'tahun' => $tahun, 'bulanlahir' => $bulanlahir, 'tanggallahir' => $tanggallahir,
      'tahunlahir' => $tahunlahir, 'bulanlahirpsg' => $bulanlahirpsg, 'tanggallahirpsg' => $tanggallahirpsg, 'tahunlahirpsg' => $tahunlahirpsg
    ]);

    return $pdf->stream('Surat Keterangan Menikah' . ' ' . '.pdf');
  }

  public function suketmeninggal($id)
  {
    $setting = Setting::first();
    $data = SuketMeninggal::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanlahir = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallahir = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlahir = Carbon::parse($data->tgl_lahir)->format('Y');


    $pdf = PDF::loadView('report.suketmeninggal', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal,
      'tahun' => $tahun, 'bulanlahir' => $bulanlahir, 'tanggallahir' => $tanggallahir,
      'tahunlahir' => $tahunlahir
    ]);

    return $pdf->stream('Surat Keterangan Meninggal' . ' ' . '.pdf');
  }

  public function suketnamaalias($id)
  {
    $setting = Setting::first();
    $data = SuketNamaAlias::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanlahir = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallahir = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlahir = Carbon::parse($data->tgl_lahir)->format('Y');
    $bulanlahir_lain = Carbon::parse($data->tgl_lahir_lain)->locale('id')->isoFormat('MMMM');
    $tanggallahir_lain = Carbon::parse($data->tgl_lahir_lain)->format('d');
    $tahunlahir_lain = Carbon::parse($data->tgl_lahir_lain)->format('Y');


    $pdf = PDF::loadView('report.suketnamaalias', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal,
      'tahun' => $tahun, 'bulanlahir' => $bulanlahir, 'tanggallahir' => $tanggallahir,
      'tahunlahir' => $tahunlahir, 'bulanlahir_lain' => $bulanlahir_lain, 'tanggallahir_lain' => $tanggallahir_lain,
      'tahunlahir_lain' => $tahunlahir_lain
    ]);

    return $pdf->stream('Surat Keterangan Nama Alias / Sama' . ' ' . '.pdf');
  }

  public function suketpindahdomisili($id)
  {
    $setting = Setting::first();
    $data = SuketPindahDomisili::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanlahir = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallahir = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlahir = Carbon::parse($data->tgl_lahir)->format('Y');

    $pdf = PDF::loadView('report.suketpindahdomisili', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'bulanlahir' => $bulanlahir, 'tanggallahir' => $tanggallahir, 'tahunlahir' => $tahunlahir
    ]);

    return $pdf->stream('Surat Keterangan Pindah Domisili' . ' ' . '.pdf');
  }

  public function suketsudahmampu($id)
  {
    $setting = Setting::first();
    $data = SuketSudahMampu::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanlahir = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallahir = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlahir = Carbon::parse($data->tgl_lahir)->format('Y');

    $pdf = PDF::loadView('report.suketsudahmampu', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'bulanlahir' => $bulanlahir, 'tanggallahir' => $tanggallahir, 'tahunlahir' => $tahunlahir
    ]);

    return $pdf->stream('Surat Keterangan Sudah Mampu' . ' ' . '.pdf');
  }

  public function sukettempatusaha($id)
  {
    $setting = Setting::first();
    $data = SuketTempatUsaha::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanlahir = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallahir = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlahir = Carbon::parse($data->tgl_lahir)->format('Y');

    $pdf = PDF::loadView('report.sukettempatusaha', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'bulanlahir' => $bulanlahir, 'tanggallahir' => $tanggallahir, 'tahunlahir' => $tahunlahir
    ]);

    return $pdf->stream('Surat Keterangan Tempat Usaha' . ' ' . '.pdf');
  }

  public function suketdatatercecer($id)
  {
    $setting = Setting::first();
    $data = SuketDataTercecer::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanlahir = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallahir = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlahir = Carbon::parse($data->tgl_lahir)->format('Y');

    $pdf = PDF::loadView('report.suketdatatercecer', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'bulanlahir' => $bulanlahir, 'tanggallahir' => $tanggallahir, 'tahunlahir' => $tahunlahir
    ]);

    return $pdf->stream('Surat Keterangan Data Tercecer' . ' ' . '.pdf');
  }

  public function sukettidakmampu($id)
  {
    $setting = Setting::first();
    $data = SuketTidakMampu::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanlahir = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallahir = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlahir = Carbon::parse($data->tgl_lahir)->format('Y');

    $pdf = PDF::loadView('report.sukettidakmampu', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'bulanlahir' => $bulanlahir, 'tanggallahir' => $tanggallahir, 'tahunlahir' => $tahunlahir
    ]);

    return $pdf->stream('Surat Keterangan Tidak Mampu' . ' ' . '.pdf');
  }

  public function sukettidakmemilikitempattinggal($id)
  {
    $setting = Setting::first();
    $data = SuketTidakMemilikiTempatTinggal::where('pengajuan_id', $id)->first();
    $hari = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('dddd');
    $bulan = Carbon::parse($data->tanggal_surat)->locale('id')->isoFormat('MMMM');
    $tanggal = Carbon::parse($data->tanggal_surat)->format('d');
    $tahun = Carbon::parse($data->tanggal_surat)->format('Y');
    $bulanlahir = Carbon::parse($data->tgl_lahir)->locale('id')->isoFormat('MMMM');
    $tanggallahir = Carbon::parse($data->tgl_lahir)->format('d');
    $tahunlahir = Carbon::parse($data->tgl_lahir)->format('Y');

    $pdf = PDF::loadView('report.sukettidakmemilikitempattinggal', [
      'data' => $data, 'hari' => $hari, 'bulan' => $bulan, 'tanggal' => $tanggal, 'tahun' => $tahun, 'bulanlahir' => $bulanlahir, 'tanggallahir' => $tanggallahir, 'tahunlahir' => $tahunlahir
    ]);

    return $pdf->stream('Surat Keterangan Tidak Mampu' . ' ' . '.pdf');
  }
}
