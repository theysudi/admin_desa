@extends('layouts.master')

@section('title', 'Layanan Kesehatan')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Layanan Kesehatan</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Layanan Kesehatan</li>
                <li class="breadcrumb-item active">Edit</li>
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
                        <h5>Ubah Data Posyandu</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('layanankesehatan.store') }}" method="post" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="{{ $layanankesehatan->id }}"
                                    class="form-control" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <div class="input-group date" id="tanggal_sampai" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#tanggal_sampai" id="tanggal"
                                        value="{{ Carbon\Carbon::parse($layanankesehatan->tanggal)->format('Y-m-d H:i:s') }}"
                                        name="tanggal" data-toggle="datetimepicker">
                                    <div class="input-group-append" data-target="#tanggal_sampai"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Waktu Mulai</label>
                                <input type="time" name="waktu_mulai" id="waktu_mulai"
                                    value="{{ $layanankesehatan->waktu_mulai }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Waktu Selesai</label>
                                <input type="time" name="waktu_selesai" id="waktu_selesai"
                                    value="{{ $layanankesehatan->waktu_selesai }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Kegiatan</label>
                                <input type="text" name="kegiatan" id="kegiatan" placeholder="Kegiatan"
                                    value="{{ $layanankesehatan->kegiatan }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Uraian</label>
                                <textarea id="uraian" name="uraian" rows="4" class="form-control">
                                  {{ $layanankesehatan->uraian }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Tempat</label>
                                <input type="text" name="tempat" id="tempat" placeholder="Tempat"
                                    value="{{ $layanankesehatan->tempat }}" class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <hr>
                                <a href="{{ route('layanankesehatan.home') }}" class="btn btn-danger" style="width: 100px;">
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


@endsection
