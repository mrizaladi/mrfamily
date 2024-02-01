@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-2">
        <div class="col">
            <form action="{{ route('simpatisan.export') }}" method="GET">
                <div class="card">
                    <div class="card-header">
                        Laporan Simpatisan
                    </div>
                    <div class="card-body">
                        <div class="form-group row mt-2">
                            <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label class="form-label required">Kabupaten/Kota</label>
                                    <select class="form-control form-select" name="regency_id" id="regency">
                                        <option value="">Semua Kabupaten / Kota</option>
                                        @foreach ($regencies as $regency)
                                        <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label class="form-label required">Kecamatan</label>
                                    <select class="form-control form-select" name="district_id" id="district">
                                        <option value="">Semua Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="mb-3">
                                    <label class="form-label required">User</label>
                                    <select name="updated_by" class="form-select" data-search="true">
                                        <option value="">Semua user</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
<script>
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
                        $('#district').append('<option value="">Semua Kecamatan</option>');
                        $.each(result, function(key, value) {
                            $('#district').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#district').val("{{ old('district_id') }}").trigger('change');
                    } else {
                        $('#district').empty();
                    }
                }
            });
        });
        // Remove unnecessary change event for subdistrict
        if ("{{ old('regency_id')}}") {
            console.log("{{ old('regency_id')}}");
            $('#regency').trigger('change');
        }
    });

</script>
@endsection

