@extends('layouts.master')

@section('title', 'Data Rekening')

@section('breadcrumb')
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0">{{ isset($data) ? 'Ubah' : 'Tambah' }} Rekening Desa</h1>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active">{{ isset($data) ? 'Ubah' : 'Tambah' }} Rekening Desa</li>
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
						<h5>{{ isset($data) ? 'Ubah' : 'Tambah' }} Rekening {{ $rek }} </h5>
					</div>
					<div class="card-body">
						<form action="{{ route('masterdata.rek.store') }}" method="post" autocomplete="off">
							@csrf
							@method('POST')
							<input type="hidden" name="rek" value="{{ $rek }}">
							@if (isset($data))
								<input type="hidden" name="edit_kode" value="{{ $data->kd_gabung }}">
								<input type="hidden" name="edit_nama" value="{{ $data->nm }}">
							@endif
							@if (isset($ref))
								<div class="form-group">
									<label>Kode Rekening {{ $rek - 1 }} </label>
									<select name="ref" class="form-control s2" required>
										@foreach ($ref as $val)
											@if (isset($ref_kd) && $val->kd_gabung == $ref_kd)
												<option selected value="{{ $val->kd_gabung }}">{{ $val->kd_gabung }} - {{ $val->nama }}</option>
											@else
												<option value="{{ $val->kd_gabung }}">{{ $val->kd_gabung }} - {{ $val->nama }}</option>
											@endif
										@endforeach
									</select>
								</div>
							@endif
							<div class="form-group">
								<label>Kode</label>
								<input type="text" name="kode" class="form-control" value="{{ isset($data) ? $data->kd : '' }}" required>
							</div>
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="nama" class="form-control" value="{{ isset($data) ? $data->nm : '' }}" required>
							</div>
							<div class="form-group text-center">
								<hr>
								<a href="{{ route('masterdata.rek.home') }}" class="btn btn-danger" style="width: 100px;">
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

@section('js')
	<script>
		$('.s2').select2({
			theme: 'bootstrap4',
		});
	</script>
@endsection
