@extends('layouts.master')

@section('title', 'Data Bidang')

@section('breadcrumb')
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0">Bidang Desa</h1>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active">Bidang Desa</li>
			</ol>
		</div>
	</div>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary card-tabs">
					<div class="card-header p-0 pt-1">
						<ul class="nav nav-tabs" id="custom-tabs-bidang" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="bidang-1-tab" data-toggle="pill" href="#bidang-1" role="tab"
									aria-controls="bidang-1" aria-selected="true">Bidang 1</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="bidang-2-tab" data-toggle="pill" href="#bidang-2" role="tab" aria-controls="bidang-2"
									aria-selected="false">Bidang 2</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="bidang-3-tab" data-toggle="pill" href="#bidang-3" role="tab" aria-controls="bidang-3"
									aria-selected="false">Bidang 3</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content" id="custom-tabs-bidangContent">

							{{-- BIDANG 1 --}}
							<div class="tab-pane fade active show" id="bidang-1" role="tabpanel" aria-labelledby="bidang-1-tab">
								<div class="row">
									<div class="col-md-12 text-right">
										<a href="{{ route('masterdata.bidang.create') }}?b=1" class="btn btn-primary">
											<i class="fa fa-plus-circle"></i> Tambah
										</a>
									</div>
									<div class="col-md-12 mt-5">
										<table id="tableB1" class="table table-bordered table-hover dataTable dtr-inline" role="grid"
											style="width: 100%;">
											<thead>
												<tr>
													<th width="100px">Kode Bidang</th>
													<th>Nama</th>
													<th>Action</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>

							{{-- BIDANG 2 --}}
							<div class="tab-pane fade" id="bidang-2" role="tabpanel" aria-labelledby="bidang-2-tab">
								<div class="row">
									<div class="col-md-12 text-right">
										<a href="{{ route('masterdata.bidang.create') }}?b=2" class="btn btn-primary">
											<i class="fa fa-plus-circle"></i> Tambah
										</a>
									</div>
									<div class="col-md-12 mt-5">
										<table id="tableB2" class="table table-bordered table-hover dataTable dtr-inline" role="grid"
											style="width: 100%;">
											<thead>
												<tr>
													<th width="100px">Kode Bidang</th>
													<th>Nama</th>
													<th>Action</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>

							{{-- BIDANG 3 --}}
							<div class="tab-pane fade" id="bidang-3" role="tabpanel" aria-labelledby="bidang-3-tab">
								<div class="row">
									<div class="col-md-12 text-right">
										<a href="{{ route('masterdata.bidang.create') }}?b=3" class="btn btn-primary">
											<i class="fa fa-plus-circle"></i> Tambah
										</a>
									</div>
									<div class="col-md-12 mt-5">
										<table id="tableB3" class="table table-bordered table-hover dataTable dtr-inline" role="grid"
											style="width: 100%;">
											<thead>
												<tr>
													<th width="100px">Kode Bidang</th>
													<th>Nama</th>
													<th>Action</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script>
		const PAGE_URL = `${BASE_URL}/masterdata/bidang`;

		$(document).ready(function() {
			let $tableB1 = $("#tableB1");
			let $tableB2 = $("#tableB2");
			let $tableB3 = $("#tableB3");

			let $dataTableB1 = $tableB1.DataTable({
				processing: true,
				autoWidth: false,
				ajax: `${PAGE_URL}/dtB1`,
				columnDefs: [{
					defaultContent: "",
					targets: "_all"
				}],
				columns: [{
					data: "kd_bidang_1",
					name: "kd_bidang_1"
				}, {
					data: "nm_bidang_1",
					name: "nm_bidang_1"
				}, {
					data: null,
					className: "text-right",
					orderable: false,
					searchable: false,
					name: "action",
					render: function(data, type, row) {
						let button =
							`<button type="button" class="btn btn-sm btn-warning ubah""><i class="fas fa-pencil-alt"></i> Ubah</button> `;
						button +=
							`<button type="button" class="btn btn-sm btn-danger hapus""><i class="fas fa-trash"></i> Hapus</button> `;
						return button
					}
				}],
				order: [
					[0, "asc"]
				],
			});

			let $dataTableB2 = $tableB2.DataTable({
				processing: true,
				autoWidth: false,
				ajax: `${PAGE_URL}/dtB2`,
				columnDefs: [{
					defaultContent: "",
					targets: "_all"
				}],
				columns: [{
					data: "kd_bidang_1",
					name: "kd_bidang_1",
					render: function(data, type, row) {
						return `${data}.${row.kd_bidang_2}`
					}
				}, {
					data: "nm_bidang_2",
					name: "nm_bidang_2"
				}, {
					data: null,
					className: "text-right",
					orderable: false,
					searchable: false,
					name: "action",
					render: function(data, type, row) {
						let button =
							`<button type="button" class="btn btn-sm btn-warning ubah""><i class="fas fa-pencil-alt"></i> Ubah</button> `;
						button +=
							`<button type="button" class="btn btn-sm btn-danger hapus""><i class="fas fa-trash"></i> Hapus</button> `;
						return button
					}
				}],
				order: [
					[0, "asc"]
				],
			});

			let $dataTableB3 = $tableB3.DataTable({
				processing: true,
				autoWidth: false,
				ajax: `${PAGE_URL}/dtB3`,
				columnDefs: [{
					defaultContent: "",
					targets: "_all"
				}],
				columns: [{
					data: "kd_bidang_1",
					name: "kd_bidang_1",
					render: function(data, type, row) {
						return `${data}.${row.kd_bidang_2}.${row.kd_bidang_3}`
					}
				}, {
					data: "nm_bidang_3",
					name: "nm_bidang_3"
				}, {
					data: null,
					className: "text-right",
					orderable: false,
					searchable: false,
					name: "action",
					render: function(data, type, row) {
						let button =
							`<button type="button" class="btn btn-sm btn-warning ubah""><i class="fas fa-pencil-alt"></i> Ubah</button> `;
						button +=
							`<button type="button" class="btn btn-sm btn-danger hapus""><i class="fas fa-trash"></i> Hapus</button> `;
						return button
					}
				}],
				order: [
					[0, "asc"]
				],
			});

			// UBAH
			$tableB1.find('tbody').on('click', '.ubah', function() {
				let d = $dataTableB1.row($(this).parents('tr')).data();
				window.location.href = `{{ route('masterdata.bidang.create') }}?b=1&kd=${d.kd_bidang_1}`;
			});

			$tableB2.find('tbody').on('click', '.ubah', function() {
				let d = $dataTableB2.row($(this).parents('tr')).data();
				window.location.href = `{{ route('masterdata.bidang.create') }}?b=2&kd=${d.kd_bidang_1}.${d.kd_bidang_2}`;
			});

			$tableB3.find('tbody').on('click', '.ubah', function() {
				let d = $dataTableB3.row($(this).parents('tr')).data();
				window.location.href = `{{ route('masterdata.bidang.create') }}?b=3&kd=${d.kd_bidang_1}.${d.kd_bidang_2}.${d.kd_bidang_3}`;
			});
			
			// HAPUS
			$tableB1.find('tbody').on('click', '.hapus', function() {
				let d = $dataTableB1.row($(this).parents('tr')).data();
				window.location.href = `{{ route('masterdata.bidang.destroy') }}?b=1&kd=${d.kd_bidang_1}`;
			});

			$tableB2.find('tbody').on('click', '.hapus', function() {
				let d = $dataTableB2.row($(this).parents('tr')).data();
				window.location.href = `{{ route('masterdata.bidang.destroy') }}?b=2&kd=${d.kd_bidang_1}.${d.kd_bidang_2}`;
			});

			$tableB3.find('tbody').on('click', '.hapus', function() {
				let d = $dataTableB3.row($(this).parents('tr')).data();
				window.location.href = `{{ route('masterdata.bidang.destroy') }}?b=3&kd=${d.kd_bidang_1}.${d.kd_bidang_2}.${d.kd_bidang_3}`;
			});

		});
	</script>
@endsection
