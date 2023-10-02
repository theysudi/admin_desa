@extends('layouts.master')

@section('title', 'Profile')

@section('breadcrumb')
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0">Profile</h1>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active">Ubah Password</li>
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
						<h5>Ubah Password</h5>
					</div>
					<div class="card-body">
						<form action="{{ route('profile.store') }}" method="post" autocomplete="off">
							@csrf
							@method('POST')
							<div class="form-group">
								<input type="hidden" name="id" class="form-control" value="{{ $user->id }}">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" name="username" placeholder="Username" value="{{ $user->username }}">
							</div>
							<div class="form-group">
								<label>Password Lama</label>
								<input type="password" class="form-control" name="password_old" placeholder="Password Lama" value="">
							</div>
							<div class="form-group">
								<label>Password Baru</label>
								<input type="password" class="form-control" name="password_new" placeholder="Password Baru" value="">
							</div>
							<div class="form-group">
								<label>Konfirmasi Password Baru</label>
								<input type="password" class="form-control" name="password_new_confirm" placeholder="Konfirmasi Password Baru" value="">
							</div>

							<div class="form-group text-center">
								<hr>
								<a href="{{ route('masterdata.penduduk.home') }}" class="btn btn-danger" style="width: 100px;">
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

@section('css')
	<style>

	</style>
@endsection

@section('js')

	<script>
		$("#tanggal_dari").datetimepicker({
			format: 'DD-MM-yyyy',
		});
		$("#tanggal_sampai").datetimepicker({
			format: 'DD-MM-yyyy',
		});
	</script>

	<script>
		$('#status').select2({
			theme: 'bootstrap4',
			placeholder: 'Pilih Status'
		});
	</script>
	<script>
		$('#id_kecamatan').select2({
			theme: 'bootstrap4',
		});
	</script>



@endsection
