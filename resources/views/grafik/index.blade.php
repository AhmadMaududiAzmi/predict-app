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
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#predictModal">
          <span class="btn-icon-label">
            <i data-feather="filter" class="me-2"></i>
            <span>Prediksi</span>
            {{-- <span>Prediksi{{ $predict }}</span> --}}
          </span>
        </button>
      </div>
      <div class="card-body p-0">
        <div class="panel">
          {{-- <div id="grafik">
          </div> --}}
          <canvas id="myChart"></canvas>
        </div>
      </div>
      {{-- <div class="card-footer">
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
      </div> --}}
    </div>
  </div>
  <div class="col-12">
    <div class="card mb-0">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0"> Daftar Prediksi Harga Komoditas </h5>
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-icon dropdown-toggle" data-bs-toggle="dropdown"
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
                <th>Tanggal</th>
                <th>Kategori</th>
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

{{-- Modal --}}
<div class="modal fade" id="predictModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="delete" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateComodityLabel">Prediksi Harga Komoditas</h5>
        <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close" title="Tutup">
          <i data-feather="x"></i>
        </button>
      </div>
      <form action="" class="modal-body row g-3 requires-validation" method="POST" enctype="multipart/form-data"
        novalidate>
        @csrf
        <div class="col-12">
          <label for="komoditas" class="form-label">Komoditas</label>
          <select name="komoditas" id="komoditas_option" class="form-control">
            <option value="">- Pilih -</option>
            @foreach ($comodities as $item)
            <option value="{{ $item->id }}">{{ $item->nama_komoditas }}</option>
            @endforeach
          </select>
        </div>
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
        <div class="col-12">
          <label for="tanggal" class="form-label">Tanggal</label>

          <div class="col6">
            <select name="tanggalAwal" id="tanggalAwal-option" class="form-control">
              <option value="">- Pilih -</option>
              {{-- @foreach ($comodities as $item)
              <option value="{{ $item->id }}">{{ $item->nama_komoditas }}</option>
              @endforeach --}}
            </select>
          </div>
          <div class="col6">
            <select name="tanggalAkhir" id="tanggalAkhir-option" class="form-control">
              <option value="">- Pilih -</option>
              {{-- @foreach ($comodities as $item)
              <option value="{{ $item->id }}">{{ $item->nama_komoditas }}</option>
              @endforeach --}}
            </select>
          </div>
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
              <span> Prediksi </span>
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('lib-script')
@endsection

@section('page-script')
<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [{
      label: 'Data per bulan',
      data: [19000, 20000, 18500, 17000, 15000, 19000, 19000, 20000, 21000, 20000, 19000, 20000],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>
@endsection