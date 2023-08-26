@extends('layouts.master')

@section('title', 'Proses Surat')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Proses Surat Domisili Anak Sekolah</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Proses Surat Domisili Anak Sekolah</li>
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
                        <form action="{{ route('masterpengajuan.storesuketdomisilianaksekolah') }}" method="post"
                            autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="{{ $data->id }}"
                                    class="form-control" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="penduduk_id" id="penduduk_id" value="{{ $data->penduduk_id }}"
                                    class="form-control" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label>Nomor Surat</label>
                                <input type="text" name="nomor_surat" id="nomor_surat" value="470/ 528/ 2023"
                                    placeholder="Nama Lengkap" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <div class="input-group date" id="tanggal_sampai" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#tanggal_sampai" id="tgl_surat" value="{{ date('Y-m-d') }}"
                                        name="tgl_surat" data-toggle="datetimepicker">
                                    <div class="input-group-append" data-target="#tanggal_sampai"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama_ortu" id="nama_ortu"
                                    value="{{ $data->penduduk->nama_lgkp }}" placeholder="Nama Lengkap"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir_ortu" id="tempat_lahir_ortu"
                                    value="{{ $data->penduduk->tmpt_lhr }}" placeholder="Nama Lengkap" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <div class="input-group date" id="tanggal_sampai3" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        value="{{ $data->penduduk->tgl_lhr }}" data-target="#tanggal_sampai3"
                                        id="tgl_lahir_ortu" name="tgl_lahir_ortu" data-toggle="datetimepicker">
                                    <div class="input-group-append" data-target="#tanggal_sampai3"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" name="jenis_kelamin" id="jenis_klmin"
                                    value="{{ $data->penduduk->jenis_klmin }}" placeholder="Nama Lengkap"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <input type="text" name="agama" id="agama" value="{{ $data->penduduk->agama }}"
                                    placeholder="Nama Lengkap" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan"
                                    value="{{ $data->penduduk->pekerjaan }}" placeholder="Nama Lengkap"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Status Perkawinan</label>
                                <input type="text" name="status_perkawinan" id="status_perkawinan"
                                    value="{{ $data->penduduk->status_kawin }}" placeholder="Nama Lengkap"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat_ortu" id="alamat_ortu"
                                    value="{{ $data->penduduk->alamat }}" placeholder="Nama Lengkap"
                                    class="form-control">
                            </div>

                            <div class="card-title">
                                Masukkan Data Anak
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                    <label>Nama Anak</label>
                                    <input type="text" name="nama_anak" id="nama_anak"
                                        placeholder="Nama Lengkap Anak" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir Anak</label>
                                    <input type="text" name="tempat_lahir_anak" id="tempat_lahir_anak"
                                        placeholder="Tempat Lahir Anak" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal lahir Anak</label>
                                    <div class="input-group date" id="tanggal_sampai2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            value="{{ date('Y-m-d') }}" data-target="#tanggal_sampai2"
                                            id="tgl_lahir_anak" name="tgl_lahir_anak" data-toggle="datetimepicker">
                                        <div class="input-group-append" data-target="#tanggal_sampai2"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat Anak</label>
                                    <input type="text" name="alamat_anak" id="alamat_anak" placeholder="Alamat Anak"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <textarea name="deskripsi_1" class="form-control catatan" rows="3" placeholder="Catatan...">
                                        Memang benar I Komang Dirga Saputra tinggal di wilayah Banjar Dinas Patus Desa
                                        Gunaksa Kec. Dawan Kab. Klungkung.
                                        Surat Keterangan ini dibuat sebagai persyaratan Penerimaan Peserta Didik Baru di SD N 3 Gunaksa. Demikian surat keterangan ini dibuat, untuk dapat dipergunakan sebagaimana mestinya.
                                 </textarea>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <hr>
                                <a href="{{ route('masterpengajuan.home') }}" class="btn btn-danger"
                                    style="width: 100px;">
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
        $('.catatan').summernote({
            inheritPlaceholder: true,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ]
        });
        $('#status').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Status'
        });
    </script>

    <script>
        $("#tanggal_sampai").datetimepicker({
            format: 'yyyy-MM-DD',
        });
        script > $("#tanggal_dari").datetimepicker({
            format: 'DD-MM-yyyy',
        });

        $(function() {
            $('input[name=nilai]').formuang();
        });
    </script>

    <script>
        $("#tanggal_sampai2").datetimepicker({
            format: 'yyyy-MM-DD',
        });
        script > $("#tanggal_dari2").datetimepicker({
            format: 'DD-MM-yyyy',
        });
    </script>


    <script>
        $("#tanggal_sampai3").datetimepicker({
            format: 'yyyy-MM-DD',
        });
        script > $("#tanggal_dari3").datetimepicker({
            format: 'DD-MM-yyyy',
        });
    </script>

@endsection
