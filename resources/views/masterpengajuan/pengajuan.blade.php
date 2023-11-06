@extends('layouts.master')

@section('title', 'Pengajuan')

@section('breadcrumb')
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0">Pengajuan</h1>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active">Pengajuan</li>
			</ol>
		</div>
	</div>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<table id="table" class="table table-bordered table-hover dataTable dtr-inline" role="grid"
							style="width: 100%;">
							<thead>
								<tr>
									<th width="30" class="text-center">No</th>
									<th>Tanggal Permohonan</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Jenis Surat</th>
									<th>Atas Nama</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" data-backdrop="static" id="modal-tte">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<form action="" id="form" method="POST" autocomplete="off" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="modal-header">
						<h4 class="modal-title">Upload Dokumen TTE</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>File Dokumen TTE</label>
									<div class="input-group">
										<input type="file" class="form-control" name="file_tte">
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

@section('css')
	<style>

	</style>
@endsection

@section('js')
	<script>
		$(document).ready(function() {
			let dTable = $('#table').DataTable({
				responsive: true,
				processing: true,
				serverSide: true,
				ajax: {
					url: '{{ route('masterpengajuan.datamasterpengajuan') }}',
					type: 'GET',
				},
				columnDefs: [{
					defaultContent: "",
					targets: "_all"
				}],
				columns: [{
						data: 'id',
						name: 'id',
						className: 'text-center',
						orderable: false
					},
					{
						data: 'created_at',
						name: 'created_at',
						render: function(data, type, row) {
							text = moment(data).format('DD-MM-YYYY');
							return text;
						}
					},
					{
						data: 'penduduk.nik',
						name: 'penduduk.penduduk_id'
					},
					{
						data: 'penduduk.nama_lgkp',
						name: 'penduduk.penduduk_id'
					},
					{
						data: 'penduduk.alamat',
						name: 'penduduk.penduduk_id'
					},
					{
						data: 'jenis_surat.jenis_surat',
						name: 'jenis_surat.jenis_surat_id'
					},
					{
						data: 'atasnama.nama_lgkp',
						name: 'atasnama.nama_lgkp'
					},
					{
						data: 'status',
						name: 'status',
						className: 'text-center',
						render: function(data, type, row) {
							let act = row.action;
							if (row.file_tte == null && data == 4) {
								act +=
									` <button class="btn btn-sm btn-primary upload-tte"><i class="fa fa-upload"></i> Upload</button>`;
							} else if (row.file_tte != null && data == 4) {
								act +=
									` <a href="${row.file_tte}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Dokumen TTE</a>`;
							}
							return act;
						}
					}
				],
				order: [
					[7, 'asc']
				],
				oLanguage: {
					sProcessing: "Memuat Data.."
				},
				fnCreatedRow: function(row, data, index) {
					if (data.status == 0 || data.status == 2) {
						$(row).addClass("bg-warning");
					}
					$('td', row).eq(0).html(index + 1);
				},
				// fnCreatedRow: function(row, data, index) {
				//     $('td', row).eq(0).html(index + 1);
				// },
			});

			$('#table').find('tbody').on('click', '.upload-tte', function() {
				let data = dTable.row($(this).parents('tr')).data();

				let modal = $('#modal-tte');
				modal.find('#form').attr('action', '{{ route('masterpengajuan.uploadtte') }}/' + data.id);

				modal.modal({
					backdrop: 'static',
					keyboard: false
				});
			})
		});

		$(document).on('click', '.Hapus', function() {
			var id = $(this).attr("ids");
			var nama = $(this).closest('tr').find('.nama').text()
			swalWithBootstrapButtons.fire({
				title: 'Anda yakin menghapus' + ' ' + nama + ' ' + '?',
				icon: 'warning',
				showCancelButton: true,
				cancelButtonText: 'Batal',
				confirmButtonText: 'Hapus',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '{{ route('penduduk.pengajuan.store') }}',
						type: 'POST',
						cache: false,
						data: {
							id: id,
							mode: 'del',
							_token: "{{ csrf_token() }}"
						},
						success: function(data) {
							notifikasi({
								icon: 'success',
								type: 'success',
								title: 'Berhasil Menyimpan Data'
							});
							window.location.reload();
						}
					});
				}
			})
		});
	</script>
@endsection
