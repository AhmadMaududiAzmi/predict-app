@extends('layouts.app')

@section('lib-style')
@endsection

@section('page-style')
@endsection

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card mb-0 h-100 overflow-hidden">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">Gula Pasir Dalam Negri</h3>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title"> Harga Tertinggi </h5>
                                <h1 class="fw-bold text-primary mb-0"> Rp.40,000 </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title"> Harga Terendah </h5>
                                <h1 class="fw-bold text-primary mb-0"> Rp.30,000 </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title"> Rata-Rata Harga </h5>
                                <h1 class="fw-bold text-primary mb-0"> Rp.34,000 </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title"> Persentase </h5>
                                <h1 class="fw-bold text-primary mb-0"> 0,43% </h1>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Detail Grafik --}}
                <div class="col-12">
                    <div class="panel">
                        <div class="" id="grafik">

                        </div>
                    </div>
                </div>

                {{-- Detail Tabel --}}
                <div class="col-12">
                    <div class="main-table rounded">
                        <div class="overlay" id="overlayTable">
                          <div class="overlay-loading">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                          </div>
                          <span class="d-inline-block text-white">Sedang memuat data</span>
                        </div>
                        <table class="table table-striped" id="comoditiesTable">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>Tanggal</th>
                              <th>Nama Pasar</th>
                              <th>Nama Komoditas</th>
                              <th>Harga</th>
                            </tr>
                          </thead>
                          <tbody>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tbody>
                        </table>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('lib-script')
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
@endsection

@section('page-script')
<script>
    Highcharts.getJSON('https://demo-live-data.highcharts.com/aapl-c.json', function (data) {
  
  // Create the chart
  Highcharts.stockChart('grafik', {
  
    rangeSelector: {
      selected: 1
    },
  
    // title: {
    //   text: 'Grafik Harga Komoditas'
    // },
  
    series: [{
      name: 'AAPL Stock Price',
      data: data,
      type: 'spline',
      tooltip: {
        valueDecimals: 2
      }
    }]
  });
  });
  </script>
@endsection