@extends('layouts.app')

@section('content')
<style>
    .non-interactive {
    pointer-events: none;
    background-color: rgb(236, 236, 236);
}
</style>
<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">
            Update Data Simpatisan
        </h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('simpatisan.update', $sim->id) }}" id="simpatisanForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label required">Kabupaten/Kota</label>
                                <select class="form-control form-select non-interactive" name="regency_id" required>
                                    <option value="">Pilih Kabupaten / Kota</option>
                                    @foreach ($regencies as $regency)
                                    <option value="{{ $regency->id }}" {{ $sim->regency_id === $regency->id ? 'selected' : '' }}>{{ $regency->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label required">Kecamatan</label>
                                <select class="form-control form-select non-interactive" name="district_id" required>
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($districts as $district)
                                    <option value="{{ $district->id }}" {{ $sim->district_id === $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label required">Desa/Kelurahan</label>
                                <select class="form-control form-select non-interactive" name="subdistrict_id" required>
                                    <option value="">Pilih Desa/Kelurahan</option>
                                    @foreach ($subdistricts as $subdistrict)
                                    <option value="{{ $subdistrict->id }}" {{ $sim->subdistrict_id === $subdistrict->id ? 'selected' : '' }}>{{ $subdistrict->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label required">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control non-interactive @error('name') is-invalid @enderror" placeholder="Masukan Nama Lengkap" value="{{ $sim->name }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label required">Jenis Kelamin</label>
                                <div class="form-selectgroup">
                                    <label class="form-selectgroup-item non-interactive">
                                        <input type="radio" name="sex" value="L" class="form-selectgroup-input" {{ $sim->sex === 'L' ? 'checked' : '' }}>
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
                                    <label class="form-selectgroup-item non-interactive">
                                        <input type="radio" name="sex" value="P" class="form-selectgroup-input" {{ $sim->sex === 'P' ? 'checked' : '' }}>
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
                                <label class="form-label required">NIK</label>
                                <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukan NIK" value="{{ $sim->nik }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Nomor HP</label>
                                <input type="number" class="form-control" placeholder="Masukan Nomor HP" name="phone" value="{{ $sim->phone }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label required">KTP</label>
                                <input type="file" class="form-control @error('ktp') is-invalid @enderror" name="ktp">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <div class="d-flex">
                        <button type="button" onclick="resetForm()" class="btn btn-link">Clear</button>
                        <button type="submit" class="btn btn-green btn-pill ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                            </svg>
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('custom_scripts')
<script>
    function resetForm() {
        document.getElementById("simpatisanForm").reset();
    }

</script>
@endsection

