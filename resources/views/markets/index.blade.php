@extends('layouts.app')

@section('lib-style')
@endsection

@section('page-style')
@endsection

@section('content')
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
        <table class="table table-striped" id="tabelPasar">
            <thead>
                <tr>
                    <th class="col-number">No.</th>
                    <th> Nama Pasar </th>
                    <th> Kota/Kabupaten </th>
                    <th class="col-actions" data-orderable="false"> Aksi </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($markets as $item)
                <tr>
                    <td class="col-number">
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->nama_pasar }}
                    </td>
                    <td>
                        {{ $item->kota_kab }}
                    </td>
                    {{-- <td class="col-actions">
                        <a title="Perbarui" class="btn-table-action update me-2" data-bs-toggle="modal"
                            data-bs-target="#update-modal" data-bs-act="{{ route('market.update', $hp->id) }}"
                            data-bs-name="{{ $hp->name }}" data-bs-subdistrict="{{ $hp->psub_district_id }}"
                            data-bs-district="{{ $hp->pdistrict_id }}"
                            data-bs-subvillage="{{ $hp->psub_village_id }}"><i data-feather="refresh-cw"></i></a>
                        <a title="Hapus" class="btn-table-action delete" data-bs-toggle="modal"
                            data-bs-target="#delete-modal" data-bs-id="{{ $hp->id }}"
                            data-bs-act="{{ route('market.destroy', $hp->id) }}" data-bs-name="{{ $hp->name }}"><i
                                data-feather="trash-2"></i></a>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $markets -> links() }} --}}
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatepasar">Tambah Pasar</h5>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close" title="Tutup">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form class="modal-body row g-3 requires-validation" action="{{ route('store') }}" method="post" enctype="multipart/form-data"
                novalidate>
                {{-- @csrf --}}
                <div class="col-12">
                    <label for="pasar" class="form-label"> Pasar </label>
                    <input type="text" class="form-control" id="pasar" name="pasar" placeholder="Nama Pasar" required>
                    <div class="invalid-feedback">
                        Harus diisi!
                    </div>
                </div>
                <div class="col-12">
                    <label for="kota" class="form-label"> Kota/Kabupaten </label>
                    <input type="text" class="form-control" id="kota" name="kota" placeholder="Kota/Kabupaten" required>
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
                <h5 class="modal-title" id="updatePasar">Perbarui Pasar</h5>
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close" title="Tutup">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form class="modal-body row g-3" id="update-form" action="/" method="post">
                {{-- @csrf --}}
                {{-- @method('PUT') --}}
                <div class="col-12">
                    <label for="pasar" class="form-label"> Pasar </label>
                    <input type="text" class="form-control" id="pasar" name="pasar" placeholder="Nama Pasar" required>
                    <div class="invalid-feedback">
                        Harus diisi!
                    </div>
                </div>
                <div class="col-12">
                    <label for="kota" class="form-label"> Kota/Kabupaten </label>
                    <input type="text" class="form-control" id="kota" name="kota" placeholder="Kota/Kabupaten" required>
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
                {{-- @csrf
                @method('DELETE') --}}
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
<script>
    $(function() {
            $('#tabelPasar').DataTable({
                "language": {
                    "url": "{{ asset('json/datatables.indonesian.json') }}"
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive mb-2'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
            });

            $('#delete-modal')
                .bind('show.bs.modal', evt => {
                    const delBtn = $(evt.relatedTarget);
                    const delForm = $('form#delete-form');
                    delForm.attr('action', delBtn.attr('data-bs-act'));
                    delForm.find('#del-name').text('"' + delBtn.attr('data-bs-name') + '"')
                })

            $('#update-modal')
                .bind('show.bs.modal', evt => {
                    const updateForm = $('form#update-form')
                    const updateBtn = $(evt.relatedTarget)
                    updateForm.attr('action', updateBtn.attr('data-bs-act'))
                    updateForm.find('#name').val(updateBtn.attr('data-bs-name'))
                    updateForm.find('#kecamatan').val(updateBtn.attr('data-bs-district')).attr(
                        'selected', 'selected')
                    updateForm.find('#p_desa').val(updateBtn.attr('data-bs-subvillage')).attr(
                        'selected', 'selected')
                    updateForm.find('#dusun').val(updateBtn.attr('data-bs-subdistrict')).attr(
                        'selected', 'selected')
                })
                .bind('hide.bs.modal', e => {
                    const updateForm = $('form#update-form');
                    updateForm.attr('action', '/');
                    updateForm[0].reset();
                });
        });
</script>
@endsection