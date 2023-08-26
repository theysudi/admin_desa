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


@endsection

@section('js')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaKTz4vDvqa_ysXd2Fe60H0-qrlzF1900&callback=initMap"></script>
    <script type="text/javascript"></script>
@endsection
