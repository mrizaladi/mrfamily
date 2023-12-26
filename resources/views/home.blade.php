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
                                 <h3 class="card-title">Data Pemilih dan Simpatisan Per-Kabupaten/Kota</h3>
                             </div>
                             <table class="table card-table table-vcenter">
                                 <thead>
                                     <tr>
                                         <th>Kabupaten/Kota</th>
                                         <th>Jumlah Simpatisan</th>
                                         <th>Jumlah DPT</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td>Kota Semarang</td>
                                         <td>{{ $totalSimpatisanKotaSemarang }}</td>
                                         <td>{{ $totalPemilihKotaSemarang }}</td>

                                     </tr>
                                     <tr>
                                         <td>Kabupaten Semarang</td>
                                         <td>{{ $totalSimpatisanKabSemarang }}</td>
                                         <td>{{ $totalPemilihKabSemarang }}</td>

                                     </tr>
                                     <tr>
                                         <td>Kabupaten Kendal</td>
                                         <td>{{ $totalSimpatisanKendal }}</td>
                                         <td>{{ $totalPemilihKendal }}</td>

                                     </tr>
                                     <tr>
                                         <td>Kabupaten Salatiga</td>
                                         <td>{{ $totalSimpatisanSalatiga }}</td>
                                         <td>{{ $totalPemilihSalatiga }}</td>

                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                     </div>

                     {{-- <div class="col-sm-6 col-lg-3">
                         <div class="card">
                             <div class="card-body">
                                 <div class="d-flex align-items-center">
                                     <div class="subheader">Target</div>
                                     <div class="ms-auto lh-1">
                                         <div class="dropdown">
                                             <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                                             <div class="dropdown-menu dropdown-menu-end">
                                                 <a class="dropdown-item active" href="#">Last 7 days</a>
                                                 <a class="dropdown-item" href="#">Last 30 days</a>
                                                 <a class="dropdown-item" href="#">Last 3 months</a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="h1 mb-3">75%</div>
                                 <div class="d-flex mb-2">
                                     <div>Conversion rate</div>
                                     <div class="ms-auto">
                                         <span class="text-green d-inline-flex align-items-center lh-1">
                                             7%
                                             <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                             <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                 <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                 <path d="M3 17l6 -6l4 4l8 -8"></path>
                                                 <path d="M14 7l7 0l0 7"></path>
                                             </svg>
                                         </span>
                                     </div>
                                 </div>
                                 <div class="progress progress-sm">
                                     <div class="progress-bar bg-primary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                                         <span class="visually-hidden">75% Complete</span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div> --}}
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