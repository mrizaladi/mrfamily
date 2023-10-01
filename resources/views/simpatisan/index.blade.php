@extends('layouts.app')

@section('content')
<style>
.non-interactive {
    pointer-events: none;
    background-color: rgb(212, 212, 212);
    padding: 0px 10px 0px 10px;
    border-radius: 7px;
}
.select2-container .select2-selection--single {height: 35px !important;}
.select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 35px !important;}
.select2-container--default .select2-selection--single .select2-selection__arrow {height: 32px !important;}
.select2-container--default .select2-selection--single .select2-selection__clear {height: 30px !important;}
.dataTables_processing {
    z-index: 10000;
}
</style>
<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">
            {{ $title }}
        </h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data {{ $title }}</h3>
                <div class="card-actions d-flex">
                    <div class="me-2" id="c_regency">
                        <select name="filter_regency" id="filter_regency" class="form-control">
                            <option value="" selected>Kabupaten/Kota</option>
                            @foreach ($regency as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="me-2" id="c_district">
                        <select name="filter_district" id="filter_district" class="form-control">
                            <option value="" selected>Kecamatan</option>
                        </select>
                    </div>
                    <div class="me-2" id="c_subdistrict">
                        <select name="filter_subdistrict" id="filter_subdistrict" class="form-control">
                            <option value="" selected>Desa/Kelurahan</option>
                        </select>
                    </div>
                    <a href="#" class="btn btn-outline-azure btn-icon me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                            <path d="M7 9l5 -5l5 5"></path>
                            <path d="M12 4l0 12"></path>
                        </svg>
                    </a>
                    <a href="{{ route('simpatisan.form') }}" class="btn btn-outline-primary btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable" id="simpatisan">
                        <thead>
                            <tr>
                                <th>KOTA/KABUPATEN</th>
                                <th>KECAMATAN</th>
                                <th>DESA/KELURAHAN</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>NAMA</th>
                                <th>NIK</th>
                                <th>NOMOR HP</th>
                                <th>JENIS KELAMIN</th>
                                <th>CREATED BY</th>
                                <th>ACTION</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                    </table>
                </div>
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
{{-- {{ $dataTable->scripts() }} --}}
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script>
    $('#filter_regency').select2({
       placeholder: "Kabupaten/Kota",
       allowClear: true,
       multiple: false,
       width: 'auto'
    });
    $(document).ready(function() {
            var filter_regency = $('#filter_regency').val();
            var filter_district = $('#filter_district').val();
            var filter_subdistrict = $('#filter_subdistrict').val();
                
            function getFilterValues() {
                filter_regency = $('#filter_regency').val();
                filter_district = $('#filter_district').val();
                filter_subdistrict = $('#filter_subdistrict').val();
            }
            
            $('#filter_regency, #filter_district, #filter_subdistrict').on('change', function () {
                getFilterValues(); // Update filter values
                $('#simpatisan').DataTable().ajax.reload();
            });

            var table = $('#simpatisan').DataTable({
                dom: 'Brltip',
                responsive: true,
                processing: true,
                serverSide: true,
                deferRender:true,
                scroller:true,
                pageLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                ajax: {
                    type: 'GET',
                    url: '{{ route("getDataSimpatisan")}}',
                    data: function (d) {
                        getFilterValues();
                        d.regency = filter_regency;
                        d.district = filter_district;
                        d.subdistrict = filter_subdistrict;
                    }
                },
                columns: [
                {data: 'regency_id',name: 'regency_id',searchable:true,visible:true,orderable:true},
                {data: 'district_id',name: 'district_id',searchable:true,visible:true,orderable:true},
                {data: 'subdistrict_id',name: 'subdistrict_id',searchable:true,visible:true,orderable:true},
                {data: 'rt',name: 'rt',searchable:true,visible:true,orderable:true},
                {data: 'rw',name: 'rw',searchable:true,visible:true,orderable:true},
                {data: 'name',name: 'name',searchable:true,visible:true,orderable:true},
                {data: 'nik',name: 'nik',searchable:true,visible:true,orderable:true},
                {data: 'phone',name: 'phone',searchable:true,visible:true,orderable:true},
                {data: 'sex',name: 'sex',searchable:true,visible:true,orderable:true},
                {data: 'user_id',name: 'user_id',searchable:true,visible:true,orderable:true},
                {data: 'action',name: 'action',searchable:true,visible:true,orderable:true},
                {data: 'status',name: 'status',searchable:true,visible:true,orderable:true},
                ],
            });

            $('#filter_regency').on('change', function(){
                if($('#filter_district').val()){
                    $('#filter_district').select2().val('').trigger('change');
                }
                if($('#filter_subdistrict').val()){
                    $('#filter_subdistrict').select2().val('').trigger('change');
                }
                let regency =  $('#filter_regency').val();
                $('#filter_district').select2({
                    placeholder: "Kecamatan",
                    allowClear: true,
                    width: 'auto',
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

            $('#filter_district').on('change', function(){
                if($('#filter_subdistrict').val()){
                    $('#filter_subdistrict').select2().val('').trigger('change');
                }
                let district =  $('#filter_district').val();
                $('#filter_subdistrict').select2({
                    placeholder: "Desa/Kelurahan",
                    allowClear: true,
                    width: 'auto',
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

            // if(('{{auth()->user()->name}}' != 'Superadmin' && '{{auth()->user()->name}}' != 'Udcok'&& '{{auth()->user()->name}}' != 'Martin'
            // && '{{auth()->user()->name}}' != 'Jun'&& '{{auth()->user()->name}}' != 'Adidas')&& '{{auth()->user()->admin}}' == true){
            //     $('#filter_regency').select2().val('{{ auth()->user()->regency_id }}').trigger('change');
            //     $('#c_regency').addClass('non-interactive');
            // }else if(('{{auth()->user()->name}}' != 'Superadmin' && '{{auth()->user()->name}}' != 'Udcok'&& '{{auth()->user()->name}}' != 'Martin'
            // && '{{auth()->user()->name}}' != 'Jun'&& '{{auth()->user()->name}}' != 'Adidas') && '{{auth()->user()->admin}}' == false){
            //     $('#filter_regency').select2().val('{{ auth()->user()->regency_id }}').trigger('change');
            //     $('#filter_district').html('<option value="{{ auth()->user()->district_id }}" selected>{{ auth()->user()->district->name }}</option>');
            //     $('#filter_subdistrict').html('<option value="{{ auth()->user()->subdistrict_id }}" selected>{{ auth()->user()->subdistrict->name }}</option>');
            //     $('#filter_subdistrict').trigger('change');
            //     $('#c_regency,#c_district,#c_subdistrict').addClass('non-interactive');
            // }
            //JIKA HANYA ADMIN SATU DAPIL SAJA maka readonly hanya pada regency
            if(('{{auth()->user()->name}}' != 'Superadmin' && 
                '{{auth()->user()->name}}' != 'Udcok' && 
                '{{auth()->user()->name}}' != 'Martin' && 
                '{{auth()->user()->name}}' != 'Jun' && 
                '{{auth()->user()->name}}' != 'Adidas') 
                && '{{auth()->user()->admin}}' == true)
            {
                    $('#filter_regency').select2().val('{{ auth()->user()->regency_id }}').trigger('change');
                    $('#c_regency').addClass('non-interactive');
            //JIKA Koor Kecamatan maka readonly regency dan district
            }else if('{{auth()->user()->korcam}}' == true){
                    $('#filter_regency').select2().val('{{ auth()->user()->regency_id }}').trigger('change');
                    $('#filter_district').html('<option value="{{ auth()->user()->district_id }}" selected>{{ auth()->user()->district->name }}</option>').trigger('change');
                    $('#c_regency,#c_district').addClass('non-interactive');
                    
            //JIKA HANYA USER BIASA maka readonly semua                    
            }else if('{{auth()->user()->admin}}' == false && '{{auth()->user()->korcam}}' == false){
                    $('#filter_regency').select2().val('{{ auth()->user()->regency_id }}').trigger('change');
                    $('#filter_district').html('<option value="{{ auth()->user()->district_id }}" selected>{{ auth()->user()->district->name }}</option>');
                    $('#filter_subdistrict').html('<option value="{{ auth()->user()->subdistrict_id }}" selected>{{ auth()->user()->subdistrict->name }}</option>');
                    $('#filter_subdistrict').trigger('change');
                    $('#c_regency,#c_district,#c_subdistrict').addClass('non-interactive');
            }
        }
    )
</script>
@endpush

