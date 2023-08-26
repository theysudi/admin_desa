@extends('layouts.master')

@section('title', 'Proses Surat')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Proses Surat Keterangan Letak Tanah</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Proses Surat Keterangan Letak Tanah</li>
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
                        <form action="{{ route('masterpengajuan.storesuketletaktanah') }}" method="post"
                            autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="{{ $data->id }}"
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
                                <label>Sertifikat</label>
                                <input type="text" name="sertifikat" id="sertifikat" placeholder="Sertifikat"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Luas Tanah</label>
                                <input type="text" name="luas" id="luas" placeholder="Luas Tanah"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Letak Tanah</label>
                                <input type="text" name="letak" id="letak" placeholder="Letak Tanah"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <input type="text" name="kecamatan" id="kecamatan" placeholder="Kecamatan"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <input type="text" name="kabupaten" id="kabupaten" placeholder="Kabupaten"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Atas Nama</label>
                                <input type="text" name="atas_nama" id="atas_nama" placeholder="Atas Nama "
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <textarea name="deskripsi" class="form-control catatan" rows="3" placeholder="Catatan...">
                                        Memang benar bidang tanah tersebut di atas terletak di Wilayah administrasi Desa
                                        Gunaksa, Kecamatan Dawan, Kabupaten Klungkung.
                                        Demikian surat keterangan ini dibuat, untuk dapat dipergunakan sebagai mana mestinya.
                                    </textarea>
                                </div>
                            </div>


                            <div class="form-group text-center">
                                <hr>
                                <a href="{{ route('masterpengajuan.home') }}" class="btn btn-danger" style="width: 100px;">
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
            format: 'DD-MM-yyyy',
        });


        script > $("#tanggal_dari").datetimepicker({
            format: 'DD-MM-yyyy',
        });

        $(function() {
            $('input[name=nilai]').formuang();
        });
    </script>

@endsection
