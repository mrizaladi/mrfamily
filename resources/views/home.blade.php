@extends('layouts.app')

@section('custom_styles')

@endsection

@section('content')

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-md-6 col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Simpatisan Per-Kabupaten/Kota</h3>
                        </div>
                        <table class="table card-table table-vcenter">
                            <thead>
                                <tr>
                                    <th>Kabupaten/Kota</th>
                                    <th>Jumlah</th>
                                    <th>Target</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Kota Semarang</td>
                                    <td>3,550,000</td>
                                    <td class="w-40">
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-primary" style="width: 71.0%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kabupaten Semarang</td>
                                    <td>1,798,000</td>
                                    <td class="w-40">
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-primary" style="width: 35.96%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kabupaten Kendal</td>
                                    <td>1,245,000</td>
                                    <td class="w-40">
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-primary" style="width: 24.9%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kabupaten Salatiga</td>
                                    <td>986,000</td>
                                    <td class="w-40">
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-primary" style="width: 19.72%"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
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
                </div>
            </div>

        </div>
    </div>
@endsection