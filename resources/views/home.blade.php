@extends('template.main')
@section('container')
    <div class="row d-flex d-flex justify-content-around">
        <div class="fs-2 text-center col-12 mb-4">
            SELAMAT DATANG ADMINISTRATOR
        </div>

        <div class="row col-10 d-flex justify-content-around mb-4 text-center">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-info">Jumlah Soal</h5>
                        {{-- <p class="card-text fs-3 text-danger">{{$jmlSoal}}</p> --}}
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-info">Jumlah User</h5>
                        {{-- <p class="card-text fs-3 text-danger">{{$jmlUser}}</p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-10 d-flex justify-content-around text-center">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-info">Jumlah User Yang sudah selesai</h5>
                        {{-- <p class="card-text fs-3 text-danger">{{$jmlUserFinish}}</p> --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection
