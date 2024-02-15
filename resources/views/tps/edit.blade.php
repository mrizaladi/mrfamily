@extends('layouts.app')

@section('content')

<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">
            Update Data TPS
        </h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('tps.update', $tp->id) }}" method="POST" id="tpsForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="regency_id" class="form-label required">Kabupaten/Kota</label>
                                <select class="form-control form-select @error('regency_id') is-invalid @enderror" id="regency_id" name="regency_id">
                                    <option value="">Pilih Kabupaten / Kota</option>
                                    @foreach ($regencies as $regency)
                                    <option value="{{ $regency->id }}" {{ $tp->regency_id === $regency->id ? 'selected' : '' }}>{{ $regency->name }}</option>
                                    @endforeach
                                </select>
                                @error('regency_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="district_id" class="form-label required">Kecamatan</label>
                                <select class="form-control form-select @error('district_id') is-invalid @enderror" id="district_id" name="district_id">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($districts as $district)
                                    <option value="{{ $district->id }}" {{ $tp->district_id === $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                                @error('district_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="subdistrict_id" class="form-label required">Kelurahan</label>
                                <select class="form-control form-select @error('subdistrict_id') is-invalid @enderror" id="subdistrict_id" name="subdistrict_id">
                                    <option value="">Pilih Kelurahan</option>
                                    @foreach ($subdistricts as $subdistrict)
                                    <option value="{{ $subdistrict->id }}" {{ $tp->subdistrict_id === $subdistrict->id ? 'selected' : '' }}>{{ $subdistrict->name }}</option>
                                    @endforeach
                                </select>
                                @error('subdistrict_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="officer" class="form-label required">Nama Petugas</label>
                                <input type="text" class="form-control @error('officer') is-invalid @enderror" id="officer" placeholder="Nama Petugas" name="officer" value="{{ $tp->officer }}">
                                @error('officer')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="tps" class="form-label required">No TPS</label>
                                <input type="number" class="form-control @error('tps') is-invalid @enderror" id="tps" placeholder="No TPS" name="tps" value="{{ $tp->tps }}">
                                @error('tps')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="total_voters" class="form-label required">Jumlah Pemilih MR</label>
                                <input type="number" class="form-control @error('total_voters') is-invalid @enderror" id="total_voters" placeholder="Jumlah Pemilih MR" name="total_voters" value="{{ $tp->total_voters }}">
                                @error('total_voters')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="golkars" class="form-label required">Jumlah Pemilih Golkar</label>
                                <input type="number" class="form-control @error('golkars') is-invalid @enderror" id="golkars" placeholder="Jumlah Pemilih Golkar" name="golkars" value="{{ $tp->golkars }}">
                                @error('golkars')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3">
                            <div class="form-group">
                                <label for="proof" class="form-label required">Foto Petugas</label>
                                <input type="file" class="form-control @error('proof') is-invalid @enderror" id="proof" name="proof">
                                @error('proof')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if($tp->proof)
                                <img src="{{ asset('proof/' . $tp->proof) }}" alt="Foto Petugas" class="img-fluid mt-2" style="max-width: 100%;">
                                @endif
                            </div>
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
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('custom_scripts')
<script>
    function resetForm() {
        document.getElementById("tpsForm").reset();
    }

</script>
@endsection

