@extends('layouts.app')

@section('custom_styles')

@endsection

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
                            <label class="col-2 col-form-label">User</label>
                            <div class="col-2">
                                <select name="user" class="form-select">
                                    <option value="#">Silahkan pilih user</option>
                                      @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                      @endforeach
                                </select>
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

