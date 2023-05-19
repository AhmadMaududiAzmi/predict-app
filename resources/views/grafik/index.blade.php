@extends('layouts.app')

@section('')
@endsection

@section('')
@endsection

@section('content')
<div class="row g-4">
  <div class="col-12">
    <div class="card mb-0 h-100 overflow-hidden" id="predictContainer">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0"> Grafik Harga Bawang Merah </h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
          <span class="btn-icon-label">
            <i data-feather="filter" class="me-2"></i>
            <span>Prediksi</span>
            {{-- <span>Prediksi{{ $predict }}</span> --}}
          </span>
        </button>
      </div>
      <div class="card-body p-0">
        <div class="panel">
          {{-- <div class="overlay text-center">
            <div class="overlay-loading">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
            </div>
            <span class="d-inline-block">Sedang memuat grafik</span>
          </div> --}}
          <div id="grafik">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="legend">
          <div class="legend__item legend__item--perencanaan">
            <span class="legend__title"> Perencanaan </span>
          </div>
          <div class="legend__item legend__item--potensi">
            <span class="legend__title"> Potensi </span>
          </div>
          <div class="legend__item legend__item--dibangun">
            <span class="legend__title"> Sudah Dibangun </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card mb-0">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0"> Daftar Komoditas </h5>
        <div class="btn-group">
          <button type="button" class="btn btn-light-info btn-icon dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i data-feather="external-link" class="d-inline-block d-sm-none"></i>
            <span class="d-none d-sm-inline-block">Download</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" id="excel"> <i data-feather="file-text" class="me-2"></i>Excel</a></li>
            <li><a class="dropdown-item" id="pdf"> <i data-feather="file-text" class="me-2"></i>CSV</a></li>
          </ul>
        </div>
      </div>
      <div class="card-body">
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
                <th>Kategori</th>
                <th>Nama Komoditas</th>
                <th>Tahun</th>
                <th>Harga</th>
                <th>Persentase</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="delete" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateComodityLabel">Prediksi Harga Komoditas</h5>
        <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close" title="Tutup">
          <i data-feather="x"></i>
        </button>
      </div>
      <form action="{{ route('grafik.create') }}" class="modal-body row g-3 requires-validation" method="POST" enctype="multipart/form-data"
        novalidate>
        {{-- @csrf --}}
        <div class="col-12">
          <label for="komoditas" class="form-label">Komoditas</label>
          <select name="komoditas-id" id="komoditas-option" class="form-control">
            @foreach ($comodities as $item)
                <option value="{{ $item->id }}">{{ $item->nama_komoditas }}</option>
            @endforeach
          </select>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('lib-script')
{{-- <script src="/js/highstock.js"></script> --}}
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