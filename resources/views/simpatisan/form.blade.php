@extends('layouts.app')

@section('content')
<style>
.non-interactive {
    pointer-events: none;
    background-color: rgb(212, 212, 212);
    padding: 5px 0px;
    border-radius: 7px;
}
.select2-container .select2-selection--single {height: 35px !important;}
.select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 35px !important;}
.select2-container--default .select2-selection--single .select2-selection__arrow {height: 32px !important;}
.select2-container--default .select2-selection--single .select2-selection__clear {height: 30px !important;}
</style>
<div class="mt-4">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <form action="{{ route('handleselect')}}" method="GET">
                    @csrf
                    <div class="card-header">{{ __('Cari Data Simpatisan') }}</div>
                    <div class="card-body">
                        <div class="mb-3 p-1" id="c_regency">
                            <label for="regency" class="fw-bold label">Kabupaten/Kota</label>
                            <select name="regency" id="regency" class="form-control" required>
                                <option value="">--- Pilih Kabupaten/Kota ---</option>
                                @foreach ($regency as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 p-1" id="c_district">
                            <label for="district" class="fw-bold label">Kecamatan</label>
                            <select name="district" id="district" class="form-control" required>
                            </select>
                        </div>
                        <div class="mb-3 p-1" id="c_subdistrict">
                            <label for="subdistrict" class="fw-bold label">Desa/Kelurahan</label>
                            <select name="subdistrict" id="subdistrict" class="form-control" required>
                            </select>
                        </div>
                        <div class="mb-3 p-1" id="c_simpatisan">
                            <label for="simpatisan" class="fw-bold label">Nama Simpatisan</label>
                            <select name="dpt" id="simpatisan" class="form-control" required>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="cetak" class="btn btn-primary btn-block">Proses</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('select2/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('select2/select2-bootstrap.css') }}" />
@endpush
@push('scripts')
    <script src="{{ asset('select2/select2.min.js') }}"></script>
    <script>
         $('#regency').select2({
            placeholder: "--- Pilih Kabupaten/Kota ---",
            allowClear: true,
            multiple: false,
         });
        
        $(document).ready(function() {
            $('#regency').on('change', function(){
                $('#district').select2().val('').trigger('change');
                $('#subdistrict').select2().val('').trigger('change');
                $('#simpatisan').select2().val('').trigger('change');
                let regency =  $('#regency').val();
                $('#district').select2({
                    placeholder: "--- Pilih Kecamatan ---",
                    allowClear: true,
                    ajax: {
                        url :  "{{ route('getDistrict') }}",
                        dataType: 'json',
                        delay:1000,
                        data: function(params) {
                            const query = {
                                search: params.term,
                                regency: regency,
                            }
                            return query;
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: `${item.name}`,
                                        id: item.id
                                    }
                                })
                            };
                        },
                    },
                }); 
            });
            $('#district').on('change', function(){
                $('#subdistrict').select2().val('').trigger('change');
                $('#simpatisan').select2().val('').trigger('change');
                let district =  $('#district').val();
                $('#subdistrict').select2({
                    placeholder: "--- Pilih Desa/Kelurahan ---",
                    allowClear: true,
                    ajax: {
                        url :  "{{ route('getSubDistrict') }}",
                        dataType: 'json',
                        delay:1000,
                        data: function(params) {
                            const query = {
                                search: params.term,
                                district: district,
                            }
                            return query;
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: `${item.name}`,
                                        id: item.id
                                    }
                                })
                            };
                        },
                    },
                }); 
            });
            $('#subdistrict').on('change', function(){
                $('#simpatisan').select2().val('').trigger('change');
                let regency =  $('#regency').val();
                let district =  $('#district').val();
                let subdistrict =  $('#subdistrict').val();
                $('#simpatisan').select2({
                    placeholder: "--- Cari Nama Simpatisan ---",
                    allowClear: true,
                    ajax: {
                        url :  "{{ route('getSimpatisan') }}",
                        dataType: 'json',
                        delay:1000,
                        data: function(params) {
                            const query = {
                                search: params.term,
                                regency: regency,
                                district: district,
                                subdistrict: subdistrict,
                            }
                            return query;
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: `${item.name}_RT0${item.rt}/RW0${item.rw}`,
                                        id: item.id
                                    }
                                })
                            };
                        },
                    },
                }); 
            });
            
            if('{{auth()->user()->name}}' != 'superadmin' && '{{auth()->user()->admin}}' == true){
                $('#regency').select2().val('{{ auth()->user()->regency_id }}').trigger('change');
                $('#c_regency').addClass('non-interactive');
            }else if('{{auth()->user()->name}}' != 'superadmin' && '{{auth()->user()->admin}}' == false){
                $('#regency').select2().val('{{ auth()->user()->regency_id }}').trigger('change');
                $('#district').html('<option value="{{ auth()->user()->district_id }}" selected>{{ auth()->user()->district->name }}</option>');
                $('#subdistrict').html('<option value="{{ auth()->user()->subdistrict_id }}" selected>{{ auth()->user()->subdistrict->name }}</option>');
                $('#subdistrict').trigger('change');
                $('#c_regency,#c_district,#c_subdistrict').addClass('non-interactive');
            }
        })
    </script>
@endpush

