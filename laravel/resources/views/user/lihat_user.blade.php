@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$data->name}}</div>

                <div class="card-body">
                    <div class="row my-3">
                        <div class="col-12 col-xl-2">Nama</div>
                        <div class="col-12 col-xl-10">{{$data->name}}</div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12 col-xl-2">Email</div>
                        <div class="col-12 col-xl-10">{{$data->email}}</div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12 col-xl-2">Jabatan</div>
                        <div class="col-12 col-xl-10">{{$data->level->nama}}</div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route("user")}}"  class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
