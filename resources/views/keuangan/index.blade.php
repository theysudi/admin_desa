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
									<th width="30" class="text-center">No</th>
									<th>Nama</th>
									<th>Keterangan</th>
									<th>Tgl. Input</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
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
				processing: true,
				autoWidth: false,
				ajax: '{{ route('keuangan.dt') }}',
				columnDefs: [{
					defaultContent: "",
					targets: "_all"
				}],
				columns: [{
					data: "created_at",
					name: "created_at",
					className: 'text-center',
					orderable: false
				}, {
					data: "nama",
					name: "nama",
				}, {
					data: "keterangan",
					name: "keterangan",
				}, {
					data: "created_at",
					name: "created_at",
					render: function(data, type, row) {
						text = moment(data).format('DD-MM-YYYY');
						return text;
					}
				}, {
					data: null,
					width: "250px",
					className: "text-center",
					orderable: false,
					searchable: false,
					name: "action",
					render: function(data, type, row) {
						let button =
							`<a type="button" class="btn btn-sm btn-primary" href="${row.file}" target="_blank"><i class="fas fa-eye"></i> Lihat File</a> `;
						button +=
							`<button type="button" class="btn btn-sm btn-warning ubah"><i class="fas fa-pencil-alt"></i> Ubah</button> `;
						button +=
							`<button type="button" class="btn btn-sm btn-danger hapus"><i class="fas fa-times"></i> Hapus</button> `;
						return button
					}
				}],
				order: [
					[0, "desc"]
				],
				fnCreatedRow: function(row, data, index) {
					$('td', row).eq(0).html(index + 1);
				},
			});

			// UBAH
			$table.find('tbody').on('click', '.ubah', function() {
				let d = $dataTable.row($(this).parents('tr')).data();
				window.location.href = `{{ route('keuangan.create') }}?id=${d.id}`;
			});

			// Hapus
			$table.find('tbody').on('click', '.hapus', function() {
				let d = $dataTable.row($(this).parents('tr')).data();
				window.location.href = `{{ route('keuangan.destroy') }}?id=${d.id}`;
			});
		});

		$(document).on('click', '#add', function() {
			window.location.href = `{{ route('keuangan.create') }}`;
		});
	</script>
@endsection
