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
                        <table>
                            <tr>
                                <th>Informasi</th>
                                <td><strong> </strong></td>
                                <th>Detail</th>
                            </tr>
                            <tr>
                                <td><strong>NIK</strong></td>
                                <td><strong>:</strong></td>
                                <td>{{ $simpatisan->nik }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td><strong>:</strong></td>
                                <td>{{ $simpatisan->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Telepon</strong></td>
                                <td><strong>:</strong></td>
                                <td>{{ $simpatisan->phone }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td><strong>:</strong></td>
                                <td>{{ $simpatisan->sex }}</td>
                            </tr>
                            <tr>
                                <td><strong>Usia</strong></td>
                                <td><strong>:</strong></td>
                                <td>{{ $simpatisan->age }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Alamat:</strong></p>
                        <ul>
                            <li><strong>Kota/Kabupaten :</strong> {{ $simpatisan->regency->name }}</li>
                            <li><strong>Kecamatan :</strong> {{ $simpatisan->district->name }}</li>
                            <li><strong>Desa/Kelurahan :</strong> {{ $simpatisan->subdistrict->name }}</li>
                            <li><strong>RT/RW :</strong> {{ $simpatisan->rt }}/{{ $simpatisan->rw }}</li>
                            <li><strong>TPS :</strong> {{ $simpatisan->tps }}</li>
                        </ul>
                        <p><strong>Created by:</strong> {{ $simpatisan->user?$simpatisan->user->name:'-' }}</p>
                        <p><strong>Status:</strong> 
                            <?php $allowedEx = ['jpeg','jpg','png','ico','jfif','webp'];
                            $fileExtension = pathinfo($simpatisan->ktp, PATHINFO_EXTENSION);?>
                            @if(in_array(strtolower($fileExtension), $allowedEx) || $simpatisan->status == true)
                                <a readonly class="disable badge bg-success text-nowrap text-decoration-none" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg> valid</a>
                            @elseif(!$simpatisan->nik)
                              <a readonly class="disable badge bg-secondary text-nowrap text-decoration-none" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                              </svg> Incomplete data</a>
                            @else
                                {{-- <span id="content_status">
                                    <a readonly class="disable badge bg-warning text-nowrap" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                    </svg> Need Approval</a>
                                </span> --}}
                                <a readonly class="disable badge bg-success text-nowrap text-decoration-none" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                    </svg> valid
                                </a>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>KTP:</h3>
                        <img class="img-fluid" src="{{ asset('ktp/'. $simpatisan->ktp) }}" alt="KTP">
                    </div>
                    {{-- <div class="col-md-6">
                        @if($simpatisan->nik && !in_array(strtolower($fileExtension), $allowedEx) && $simpatisan->status == false)
                        <a id='approve_simpatisan' data-simpatisan="{{ $simpatisan->id }}" class="btn btn-lg w-100 btn-outline-success text-decoration-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>&nbsp;Approve Simpatisan</a>
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
<script>
    $(document).ready(function() {
        $('#approve_simpatisan').on('click', function(){
            let simpatisan_id = $(this).data('simpatisan');
            var confirmation = confirm('Are you sure approve data '+'{{ $simpatisan->name }}'+'?');
            // console.log(confirmation);
            if (confirmation == true) {
                $.ajax({
                    url: "{{ route('simpatisan.approve') }}",
                    type: "GET",
                    data: {id: simpatisan_id},
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if(response.status == 200){
                            $('#approve_simpatisan').hide();
                            Swal.fire({
                              title: 'Success!',
                              text: response.output,
                              icon: 'success',
                              timer: 2000,
                              timerProgressBar: true,
                              showConfirmButton: false,
                            });
                            $('#content_status').html(`
                                <a readonly class="disable badge bg-success text-nowrap text-decoration-none" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg> Approved</a>`);
                        }
                        else{
                            Swal.fire(
                                'Failed!',
                                response.output,
                                'error'
                            );
                        }
                    }
                });
            } else {
                Swal.fire({
                  title: 'Cancel!',
                  text: response.output,
                  icon: 'error',
                  timer: 1000,
                  timerProgressBar: true,
                  showConfirmButton: false,
                });
            }
        });
    });
</script>
@endsection

