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
            <select name="regency_id" id="regencies" class="form-select @error('regency_id') is-invalid @enderror">
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
            <select name="district_id" class="form-select @error('district_id') is-invalid @enderror">
                <option value="" style="color: #999;">Pilih Kecamatan</option>
                @foreach ($districts as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
            </select>
            @error('district_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Kelurahan') }}</label>
            <select name="subdistrict_id" class="form-select @error('subdistrict_id') is-invalid @enderror">
                <option value="" style="color: #999;">Pilih Kelurahan</option>
                @foreach ($subdistricts as $sub)
                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                @endforeach
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