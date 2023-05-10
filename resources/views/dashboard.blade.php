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
            <div class="panel py-3">
                <div id="grafikPasar">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-body">
            <h5 class="card-title">Rata-Rata Harga Komoditas Cabai Rawit tiap Pasar</h5>
            <div class="panel py-3">
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
</div>

@endsection

@section('lib-script')
{{-- <script src="/js/highcharts.js"></script> --}}
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
@endsection

@section('page-script')
<script>
    Highcharts.chart('grafikPasar', {
    chart: {
        type: 'column'
    },
    // title: {
    //     text: 'Monthly Average Rainfall'
    // },
    // subtitle: {
    //     text: 'Source: WorldClimate.com'
    // },
    xAxis: {
        categories: [
            '2016',
            '2017',
            '2018',
            '2019',
            '2020'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Harga (Rp)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Tokyo',
        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4,
            194.1, 95.6, 54.4]

    }, {
        name: 'New York',
        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5,
            106.6, 92.3]

    }, {
        name: 'London',
        data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3,
            51.2]

    }, {
        name: 'Berlin',
        data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8,
            51.1]

    }]
});
</script>
@endsection