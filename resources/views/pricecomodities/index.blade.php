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
                <span class="d-none d-sm-inline-block"> Upload Data </span>
            </span>
        </button>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="tabelKomoditas">
            <thead>
                <tr>
                    <th class="col-number">No.</th>
                    <th> Tanggal </th>
                    <th> Nama Pasar </th>
                    <th> Nama Komoditas </th>
                    <th> Harga </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comodities as $item)
                <tr>
                    <td class="col-number">
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->tanggal }}
                    </td>
                    <td>
                        {{ $item->nm_pasar }}
                    </td>
                    <td>
                        {{ $item->nm_komoditas }}
                    </td>
                    <td>
                        {{ $item->harga_current }}
                    </td>
                    {{-- <td class="col-actions">
                        <a title="Perbarui" class="btn-table-action update me-2" data-bs-toggle="modal"
                            data-bs-target="#update-modal" data-bs-act="{{ route('pricecomodities.update', $item->id) }}"
                            data-bs-tanggal="{{ $item->tanggal }}" data-bs-nm_pasar="{{ $item->nm_pasar }}"
                            data-bs-nm_komoditas="{{ $item->nm_komoditas }}"
                            data-bs-harga_current="{{ $item->harga_current }}"><i data-feather="refresh-cw"></i></a>
                        <a title="Hapus" class="btn-table-action delete" data-bs-toggle="modal"
                            data-bs-target="#delete-modal" data-bs-id="{{ $hp->id }}"
                            data-bs-act="{{ route('pricecomodities.destroy', $item->id) }}" data-bs-nm_komoditas="{{ $item->nm_komoditas }}"><i
                                data-feather="trash-2"></i></a>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $comodities->links() }}
    </div>
</div>
@endsection

@section('lib-script')
@endsection

@section('page-script')
<section>
    
</section>
@endsection