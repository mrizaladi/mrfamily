@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">
            Simpatisan
        </h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Simpatisan</h3>
                <div class="card-actions">
                    <a href="#" class="btn btn-outline-azure btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                            <path d="M7 9l5 -5l5 5"></path>
                            <path d="M12 4l0 12"></path>
                        </svg>
                    </a>
                    <a href="{{ route('simpatisan.create') }}" class="btn btn-outline-primary btn-icon">
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
                                <th>#</th>
                                <th>Created At</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>No Handphone</th>
                                <th>Jenis Kelamin</th>
                                <th>Kabupaten/Kota</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('custom_scripts')
<script>
    $(document).ready(function () {
        $('#simpatisan').DataTable({
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
                url: '{{ route("getSimpatisan")}}'
            },
            columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable: false },
            {data: 'created_at',name: 'created_at',searchable:true,visible:true,orderable:true},
            {data: 'nik',name: 'nik',searchable:true,visible:true,orderable:true},
            {data: 'name',name: 'name',searchable:true,visible:true,orderable:true},
            {data: 'phone',name: 'phone',searchable:true,visible:true,orderable:true},
            {data: 'sex',name: 'sex',searchable:true,visible:true,orderable:true},
            {data: 'regency_id',name: 'regency_id',searchable:true,visible:true,orderable:true},
            {data: 'district_id',name: 'district_id',searchable:true,visible:true,orderable:true},
            {data: 'subdistrict_id',name: 'subdistrict_id',searchable:true,visible:true,orderable:true},
            {data: 'user_id',name: 'user_id',searchable:true,visible:true,orderable:true},
            {data: 'action',name: 'action',searchable:true,visible:true,orderable:true},
            ],
        });
    });
    
    $('#btnFiterSubmitSearch').click(function(){
         $('#simpatisan').DataTable().draw(true);
    });
</script>
@endsection

