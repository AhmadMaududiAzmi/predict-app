@extends('layouts.app')

@section('lib-style')
@endsection

@section('page-style')
@endsection

@section('content')
<div class="row g-4 mb-5">
    {{-- Informasi Seputar Komoditas --}}
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 mb-0">
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title"> Comoditites Amount </h5>
                <h1 class="fw-bold text-primary mb-0"> {{ $com_amount }} </h1>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 mb-0">
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title"> Markets Amount </h5>
                <h1 class="fw-bold text-primary mb-0"> {{ $markets }} </h1>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 mb-0">
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title"> Day's Prediction </h5>
                <h1 class="fw-bold text-primary mb-0"> {{ $day_prediction }} </h1>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 mb-0">
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title"> Accuracy Rate </h5>
                <h1 class="fw-bold text-primary mb-0"> {{ $accuracy }} </h1>
            </div>
        </div>
    </div>

    {{-- Grafik Komoditas --}}
    <div class="col-lg-6">
        <div class="card-body">
            <h5 class="card-title">Pertumbuhan Harga Komoditas tiap tahun</h5>
            <div class="chart py-3">
                {{-- Pakai JSON dari Grafana untuk plot grafiknya (menggunakan grafik bar)) --}}
                {{-- Dan juga gabungkan dengan model prediksi --}}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-body">
            <h5 class="card-title">Rata-Rata Harga Komoditas Cabai Rawit tiap Pasar</h5>
            <div class="chart py-3">
                {{-- Pakai JSON dari Grafana untuk plot grafiknya (menggunakan grafik pie)) --}}
                {{-- Dan juga gabungkan dengan model prediksi --}}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-body">
            <h5 class="card-title">Rata-Rata Harga Komoditas Cabai Rawit tiap Pasar</h5>
            <div class="chart py-3">
                {{-- Pakai JSON dari Grafana untuk plot grafiknya (menggunakan grafik ...)) --}}
                {{-- Dan juga gabungkan dengan model prediksi --}}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-body">
            <h5 class="card-title">Rata-Rata Harga Komoditas Cabai Rawit tiap Pasar</h5>
            <div class="chart py-3">
                {{-- Pakai JSON dari Grafana untuk plot grafiknya (menggunakan grafik ...)) --}}
                {{-- Dan juga gabungkan dengan model prediksi --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('lib-script')
@endsection

@section('page-script')
@endsection