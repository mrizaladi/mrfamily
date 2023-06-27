@extends('layouts.app')


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


@section('content')

<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">
            Edit Data TPS
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
                                <option selected>Kab. Kendal</option>
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
                                <option selected>Kaliwungu</option>
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
                                <option value="">Pilih Kelurahan</option>
                                <option value="" selected>Kutoharjo</option>
                                @foreach ($urbanvillages as $village)
                                <option value="">{{ $village }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Desa</label>
                            <input type="text" class="form-control" placeholder="Desa" value="Kedungsari">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Nama Petugas</label>
                            <input type="text" class="form-control" placeholder="Nama Petugas" value="Baihaqi">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">No TPS</label>
                            <input type="number" class="form-control" placeholder="No TPS" value="001">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Pemilih</label>
                            <input type="number" class="form-control" placeholder="No TPS" value="1022313">
                        </div>
                    </div>


                    <div class="col-sm-4 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Foto Petugas</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <div class="d-flex">
                    <a href="#" class="btn btn-link">Clear</a>
                    <a href="{{ route('tps.update') }}" class="btn btn-green btn-pill ms-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M14 4l0 4l-6 0l0 -4"></path>
                        </svg>
                        Simpan</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

