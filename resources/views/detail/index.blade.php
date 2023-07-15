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
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#selectModal">
          <span class="btn-icon-label">
            <i data-feather="plus" class="me-sm-2"></i>
            <span class="d-none d-sm-inline-block"> Pilih Pasar </span>
          </span>
        </button>
      </div>
      <div class="card-body">
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title"> Harga Tertinggi </h5>
                <h1 class="fw-bold text-primary mb-0">Rp.{{ $maxHarga }}</h1>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title"> Harga Terendah </h5>
                <h1 class="fw-bold text-primary mb-0">Rp.{{ $minHarga }}</h1>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title"> Rata-Rata Harga </h5>
                <h1 class="fw-bold text-primary mb-0"> Rp.{{ $avgHarga }} </h1>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title"> Persentase Fluktuasi </h5>
                <h1 class="fw-bold text-primary mb-0"> 0,43% </h1>
              </div>
            </div>
          </div>
        </div>

        {{-- Detail Grafik --}}
        <div class="col-12">
          <div class="panel">
            <div id="grafik">

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
                @foreach ($comodities as $key=>$item)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $item->tanggal }}</td>
                  <td>{{ $item->nm_pasar }}</td>
                  <td>{{ $item->nm_komoditas }}</td>
                  <td>{{ $item->harga_current }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $comodities->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    {{-- Data Train --}}
    <div class="card mb-0 h-100 overflow-hidden">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title mb-0">Data Train</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#trainData">
          <span class="btn-icon-label">
            <i data-feather="plus" class="me-sm-2"></i>
            <span class="d-none d-sm-inline-block">Latih Data</span>
          </span>
        </button>
      </div>
      <div class="card-body">
        <div class="col-12">
          <div class="col-12">
            <div class="main-table rounded">
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
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Select Modal --}}
<div class="modal fade" id="selectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="delete" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="selectMarkets">Pilih Pasar</h5>
      </div>
      <form class="modal-body row g-3 requires-validation" method="GET" action="{{ route('grafik.store') }}" method="post" enctype="multipart/form-data"
        novalidate>
        {{-- @csrf --}}
        <div class="col-12">
          <label for="kota" class="form-label">Kota / Kabupaten</label>
          <select name="kota" id="kota_option" class="form-control">
            <option value="">- Pilih -</option>
            @foreach ($markets as $item)
            <option value="{{ $item->id }}">{{ $item->kota_kab }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12">
          <label for="pasar" class="form-label">Pasar</label>
          <select name="pasar" id="pasar_option" class="form-control">
            <option value="">- Pilih -</option>
            @foreach ($markets as $item)
            <option value="{{ $item->id }}">{{ $item->nama_pasar }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-center">
          <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">
            <span class="btn-icon-label">
              <i data-feather="x" class="me-2"></i>
              <span> Batal </span>
            </span>
          </button>
          <button type="submit" class="btn btn-success">
            <span class="btn-icon-label">
              <i data-feather="refresh-cw" class="me-2"></i>
              <span> Pilih </span>
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('lib-script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
@endsection

@section('page-script')
<script>
  (async () => {
    // Ambil data yang telah diteruskan dari controller
    const harga = {!! json_encode($harga_current) !!};
    const tanggal = {!! json_encode($tanggal) !!};

  Highcharts.chart("grafik", {
    chart: {
      type: "spline"
    },
    title: {
      text: "Grafik Harga Komoditas"
    },
    xAxis: {
      categories: tanggal
    },
    yAxis: {
      title: {
        text: "Harga Komoditas"
      }
    },
    plotOptions: {
      series: {
        allowPointSelect: true
      }
    },
    rangeSelector: {
      selected: 2
    },
    series: [
      {
        name: "Harga Komoditas",
        data: harga
      }
    ]
  });
})();
</script>
@endsection