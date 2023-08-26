@extends('layouts.master')

@section('title', 'Penduduk')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Penduduk</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Penduduk</li>
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
                        <h5>Tambahkan Penduduk Baru</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('masterdata.penduduk.store') }}" method="post" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <input type="text" name="kecamatan" id="kecamatan" placeholder="Kecamatan"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nomor KK</label>
                                <input type="text" name="no_kk" id="no_kk" placeholder="Nomor KK"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" id="nik" placeholder="NIK" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama_lgkp" id="nama_lgkp" placeholder="Nama Lengkap"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tmpt_lhr" id="tmpt_lhr" placeholder="Tempat Lahir"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <div class="input-group date" id="tanggal_sampai" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#tanggal_sampai" id="tgl_lhr" value="{{ date('Y-m-d H:i:s') }}"
                                        name="tgl_lhr" data-toggle="datetimepicker">
                                    <div class="input-group-append" data-target="#tanggal_sampai"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" name="jenis_klmin" id="jenis_klmin" placeholder="Jenis Kelamin"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Status Kawin</label>
                                <input type="text" name="status_kawin" id="status_kawin" placeholder="Status Kawin"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Golongan Darah</label>
                                <input type="text" name="golongan_darah" id="golongan_darah" placeholder="Golongan Darah"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Hubungan Keluarga</label>
                                <input type="text" name="hub_keluarga" id="hub_keluarga" placeholder="Hubungan Keluarga"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <input type="text" name="agama" id="agama" placeholder="Agama"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <input type="text" name="pendidikan" id="pendidikan" placeholder="Pendidikan"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap Ibu</label>
                                <input type="text" name="nama_lgkp_ibu" id="nama_lgkp_ibu"
                                    placeholder="Nama Lengkap Ibu" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap Ayah</label>
                                <input type="text" name="nama_lgkp_ayah" id="nama_lgkp_ayah"
                                    placeholder="Nama Lengkap Ayah" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>alamat</label>
                                <input type="text" name="alamat" id="alamat" placeholder="alamat"
                                    class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <hr>
                                <a href="{{ route('masterdata.penduduk.home') }}" class="btn btn-danger"
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
