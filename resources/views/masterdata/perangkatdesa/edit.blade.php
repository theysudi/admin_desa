@extends('layouts.master')

@section('title', 'Peraangkat Desa')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Peraangkat Desa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Peraangkat Desa</li>
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
                        <h5>Ubah Data Perangkat Desa</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('masterdata.perangkatdesa.store') }}" method="post" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="{{ $perangkatdesa->id }}"
                                    class="form-control" placeholder="Nama">
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" id="nama" placeholder="Nama Lengkap"
                                    value="{{ $perangkatdesa->nama }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nomor HP</label>
                                <input type="text" name="no_hp" id="no_hp" placeholder="Nomor HP"
                                    value="{{ $perangkatdesa->no_hp }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <table style="width:100%">
                                    <label>Jenis</label>
                                    <tr>
                                        <td> <input type="radio" id="jenis" name="jenis" value="Kepala Desa">
                                            <label for="html">Kepala Desa</label><br>
                                        </td>
                                        <td><input type="radio" id="jenis" name="jenis" value="Kepala Dusun">
                                            <label for="css">Kepala Dusun</label><br>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" placeholder="jabatan"
                                    value="{{ $perangkatdesa->jabatan }}" class="form-control">
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
        $("#tanggal_dari").datetimepicker({
            format: 'DD-MM-yyyy',
        });
        $("#tanggal_sampai").datetimepicker({
            format: 'DD-MM-yyyy',
        });
    </script>

    <script>
        $('#status').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Status'
        });
    </script>
    <script>
        $('#id_kecamatan').select2({
            theme: 'bootstrap4',
        });
    </script>



@endsection
