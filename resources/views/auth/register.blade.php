@extends('layouts.guest')

@section('content')
<form action="{{ route('register') }}" method="post" autocomplete="off">
    @csrf

    <div class="card-body">
        <h2 class="card-title text-center mb-4">{{ __('Create new account') }}</h2>

        <div class="mb-3">
            <label class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Email address') }}</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Password') }}</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Repeat Password') }}</label>
            <input type="password" name="password_confirmation" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Repeat Password') }}">
            @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Kota/Kabupaten') }}</label>
            <select name="regency_id" id="regency" class="form-select @error('regency_id') is-invalid @enderror">
                <option value="" style="color: #999;">Pilih Kota/Kabupaten</option>
                @foreach ($regencies as $regency)
                <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                @endforeach
            </select>
            @error('regency_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Kecamatan') }}</label>
            <select name="district_id" id="regdistrict" class="form-select @error('district_id') is-invalid @enderror">
                <option value="">Pilih Kabupaten</option>
            </select>
            @error('district_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Kelurahan') }}</label>
            <select class="form-control form-select" name="subdistrict_id" id="regsubdistrict">
                <option value="">Pilih Desa/Kelurahan</option>
            </select>
            @error('subdistrict_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">{{ __('Create new account') }}</button>
        </div>
    </div>
</form>

@if (Route::has('login'))
<div class="text-center text-muted mt-3">
    {{ __('Already have account?') }} <a href="{{ route('login') }}" tabindex="-1">{{ __('Sign in') }}</a>
</div>
@endif

@endsection

@section('custom_scripts')
<script>

    $(document).ready(function() {
        $('#regency').on('change', function() {
            var idRegency = this.value;
            console.log(idRegency);
            $("#regdistrict").html('');
            $.ajax({
                url: '/regdistrict/' + idRegency
                , type: "GET"
                , data: {}
                , dataType: 'json'
                , success: function(result) {
                    if (result) {
                        $('#regdistrict').empty();
                        $('#regdistrict').append('<option hidden>Pilih Kecamatan</option>');
                        $.each(result, function(key, value) {
                            $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    } else {
                        $('#regdistrict').empty();
                    }
                }
            });
        });
        $('#regdistrict').on('change', function() {
            var idRegency = this.value;
            console.log(idRegency);
            $("#regsubdistrict").html('');
            $.ajax({
                url: '/regsubdistrict/' + idRegency
                , type: "GET"
                , data: {}
                , dataType: 'json'
                , success: function(res) {
                    if (res) {
                        $('#regsubdistrict').empty();
                        $('#regsubdistrict').append('<option hidden>Pilih Kecamatan</option>');
                        $.each(res, function(key, val) {
                            $('select[name="subdistrict_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                    } else {
                        $('#regsubdistrict').empty();
                    }
                }
            });
        });
    });

</script>
@endsection
