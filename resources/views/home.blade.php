@extends('layouts.app')

@section('custom_styles')

@endsection

@section('content')
@if(auth()->user()->approved_at)
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pemilih TPS Per-Kabupaten/Kota</h3>
                    </div>
                    <table class="table card-table table-vcenter">
                        <thead>
                            <tr>
                                <th>Kabupaten/Kota</th>
                                <th>Jumlah Pemilih MR</th>
                                <th>Jumlah Pemilih Golkar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tps as $tp)
                            <tr>
                                <b>
                                    <td>{{ $tp->kabupaten }}</td>
                                </b>
                                <td>{{ $tp->total_voters }}</td>
                                <td>{{ $tp->total_golkars }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="page-body">
    <div class="container-xl">
        <div class="alert alert-danger" role="alert">
            <div class="d-flex">
                <div class="me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1 -19.995 .324l-.005 -.324l.004 -.28c.148 -5.393 4.566 -9.72 9.996 -9.72zm.01 13l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -8a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="alert-title">Akun anda belum terverifkasi!</h4>
                    <div class="text-muted">Hubungi admin untuk menverifikasi akun anda</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@push('styles')
    <style>
    .gold-bg {
    background-color: gold;
    }

    .silver-bg {
    background-color: silver;
    }

    .bronze-bg {
    background-color: #cd7f32; /* Warna perunggu */
    }


    </style>
@endpush