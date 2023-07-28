@extends('layouts.app')

@section('content')

<div class="mt-4">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <form action="{{ route('handleselect')}}" method="GET">
                    @csrf
                    <div class="card-header">{{ __('Cari Data Simpatisan') }}</div>
                    <div class="card-body">
                        <p class="mt-2">
                            <select name="dpt" id="dpt" class="form-control">
                                <option></option>
                                @foreach ($dpt as $data)
                                    <option value="{{ $data->id }}">{{ $data->simpatisan_name }} - {{ $data->subdistrict_name }}, {{ $data->district_name }}, {{ $data->regency_name }}</option>
                                @endforeach
                            </select>
                        </p>
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
         $('#dpt').select2({
            placeholder: "Pilih Data Simpatisan",
            allowClear: true,
            minimumInputLength: 3,
            multiple: false,
         });
    </script>
@endpush

