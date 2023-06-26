@extends('layouts.app')

@section('content')
<form class="card">
    <div class="card-body">
        <div class="row row-cards">
            <div class="col-sm-6 col-md-3">
                <div class="mb-3">
                    <label class="form-label">Kabupaten/Kota</label>
                    <select class="form-control form-select">
                        <option value="">Pilih Kabupaten / Kota</option>
                        @foreach ($cities as $city)
                        <option value="">{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="mb-3">
                    <label class="form-label">Kecamatan</label>
                    <select class="form-control form-select">
                        <option value="">Pilih Kecamatan</option>
                        @foreach ($subdistricts as $subdis)
                        <option value="">{{ $subdis }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="mb-3">
                    <label class="form-label">Kelurahan</label>
                    <select class="form-control form-select">
                        <option value="">Pilih Desa</option>
                        @foreach ($urbanvillages as $village)
                        <option value="">{{ $village }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="mb-3">
                    <label class="form-label">Desa</label>
                    <input type="text" class="form-control" placeholder="Desa">
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">Nama Petugas</label>
                    <input type="text" class="form-control" placeholder="Nama Petugas">
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">No TPS</label>
                    <input type="number" class="form-control" placeholder="No TPS">
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="mb-3">
                    <label class="form-label">Jumlah Pemilih</label>
                    <input type="number" class="form-control" placeholder="No TPS">
                </div>
            </div>


            <div class="col-sm-6 col-md-6">
                <div class="mb-3">
                    <label class="form-label">Foto Petugas</label>
                    <input type="file" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-yellow">Simpan</button>
    </div>
</form>

@endsection