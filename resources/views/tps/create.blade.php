@extends('layouts.app')

@section('content')

<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">
            Tambah Data TPS
        </h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('tps.store') }}" method="POST" id="tpsForm" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                 <label class="form-label required">Kabupaten/Kota</label>
                                 <select class="form-control form-select @error('regency_id') is-invalid @enderror" name="regency_id" id="regency">
                                     <option value="">Pilih Kabupaten / Kota</option>
                                     @foreach ($regencies as $regency)
                                     <option value="{{ $regency->id }}" {{ old('regency_id') == $regency->id ? 'selected' : '' }}>{{ $regency->name }}</option>
                                     @endforeach
                                 </select>
                                 @error('regency_id')
                                 <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                 <label class="form-label required">Kecamatan</label>
                                 <select class="form-control form-select @error('district_id') is-invalid @enderror" name="district_id" id="district">
                                     <option value="">Pilih Kabupaten</option>
                                 </select>
                                 @error('district_id')
                                 <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                 <label class="form-label required">Desa/Kelurahan</label>
                                 <select class="form-control form-select @error('subdistrict_id') is-invalid @enderror" name="subdistrict_id" id="subdistrict">
                                     <option value="">Pilih Desa/Kelurahan</option>
                                 </select>
                                 @error('subdistrict_id')
                                 <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                            </div>
                        </div>                        
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label required">Nama Petugas</label>
                                <input type="text" class="form-control" placeholder="Nama Petugas" name="officer" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="mb-3">
                                <label class="form-label required">No TPS</label>
                                <input type="number" class="form-control" placeholder="No TPS" name="tps" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="mb-3">
                                <label class="form-label required">Jumlah Pemilih MR</label>
                                <input type="number" class="form-control" placeholder="Jumlah Pemilih" name="total_voters" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label required">Jumlah Pemilih Golkar</label>
                                <input type="number" class="form-control" placeholder="Junlah Pemilih Golkar" name="golkars" required>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Foto Petugas</label>
                                <input type="file" class="form-control @error('proof') is-invalid @enderror" name="proof">
                                @error('proof')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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

    $(document).ready(function() {
        $('#regency').on('change', function() {
            var idRegency = this.value;
            console.log(idRegency);
            $("#district").html('');
            $.ajax({
                url: '/district/' + idRegency
                , type: "GET"
                , data: {}
                , dataType: 'json'
                , success: function(result) {
                    if (result) {
                        $('#district').empty();
                        $('#district').append('<option hidden>Pilih Kecamatan</option>');
                        $.each(result, function(key, value) {
                            $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#district').val("{{ old('district_id') }}").trigger('change');
                    } else {
                        $('#district').empty();
                    }
                }
            });
        });
        $('#district').on('change', function() {
            var idRegency = this.value;
            console.log(idRegency);
            $("#subdistrict").html('');
            $.ajax({
                url: '/subdistrict/' + idRegency
                , type: "GET"
                , data: {}
                , dataType: 'json'
                , success: function(res) {
                    if (res) {
                        $('#subdistrict').empty();
                        $('#subdistrict').append('<option hidden>Pilih Kecamatan</option>');
                        $.each(res, function(key, val) {
                            $('select[name="subdistrict_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                        $('#subdistrict').val("{{ old('subdistrict_id') }}").trigger('change');
                    } else {
                        $('#subdistrict').empty();
                    }
                }
            });
        });
        if ("{{ old('regency_id')}}") {
            console.log("{{ old('regency_id')}}");
            $('#regency').trigger('change');
        }
    });

</script>
@endsection



