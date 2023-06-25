@extends('layouts.app')

@section('content')

@php
$cities = ['Kab. Kendal', 'Kota Semarang', 'Kab. Semarang', 'Kota Salatiga'];
$subdistricts = [
'Banyumanik',
'Candisari',
'Gajahmungkur',
'Gayamsari',
'Genuk',
'Gunungpati',
'Mijen',
'Ngaliyan',
'Pedurungan',
'Semarang Barat',
'Semarang Selatan',
'Semarang Tengah',
'Semarang Timur',
'Semarang Utara',
'Tembalang',
'Tugu',
];
$urbanvillages = [
'Bendan Duwur',
'Bendan Ngisor',
'Bongsari',
'Bubakan',
'Candirenggo',
'Gemah',
'Gisik',
'Gundih',
'Jatingaleh',
'Karangayu',
'Karangrejo',
'Karangtempel',
'Kebon Agung',
'Kemijen',
'Mangkang',
'Mlatiharjo',
'Ngemplaksragen',
'Plalangan',
'Rejosari',
'Semarang Barat',
'Semarang Selatan',
'Semarang Tengah',
'Semarang Timur',
'Semarang Utara',
'Sudirejan',
'Sukorejo',
'Tambakaji',
'Tanjungmas',
'Tawangsari',
'Tlogosari',
'Wonosari',
];
@endphp

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <h2 class="page-title">
            Form Monitoring TPS
        </h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
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

    </div>
</div>
@endsection

