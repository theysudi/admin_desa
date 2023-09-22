<?php

namespace App\Http\Controllers;

use App\Models\DesaCerdas;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class DesaCerdasController extends Controller
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
		return view('desacerdas.index');
	}

	public function data()
	{
		$data = DesaCerdas::where('isaktif', 1);
		return DataTables::of($data)->addColumn('action', function ($d) {
			return '<a href="' . route('desacerdas.edit', $d->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i> Edit</a>
      <a style="cursor:pointer;" class="btn btn-xs btn-danger Hapus" ids=' . $d->id . '><i class="fa fa-trash-alt"></i> Hapus</a>';
		})->toJson();
	}

	public function create()
	{
		return view('desacerdas.create');
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

	public function edit($id)
	{
		$desacerdas = DesaCerdas::where('id', $id)->first();
		return view('desacerdas.edit', ['desacerdas' => $desacerdas]);
	}

	public function store(Request $request)
	{
		try {

			if ($request->mode != 'del') {
				$data = [
					"nama" => $request->nama,
					"keterangan" => $request->keterangan,
					"jenis" => $request->jenis,
				];
				if ($request->file) {
					$urlFile = $this->storeFile($request->file('file'), 'desa_cerdas', $request->jenis);
					$data['file'] = $urlFile;
				}
			}
			if ($request->id) {
				if ($request->mode == 'del') {
					DesaCerdas::where('id', $request->id)->update([
						"isaktif" => 0
					]);
				} else {
					DesaCerdas::where('id', $request->id)->update($data);
				}
			} else {
				$id = DesaCerdas::create($data);
			}
			Alert::toast('Data Berhasil Disimpan', 'success');
		} catch (QueryException $e) {
			Alert::toast('Data Gagal Disimpan' . ' ' . $e->errorInfo[2], 'error');
		}
		return redirect()->route('desacerdas.home');
	}
}
