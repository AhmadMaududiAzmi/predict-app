@extends('layouts.app')

@section('lib-style')
@endsection

@section('page-style')
@endsection

@section('content')
{{-- Table --}}
<div class="card">
    <div class="card-header d-flex justify-content-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            <span class="btn-icon-label">
                <i data-feather="plus" class="me-sm-2"></i>
                <span class="d-none d-sm-inline-block"> Tambah </span>
            </span>
        </button>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="tabelKomoditas">
            <thead>
                <tr>
                    <th class="col-number">No.</th>
                    <th> Kategori </th>
                    <th> Nama Komoditas </th>
                    <th> Satuan </th>
                    <th class="col-actions" data-orderable="false"> Aksi </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comodities as $item)
                <tr>
                    <td class="col-number">
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->kategori }}
                    </td>
                    <td>
                        {{ $item->nama_komoditas }}
                    </td>
                    <td>
                        {{ $item->satuan }}
                    </td>
                    <td class="col-actions">
                        <a title="Perbarui" class="btn-table-action update me-2" data-bs-toggle="modal"
                            data-bs-target="#update-modal" data-bs-act="{{ route('listkomoditas.update', $item->id) }}"
                            data-bs-kategori="{{ $item->kategori }}"
                            data-bs-nama_komoditas="{{ $item->nama_komoditas }}" data-bs-satuan="{{ $item->satuan }}"><i
                                data-feather="refresh-cw"></i></a>
                        <a title="Hapus" class="btn-table-action delete" data-bs-toggle="modal"
                            data-bs-target="#delete-modal" data-bs-id="{{ $item->id }}"
                            data-bs-act="{{ route('listkomoditas.destroy', $item->id) }}"
                            data-bs-kategori="{{ $item->kategori }}"><i data-feather="trash-2"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateKomoditas">Tambah Komoditas</h5>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close" title="Tutup">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form class="modal-body row g-3 requires-validation" action="" method="post" enctype="multipart/form-data"
                novalidate>
                {{-- @csrf --}}
                <div class="col-12">
                    <label for="name" class="form-label"> Kategori </label>
                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori"
                        required>
                    <div class="invalid-feedback">
                        Harus diisi!
                    </div>
                </div>
                <div class="col-12">
                    <label for="name" class="form-label"> Nama Komoditas </label>
                    <input type="text" class="form-control" id="komoditas" name="komoditas" placeholder="Nama Komoditas"
                        required>
                    <div class="invalid-feedback">
                        Harus diisi!
                    </div>
                </div>
                <div class="col-12">
                    <label for="name" class="form-label"> Satuan </label>
                    <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan" required>
                    <div class="invalid-feedback">
                        Harus diisi!
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
                            <span> Simpan </span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="update-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateKomoditas">Perbarui Komoditas</h5>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close" title="Tutup">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form class="modal-body row g-3" id="update-form" action="/" method="post">
                {{-- @csrf --}}
                {{-- @method('PUT') --}}
                <div class="col-12">
                    <label for="updateKategori" class="form-label"> Kategori </label>
                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori"
                        required>
                    <div class="invalid-feedback">
                        Harus diisi!
                    </div>
                </div>
                <div class="col-12">
                    <label for="updateKomoditas" class="form-label"> Nama Komoditas </label>
                    <input type="text" class="form-control" id="komoditas" name="komoditas" placeholder="Nama Komoditas"
                        required>
                    <div class="invalid-feedback">
                        Harus diisi!
                    </div>
                </div>
                <div class="col-12">
                    <label for="updateSatuan" class="form-label"> Satuan </label>
                    <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan" required>
                    <div class="invalid-feedback">
                        Harus diisi!
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
                            <span> Simpan </span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete">Konfirmasi</h5>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form class="modal-body" id="delete-form" action="/" method="post">
                @csrf
                @method('DELETE')
                <p class="text-center">
                    Anda yakin ingin menghapus <strong id="del-name" class="text-danger"></strong>?
                </p>
                <div class="alert alert-danger alert-icon alert-dashed text-dark">
                    <i data-feather="alert-circle" class="text-danger"></i>
                    <span>
                        <strong class="text-danger">Perhatian!</strong> Data akan terhapus dan tidak dapat dikembalikan.
                    </span>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">
                        <span class="btn-icon-label">
                            <i data-feather="x" class="me-2"></i>
                            <span> Batal </span>
                        </span>
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <span class="btn-icon-label">
                            <i data-feather="trash-2" class="me-2"></i>
                            <span> Hapus </span>
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
@endsection