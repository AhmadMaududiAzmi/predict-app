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
        <h5 class="card-title mb-0"> Grafik Harga Komoditas 
          @if(count($request->all()) > 0)
            {{$comoditiesSelectedValue}} di {{$pasarSelectedValue}} {{$startDate}} sampai {{$endDate}}
          @endif
        </h5>
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
        <h5 class="card-title mb-0"> Grafik Harga Komoditas 
          @if(count($request->all()) > 0)
          {{$comoditiesSelectedValue}} di {{$pasarSelectedValue}} {{$startDate}} sampai {{$endDate}}
          @endif
        </h5>
      </div>
      @if(count($request->all()) > 0)
      <div class="col-md-12 row card-header">
        <form action="{{url('grafik')}}" class="modal-body row g-3 requires-validation">
        <div class="col-md-4" align="right">
          <label>Isi hari next predict</label>
        </div>
        <div class="col-md-6">
          <input type="hidden" name="tanggal_start" value="{{$startDate}}">
          <input type="hidden" name="tanggal_end" value="{{$endDate}}">
          <input type="hidden" name="pasar" value="{{$request->pasar}}">
          <input type="hidden" name="komoditas" value="{{$request->komoditas}}">
          <input type="number" required name="next_predict" class="form-control" placeholder="Contoh : 30">
        </div>
        <div class="col-md-2">
          <button class="btn btn-success" type="submit">
            <span class="btn-icon-label">
              <span>Next Predict</span>
              <i data-feather="arrow-right" class="me-2"></i>
            </span>
          </button>
        </div>
      </form>
      </div>
      @endif
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
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
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
                 value="{{$startDate}}">
        </div>
        <div class="col-12">
          <label for="tanggalAkhir" class="form-label">Tanggal Akhir</label>
          <input type="date" required min="2016-01-01" max="2020-12-31" name="tanggal_end" class="form-control" 
                 value="{{$endDate}}">
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

@endsection