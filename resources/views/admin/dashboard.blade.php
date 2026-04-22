@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-stat bg-primary text-white shadow">
            <div class="card-body">
                <h6>Total Barang</h6>
                <h2>{{ $total_barang }}</h2> <small>Unit tersimpan di database</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card card-stat bg-success text-white shadow">
            <div class="card-body">
                <h6>Barang Tersedia</h6>
                <h2>{{ $barang_tersedia }}</h2> <small>Siap untuk dipinjam</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card card-stat bg-danger text-white shadow">
            <div class="card-body">
                <h6>Perlu Perbaikan</h6>
                <h2>{{ $barang_rusak }}</h2> <small>Sedang dalam kondisi rusak</small>
            </div>
        </div>
    </div>
</div>
@endsection