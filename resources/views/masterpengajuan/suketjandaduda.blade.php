@extends('layouts.master')

@section('title', 'Proses Surat')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Proses Surat Keterangan Janda/Duda</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Proses Surat Keterangan Janda/Duda</li>
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
                        <form action="{{ route('masterpengajuan.storesuketjandaduda') }}" method="post" autocomplete="off">
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
                                        data-target="#tanggal_sampai" id="tanggal_surat" value="{{ date('Y-m-d') }}"
                                        name="tanggal_surat" data-toggle="datetimepicker">
                                    <div class="input-group-append" data-target="#tanggal_sampai"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama_hidup" id="nama_hidup"
                                    value="{{ $data->penduduk->nama_lgkp }}" placeholder="Nama Lengkap"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat_hidup" id="alamat_hidup"
                                    value="{{ $data->penduduk->alamat }}" placeholder="Nama Lengkap" class="form-control">
                            </div>

                            <div class="card-title">
                                Masukkan Nama Pasangan
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" id="nama" placeholder="Nama Lengkap"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Pangkat/Golongan</label>
                                    <input type="text" name="pangkat" id="pangkat" placeholder="Pangkat/Golongan"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>NRP/NIP/NPP</label>
                                    <input type="text" name="nip" id="nip" placeholder="NRP/NIP/NPP"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Pensiun</label>
                                    <input type="text" name="nomor_pensiun" id="nomor_pensiun"
                                        placeholder="Nomor Pensiun" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label> Instansi</label>
                                    <input type="text" name="instansi" id="instansi" placeholder="Instansi"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Meninggal</label>
                                    <div class="input-group date" id="tanggal_sampai2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            value="{{ date('Y-m-d') }}" data-target="#tanggal_sampai2"
                                            id="tanggal_meninggal" name="tanggal_meninggal" data-toggle="datetimepicker">
                                        <div class="input-group-append" data-target="#tanggal_sampai2"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <textarea name="deskripsi" class="form-control catatan" rows="3" placeholder="Catatan...">
                                        Berdasar data yang ada pada kami yang bersangkutan tidak/belum menikah lagi.
                                        Demikian pernyataan saya dan saya bertanggung jawab sepenuhnya atas kebenaran
                                        keterangan tersebut.
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


@endsection
