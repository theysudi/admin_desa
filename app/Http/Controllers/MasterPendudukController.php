<?php

namespace App\Http\Controllers;


use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MasterPenduduk;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class masterPendudukController extends Controller
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

    return view('masterdata.penduduk.index');
  }

  public function data()
  {
    $data = MasterPenduduk::all();
    return DataTables::of($data)->addColumn('action', function ($d) {
      return '<a href="' . route('masterdata.penduduk.edit', $d->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> Edit</a>';
    })->toJson();
  }

  public function create()
  {
    $penduduk = MasterPenduduk::all();
    return view('masterdata.penduduk.create');
  }

  public function edit($id)
  {
    $penduduk = MasterPenduduk::where('id', $id)->first();
    return view('masterdata.penduduk.edit', ['penduduk' => $penduduk], ['penduduk' => $penduduk]);
  }

  public function store(Request $request)
  {
    try {
      if ($request->id) {
        if ($request->mode == 'del') {
          MasterPenduduk::where('id', $request->id)->update([
            "isaktif" => 0
          ]);
        } else {
          MasterPenduduk::where('id', $request->id)->update([
            "kecamatan" => $request->kecamatan,
            "no_kk" => $request->no_kk,
            "nik" => $request->nik,
            "nama_lgkp" => $request->nama_lgkp,
            "tmpt_lhr" => $request->tmpt_lhr,
            "tgl_lhr" => $request->tgl_lhr,
            "jenis_klmin" => $request->jenis_klmin,
            "status_kawin" => $request->status_kawin,
            "golongan_darah" => $request->golongan_darah,
            "hub_keluarga" => $request->hub_keluarga,
            "agama" => $request->agama,
            "pendidikan" => $request->pendidikan,
            "pekerjaan" => $request->pekerjaan,
            "nama_lgkp_ibu" => $request->nama_lgkp_ibu,
            "nama_lgkp_ayah" => $request->nama_lgkp_ayah,
            "alamat" => $request->alamat
          ]);
        }
      } else {
        $id = MasterPenduduk::create([
          "kecamatan" => $request->kecamatan,
          "no_kk" => $request->no_kk,
          "nik" => $request->nik,
          "nama_lgkp" => $request->nama_lgkp,
          "tmpt_lhr" => $request->tmpt_lhr,
          "tgl_lhr" => $request->tgl_lhr,
          "jenis_klmin" => $request->jenis_klmin,
          "status_kawin" => $request->status_kawin,
          "golongan_darah" => $request->golongan_darah,
          "hub_keluarga" => $request->hub_keluarga,
          "agama" => $request->agama,
          "pendidikan" => $request->pendidikan,
          "pekerjaan" => $request->pekerjaan,
          "nama_lgkp_ibu" => $request->nama_lgkp_ibu,
          "nama_lgkp_ayah" => $request->nama_lgkp_ayah,
          "alamat" => $request->alamat
        ]);
      }
      Alert::toast('Data Berhasil Disimpan', 'success');
    } catch (QueryException $e) {
      Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
    }
    return redirect()->route('masterdata.penduduk.home');
  }
}
