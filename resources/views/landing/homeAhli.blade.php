@extends('layouts.master')

@section('title', 'Dashboard')


@section('css')
    <style>
        #mapCanvas {
            width: 100%;
            height: 600px;

        }
    </style>
@endsection


@section('content')
    <div class="col-sm-6">
        <h3 class="m-0">Dashboard</h3>
    </div>
    <div class="container-fluid">

        <div class="row mt-2">
            <div class="col-sm-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ count($registrasiAll) }}</h3>
                        <p>Penugasan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <a class="small-box-footer">Total Pengajuan</a>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $registrasiBlm }}</h3>
                        <p>Belum Diperiksa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <a class="small-box-footer">Registrasi Belum Diperiksa TPA</a>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $registrasiRevisi }}</h3>
                        <p>Revisi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <a class="small-box-footer">Registrasi Direvisi TPA</a>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $registrasiSetuju }}</h3>
                        <p>Disetujui</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <a class="small-box-footer">Registrasi Sudah Disetujui</a>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-7">
                <div class="card card-widget" style="min-height:500px; max-height:500px; overflow-y: scroll;">
                    <div class="card-header">
                        <div class="user-block">
                            <img class="img-circle img-sm" src="{{ asset('assets/images/bangunan.jpg') }}" alt="User Image">
                            <span class="username"><a href="#" style="font-size:15px;"> </i>Registrasi</a></span>
                            <span class="description">{{ Carbon\Carbon::now()->subDays(30)->format('d-m-Y') }}</span>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i
                                    class="fas fa-minus"></i>
                        </div>
                    </div>
                    <div class="card-footer card-comments p-1">
                        <table id="table" class="table table-sm" tyle="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="30" class="text-center">No</th>
                                    <th>Kode Registrasi</th>
                                    <th>Nama Pemohon</th>
                                    <th>Status</th>
                                    {{-- <th>Notulen</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataRegistrasi as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item['kode_registrasi'] }}</td>
                                        <td>{{ $item['pemohon'] }}</td>
                                        <td>{!! $item['status'] !!}</td>
                                        {{-- <td>
                  <a  href="{{url("pengajuan/registrasi/detailbyahli"."/".$item['id_registrasi'].'/'.$id_ahli)}}" class="btn btn-xs btn-info detail"><i class="fa fa-info-circle"></i> Detail</a>
                </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card card-widget" style="min-height:300px; max-height:500px; overflow-y: scroll;">
                    <div class="card-header">
                        <div class="user-block">
                            <img class="img-circle img-sm" src="{{ asset('assets/images/bell.png') }}" alt="User Image">
                            <span class="username"><a href="#" style="font-size:15px;"> </i>Aktifitas
                                    Terbaru</a></span>
                            <span class="description">{{ Carbon\Carbon::now()->subDays(30)->format('d-m-Y') }} - hari
                                ini</span>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i
                                    class="fas fa-minus"></i>
                        </div>
                    </div>
                    @foreach ($History as $not)
                        <div class="card-footer  card-comments" style="padding-bottom: 0px;">
                            <div class="card-comment">
                                <img class="img-circle img-sm" src="{{ asset('assets/images/admin.png') }}"
                                    alt="User Image">
                                <div class="comment-text">
                                    <span class="username">
                                        Admin
                                        <span
                                            class="text-muted float-right">{{ Carbon\Carbon::parse($not->created_at)->format('d/m/Y h:i') }}</span>
                                    </span>
                                    Memperbaharui
                                    <a href="{{ $not->link_baru }}" target="_blank">
                                        dokumen {{ $not->dokumen->jenisdokumen->jenis_dokumen }}
                                    </a>
                                    pada registrasi
                                    <b>{{ $not->registrasi->kode_registrasi }} -
                                        {{ $not->registrasi->bangunangedung->pemilik->nama_pemilik }}</b>


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


    </div>

@endsection

@section('js')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaKTz4vDvqa_ysXd2Fe60H0-qrlzF1900&callback=initMap"></script>
    <script type="text/javascript"></script>
@endsection
