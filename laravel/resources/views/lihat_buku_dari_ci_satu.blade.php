@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$data["nama_buku"]}}</div>

                <div class="card-body">
                    <div class="row my-3">
                        <div class="col-12 col-xl-2">Nama</div>
                        <div class="col-12 col-xl-10">{{$data["nama_buku"]}}</div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12 col-xl-2">Penulis</div>
                        <div class="col-12 col-xl-10">{{$data["penulis"]}}</div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12 col-xl-2">Penerbit</div>
                        <div class="col-12 col-xl-10">{{$data["penerbit"]}}</div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12 col-xl-2">Jumlah</div>
                        <div class="col-12 col-xl-10">{{$data["jumlah"]}}</div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route("dari_ci")}}"  class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
