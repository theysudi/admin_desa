@extends('layouts.master')

@section('title', 'Data Keuangan')

@section('breadcrumb')
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0">{{ isset($data) ? 'Ubah' : 'Tambah' }} Data Keuangan Desa</h1>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active">{{ isset($data) ? 'Ubah' : 'Tambah' }} Data Keuangan Desa</li>
			</ol>
		</div>
	</div>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header text-left">
						<h5>{{ isset($data) ? 'Ubah' : 'Tambah' }} Data Keuangan</h5>
					</div>
					<div class="card-body">
						<form action="{{ route('keuangan.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
							@csrf
							@method('POST')
							<input type="hidden" name="id" value="{{ isset($data) ? $data->id : '' }}">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="nama" class="form-control" value="{{ isset($data) ? $data->nama : '' }}" required>
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<textarea name="keterangan" class="form-control" rows="3">{{ isset($data) ? $data->keterangan : '' }}</textarea>
							</div>
							<div class="form-group">
								<label>File Upload</label>
								<input type="file" name="file" class="form-control">
								@if (isset($data) && $data->file)
									<br>
									<a href="{{ $data->file }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat File</a>
								@endif
							</div>
							<div class="form-group text-center">
								<hr>
								<a href="{{ route('keuangan.home') }}" class="btn btn-danger" style="width: 100px;">
									<i class="fa fa-times-circle"></i> Batal
								</a>
								<button type="submit" class="btn btn-success" style="width: 100px;">
									<i class="fa fa-check-circle"></i> Simpan
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
