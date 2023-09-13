@extends('layouts.master')

@section('title', 'Perangkat Desa')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Perangkat Desa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Perangkat Desa</li>
                <li class="breadcrumb-item active">Create</li>
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
                        <h5>Tambahkan Perangkat Desa Baru</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('masterdata.perangkatdesa.store') }}" method="post" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" id="nama" placeholder="Nama Lengkap"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nomor HP</label>
                                <input type="text" name="no_hp" id="no_hp" placeholder="Nomor HP"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Jenis</label>
                                <input type="text" name="jenis" id="jenis" placeholder="Jenis"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" placeholder="jabatan"
                                    class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <hr>
                                <a href="{{ route('masterdata.perangkatdesa.home') }}" class="btn btn-danger"
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
        $('#status').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Status'
        });
    </script>

    <script>
        $("#tanggal_sampai").datetimepicker({
            format: 'DD-MM-yyyy',
        });

        $(function() {
            $('input[name=nilai]').formuang();
        });
    </script>
@endsection
