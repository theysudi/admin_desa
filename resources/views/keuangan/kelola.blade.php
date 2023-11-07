@extends('layouts.master')

@section('title', 'Keuangan Desa')

@section('breadcrumb')
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0">Keuangan Desa - Tahun Anggaran {{ $tahun }} </h1>
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
					<div class="card-header">
						<a href="{{ route('keuangan.home') }}" class="btn btn-danger">
							<i class="fa fa-arrow-left"></i> Kembali
						</a>
						<button class="btn btn-primary" style="float: right;" id="add">
							<i class="fa fa-plus-circle"></i> Tambah
						</button>
					</div>
					<div class="card-body">
						<table id="table" class="table table-bordered table-hover dataTable dtr-inline" role="grid"
							style="width: 100%;">
							<thead>
								<tr>
									<th>Sumber Dana</th>
									<th>Kode Bidang</th>
									<th>Kode Rekening</th>
									<th>Anggaran</th>
									<th>Realisasi</th>
									<th>Lebih/Kurang</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" data-backdrop="static" id="modal-form">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{ route('keuangan.kelola.store') }}" id="form" method="POST" autocomplete="off">
					<div class="modal-header">
						<h4 class="modal-title">Tambah Pendapatan/Belanja</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							@csrf
							@method('POST')
							<input type="hidden" name="id" value="">
							<div class="col-12">
								<div class="form-group">
									<label>Tahun</label>
									<div class="input-group">
										<input type="text" class="form-control" name="tahun" value="{{ $tahun }}" readonly>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Sumber Dana</label>
									<div class="input-group">
										<select name="sumber_dana" class="form-control s2" required>
											@foreach ($sumber_dana as $val)
												<option value="{{ $val->id }}">{{ $val->nama }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Rekening</label>
									<div class="input-group">
										<select name="rekening" class="form-control s2" required>
											@foreach ($rekening as $val)
												<option value="{{ $val->kd_gabung }}">{{ $val->kd_gabung . ' - ' . $val->nm_rek_4 }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-12 cmb-bidang">
								<div class="form-group">
									<label>Bidang</label>
									<div class="input-group">
										<select name="bidang" class="form-control s2" required>
											@foreach ($bidang as $val)
												<option value="{{ $val->kd_gabung }}">{{ $val->kd_gabung . ' - ' . $val->nm_bidang_3 }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Anggaran</label>
									<div class="input-group">
										<input type="text" class="form-control" name="anggaran" required>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Realisasi</label>
									<div class="input-group">
										<input type="text" class="form-control" name="realisasi" required>
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
			let modal = $('#modal-form');

			let form = modal.find('#form');
			let dtID = form.find('input[name="id"]');
			let tahun = form.find('input[name="tahun"]');
			let sumberDana = form.find('select[name="sumber_dana"]');
			let rekening = form.find('select[name="rekening"]');
			let bidang = form.find('select[name="bidang"]');
			let anggaran = form.find('input[name="anggaran"]');
			let realisasi = form.find('input[name="realisasi"]');

			let $dataTable = $table.DataTable({
				processing: true,
				autoWidth: false,
				ajax: {
					url: '{{ route('keuangan.kelola.dt') }}',
					data: function(d) {
						d.tahun = '{{ $tahun }}';
					},
				},
				columnDefs: [{
					defaultContent: "",
					targets: "_all"
				}],
				columns: [{
					data: "sumber_dana",
					name: "sumber_dana"
				}, {
					data: "kd_bidang_3",
					name: "kd_bidang_3",
					render: function(data, type, row) {
						if (data) {
							return `${row.kd_bidang_1}.${row.kd_bidang_2}.${row.kd_bidang_3} - ${row.nm_bidang_3}`;
						} else {
							return '';
						}
					}
				}, {
					data: "kd_rek_4",
					name: "kd_rek_4",
					render: function(data, type, row) {
						return `${row.kd_rek_1}.${row.kd_rek_2}.${row.kd_rek_3}.${row.kd_rek_4} - ${row.nm_rek_4}`;
					}
				}, {
					data: "anggaran",
					name: "anggaran",
					render: function(data, type, row) {
						return data;
					}
				}, {
					data: "realisasi",
					name: "realisasi",
					render: function(data, type, row) {
						return data;
					}
				}, {
					data: null,
					render: function(data, type, row) {
						let calc = row.anggaran - row.realisasi;
						if (calc < 0) {
							return `(${Math.abs(calc)})`;
						} else {
							return calc;
						}
					}
				}, {
					data: null,
					className: "text-center",
					orderable: false,
					searchable: false,
					name: "action",
					render: function(data, type, row) {
						let button =
							`<button type="button" class="btn btn-sm btn-warning ubah""><i class="fas fa-pencil-alt"></i> Ubah</button> `;
						button +=
							`<button type="button" class="btn btn-sm btn-danger hapus""><i class="fas fa-trash"></i> Hapus</button> `;
						return button;
					}
				}],
				order: [
					[0, "asc"]
				],
			});

			$('.s2').select2({
				theme: 'bootstrap4',
			});

			rekening.on('change', function() {
				let val = $(this).val();
				let exp = null;
				if (val) {
					exp = val.split('.');
				}

				if (exp && exp[0] && exp[0] == 5) {
					$('.cmb-bidang').show();
					$('.cmb-bidang').find('select').prop('required', true);
				} else {
					$('.cmb-bidang').hide();
					$('.cmb-bidang').find('select').prop('required', false);
				}
			});

			modal.on('selesai-request', function(e) {
				$dataTable.ajax.reload(null, false);
			});

			$('#add').on('click', function() {
				dtID.val(null);
				sumberDana.find('option').eq(0).prop('selected', true).trigger('change');
				rekening.find('option').eq(0).prop('selected', true).trigger('change');
				bidang.find('option').eq(0).prop('selected', true).trigger('change');
				anggaran.val(null);
				realisasi.val(null);

				modal.modal({
					backdrop: 'static',
					keyboard: false
				});
			});

			$table.find('tbody').on('click', '.ubah', function() {
				let d = $dataTable.row($(this).parents('tr')).data();
				let rek_gabung = d.kd_rek_1 + '.' + d.kd_rek_2 + '.' + d.kd_rek_3 + '.' + d.kd_rek_4;
				let bidang_gabung = d.kd_bidang_1 + '.' + d.kd_bidang_2 + '.' + d.kd_bidang_3;

				dtID.val(d.id);
				sumberDana.val(d.sumber_dana_id).trigger('change');
				rekening.val(rek_gabung).trigger('change');
				bidang.val(bidang_gabung).trigger('change');
				anggaran.val(d.anggaran);
				realisasi.val(d.realisasi);

				modal.modal({
					backdrop: 'static',
					keyboard: false
				});
			});

			$table.find('tbody').on('click', '.hapus', function() {
				let d = $dataTable.row($(this).parents('tr')).data();
				window.location.href = `{{ route('keuangan.kelola.destroy') }}?tahun=${d.tahun}&id=${d.id}`;
			});

			form.submit(function(e) {
				e.preventDefault();
				let formData = new FormData();
				formData.append('_token', $(this).find('input[name="_token"]').val());
				formData.append('_method', $(this).find('input[name="_method"]').val());
				formData.append('id', dtID.val());
				formData.append('tahun', tahun.val());
				formData.append('sumber_dana_id', sumberDana.val());
				formData.append('sumber_dana', sumberDana.find(":selected").text());
				formData.append('rekening', rekening.val());
				formData.append('rekening_nama', rekening.find(":selected").text());
				formData.append('bidang', bidang.val());
				formData.append('bidang_nama', bidang.find(":selected").text());
				formData.append('anggaran', anggaran.val());
				formData.append('realisasi', realisasi.val());

				$.ajax({
					type: 'POST',
					url: form.attr('action'),
					contentType: false,
					processData: false,
					data: formData
				}).done((response) => {
					Swal.fire({
						"title": "Data Berhasil Disimpan",
						"text": "",
						"timer": 5000,
						"background": "#fff",
						"width": "32rem",
						"padding": "1.25rem",
						"showConfirmButton": false,
						"showCloseButton": true,
						"timerProgressBar": false,
						"customClass": {
							"container": null,
							"popup": null,
							"header": null,
							"title": null,
							"closeButton": null,
							"icon": null,
							"image": null,
							"content": null,
							"input": null,
							"actions": null,
							"confirmButton": null,
							"cancelButton": null,
							"footer": null
						},
						"toast": true,
						"icon": "success",
						"position": "top-end"
					});
					modal.modal('hide');
				}).fail((jqXHR) => {
					Swal.fire({
						"title": "Data Gagal Disimpan",
						"text": "",
						"timer": 5000,
						"background": "#fff",
						"width": "32rem",
						"padding": "1.25rem",
						"showConfirmButton": false,
						"showCloseButton": true,
						"timerProgressBar": false,
						"customClass": {
							"container": null,
							"popup": null,
							"header": null,
							"title": null,
							"closeButton": null,
							"icon": null,
							"image": null,
							"content": null,
							"input": null,
							"actions": null,
							"confirmButton": null,
							"cancelButton": null,
							"footer": null
						},
						"toast": true,
						"icon": "error",
						"position": "top-end"
					});
				}).always((data, textStatus, jqXHR) => {
					modal.trigger("selesai-request");
				});
			});
		});
	</script>
@endsection
