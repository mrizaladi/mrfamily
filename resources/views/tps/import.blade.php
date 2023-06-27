@extends('layouts.app')

@section('content')

<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">
            Import Data TPS
        </h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Import</h3>
                    </div>
                    <div class="card-body">
                        <form id="form" method="POST" action="#" enctype="multipart/form-data">
                            <div class="row form-group">
                                <input type="hidden" name="_token" value="kzIHrkRg6fQlqNO9ClBuQ0pmygPgMG79xrU3TDmx"> <label for="file" class="col-form-label col-3">File CSV</label>
                                <div class="col-9">
                                    <input id="file" type="file" class="form-control" filetype=".xlsx" name="file" required="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-end">
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3"></path>
                                    </svg>
                                    Import
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

