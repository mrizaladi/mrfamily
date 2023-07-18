@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">
            Detail Data Simpatisan
        </h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>NIK:</strong> {{ $simpatisan->nik }}</p>
                        <p><strong>Nama:</strong> {{ $simpatisan->name }}</p>
                        <p><strong>Telepon:</strong> {{ $simpatisan->phone }}</p>
                        <p><strong>Jenis Kelamin:</strong> {{ $simpatisan->sex }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Alamat:</strong></p>
                        <ul>
                            <li><strong>Kota/Kabupaten:</strong> {{ $simpatisan->regency->name }}</li>
                            <li><strong>Kecamatan:</strong> {{ $simpatisan->district->name }}</li>
                            <li><strong>Kelurahan:</strong> {{ $simpatisan->subdistrict->name }}</li>
                        </ul>
                        <p><strong>Created by:</strong> {{ $simpatisan->user->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3>KTP:</h3>
                        <img src="{{ asset('storage/fotoktp/' . $simpatisan->ktp) }}" alt="KTP" style="max-width: 50%;">
                        <img src="{{ $simpatisan->ktp_url }}" alt="KTP" style="max-width: 100%;">


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

