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
                        <tbody>
                            @foreach ($simpatisan as $sim)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sim->nik }}</td>
                                <td>{{ $sim->name }}</td>
                                <td>{{ $sim->phone }}</td>
                                <td>{{ $sim->sex }}</td>
                                <td>{{ $sim->regency?->name }}</td>
                                <td>{{ $sim->district->name }}</td>
                                <td>{{ $sim->subdistrict->name }}</td>
                                <td>{{ $sim->user?->name }}</td>
                                <td style="width: 10%;">
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('simpatisan.edit', $sim->id) }}" class="btn btn-outline-success btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('simpatisan.destroy', $sim->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-icon" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 7l16 0"></path>
                                                    <path d="M10 11l0 6"></path>
                                                    <path d="M14 11l0 6"></path>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('custom_scripts')
<script>
    $(document).ready(function() {
        $('#simpatisan').DataTable();
    });

</script>
@endsection

