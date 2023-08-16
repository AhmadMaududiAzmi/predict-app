@extends('layouts.app')

@section('lib-style')
@endsection

@section('page-style')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
<div class="row g-4">
  <div class="col-12">
    <div class="card mb-0 h-100 overflow-hidden" id="predictContainer">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0"> Grafik Harga Komoditas {{$comoditiesSelectedValue}} di {{$pasarSelectedValue}} {{$request->tanggal_start}} sampai {{$request->tanggal_end}}</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#predictModal">
          <span class="btn-icon-label">
            <i data-feather="filter" class="me-2"></i>
            <span>Prediksi</span>
          </span>
        </button>
      </div>
      <div class="card-body p-0">
        <div class="panel col-md-12">
         <img src="{{$data['filename']}}">
        </div>
      </div>
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0"> Grafik Harga Komoditas {{$comoditiesSelectedValue}} di {{$pasarSelectedValue}} {{$request->tanggal_start}} sampai {{$request->tanggal_end}}</h5>
        <button class="btn btn-success">
          <span class="btn-icon-label">
            <span>Next Predict</span>
            <i data-feather="arrow-right" class="me-2"></i>
          </span>
        </button>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card mb-0">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0"> Daftar Prediksi Harga Komoditas </h5>
        <div class="btn-group">
          <button type="button" class="btn btn-info btn-icon dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i data-feather="download" class="me-2"></i>
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
          <table class="table table-striped" id="comoditiesTable">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nama Komoditas</th>
                <th>Nama Pasar</th>
                <th>Harga</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                {{-- @foreach ($data as $key=>$item)
                <td>{{ $key+1 }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->nm_komoditas }}</td>
                <td>{{ $item->nm_pasar }}</td>
                <td>0</td>
                @endforeach --}}
              </tr>
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
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateComodityLabel">Prediksi Harga Komoditas</h5>
      </div>
      <form action="{{url('grafik')}}" class="modal-body row g-3 requires-validation">
        <div class="col-12">
          <label for="komoditas" class="form-label">Komoditas</label>
          <select name="komoditas" id="komoditas_option" class="form-control" required>
            <option value="">- Pilih -</option>
            @foreach ($comodities as $item)
            <option value="{{ $item->id }}" {{$request->komoditas == $item->id ? 'selected':''}}>
              {{ $item->nama_komoditas }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="col-12">
          <label for="pasar" class="form-label">Pasar</label>
          <select name="pasar" id="pasar_option" class="form-control" required>
            <option value="">- Pilih -</option>
            @foreach ($markets as $item)
            <option value="{{ $item->id }}" {{$request->pasar == $item->id ? 'selected':''}}>
              {{ $item->nm_pasar }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="col-12">
          <label for="tanggalAwal" class="form-label">Tanggal Awal</label>
          <input type="date" required min="2016-01-01" max="2020-12-31" name="tanggal_start" class="form-control" 
                 value="{{$request->tanggal_start}}">
        </div>
        <div class="col-12">
          <label for="tanggalAkhir" class="form-label">Tanggal Akhir</label>
          <input type="date" required min="2016-01-01" max="2020-12-31" name="tanggal_end" class="form-control" 
                 value="{{$request->tanggal_end}}">
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

@section('page-script')
{{-- Grafik --}}
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

{{-- Modal --}}
<script>
  // Datepicker
  $(document).ready(function() {
      $('#datepickerStart').datepicker({
          dateFormat: 'dd-mm-yy'
      });
  });

  $(document).ready(function() {
      $('#datepickerEnd').datepicker({
          dateFormat: 'dd-mm-yy'
      });
    });
</script>
@endsection