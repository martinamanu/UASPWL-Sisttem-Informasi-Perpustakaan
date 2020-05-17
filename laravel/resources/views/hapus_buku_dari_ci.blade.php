@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hapus Buku ({{$data['nama_buku']}})</div>

                <div class="card-body">
                    Apakah anda yakin menghapus buku {{$data['nama_buku']}}?
                </div>
                <div class="card-footer">
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="btn btn-danger">Iya</button>
                        <a href="{{route("dari_ci")}}"  class="btn btn-primary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
