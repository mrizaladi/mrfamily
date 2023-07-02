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
            Tambah Data Simpatisan
        </h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <form class="card" id="myForm">
            <div class="card-body">
                <div class="row row-cards">
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-3">
                            <label class="form-label required">NIK</label>
                            <input type="text" name="nik" class="form-control" placeholder="Masukan NIK">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-3">
                            <label class="form-label required">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Lengkap">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input type="tel" class="form-control" placeholder="Masukan Nomor HP">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="form-selectgroup">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="icons" value="home" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-man" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 16v5"></path>
                                            <path d="M14 16v5"></path>
                                            <path d="M9 9h6l-1 7h-4z"></path>
                                            <path d="M5 11c1.333 -1.333 2.667 -2 4 -2"></path>
                                            <path d="M19 11c-1.333 -1.333 -2.667 -2 -4 -2"></path>
                                            <path d="M12 4m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        </svg>
                                        Laki - Laki</span>
                                </label>
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="icons" value="user" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-woman" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 16v5"></path>
                                            <path d="M14 16v5"></path>
                                            <path d="M8 16h8l-2 -7h-4z"></path>
                                            <path d="M5 11c1.667 -1.333 3.333 -2 5 -2"></path>
                                            <path d="M19 11c-1.667 -1.333 -3.333 -2 -5 -2"></path>
                                            <path d="M12 4m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        </svg>
                                        Perempuan</span>
                                </label>
                            </div>
                        </div>
                    </div>
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
                                <option value="">Pilih Kelurahan</option>
                                @foreach ($urbanvillages as $village)
                                <option value="">{{ $village }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-3">
                            <label class="form-label">KTP</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <div class="d-flex">
                    <button onclick="resetForm()" class="btn btn-link">Clear</button>
                    <a href="{{ route('simpatisan.store') }}" class="btn btn-green btn-pill ms-auto">
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

@section('custom_scripts')
<script>
    function resetForm() {
        document.getElementById("myForm").reset();
    }

</script>
@endsection