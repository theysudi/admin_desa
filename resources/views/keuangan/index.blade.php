@extends('layouts.master')

@section('title', 'Keuangan Desa')

@section('breadcrumb')
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0">Keuangan Desa</h1>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active">Keuangan Desa</li>
			</ol>
		</div>
	</div>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header text-right">
						<button class="btn btn-primary" id="add">
							<i class="fa fa-plus-circle"></i> Tambah
						</button>
					</div>
					<div class="card-body">
						<table id="table" class="table table-bordered table-hover dataTable dtr-inline" role="grid"
							style="width: 100%;">
							<thead>
								<tr>
									<th>Tahun Anggaran</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" data-backdrop="static" id="modal-add">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<form action="" id="form" method="GET" autocomplete="off">
					<div class="modal-header">
						<h4 class="modal-title">Tambah Tahun Keuangan Desa</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Tahun</label>
									<div class="input-group">
										<input type="text" class="form-control" name="tahun">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script>
		$(document).ready(function() {
			let $table = $("#table");
			let add = $("#add");

			let $dataTable = $table.DataTable({
				processing: true,
				autoWidth: false,
				ajax: '{{ route('keuangan.dt') }}',
				columnDefs: [{
					defaultContent: "",
					targets: "_all"
				}],
				columns: [{
					data: "tahun",
					name: "tahun"
				}, {
					data: null,
					width: "120px",
					className: "text-center",
					orderable: false,
					searchable: false,
					name: "action",
					render: function(data, type, row) {
						let button =
							`<button type="button" class="btn btn-sm btn-warning kelola"><i class="fas fa-sign-out-alt"></i> Kelola</button> `;
						return button
					}
				}],
				order: [
					[0, "asc"]
				],
			});

			// UBAH
			$table.find('tbody').on('click', '.kelola', function() {
				let d = $dataTable.row($(this).parents('tr')).data();
				window.location.href = `{{ route('keuangan.kelola.home') }}?tahun=${d.tahun}`;
			});
		});

		$(document).on('click', '#add', function() {
			let modal = $('#modal-add');
			modal.find('#form').attr('action', '{{ route('keuangan.kelola.home') }}/');

			modal.modal({
				backdrop: 'static',
				keyboard: false
			});
		});
	</script>
@endsection
