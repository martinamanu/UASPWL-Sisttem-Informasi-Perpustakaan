@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Buku ({{$data["nama_buku"]}})</div>

                <div class="card-body">
                    <form method="POST" action="" id='edit-buku'>
                        @csrf
                        <div class="form-group">
                            <label for="nama_buku">Nama Buku</label>
                        <input type="text" class="form-control @error('nama_buku') is-invalid @enderror" name="nama_buku" value="{{$data["nama_buku"]}}" id="nama_buku"/>
                            @error('nama_buku')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis"  value="{{$data["penulis"]}}"  id="penulis"/>
                            @error('penulis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" value="{{$data['penerbit']}}" id="penerbit"/>
                            @error('penerbit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="{{$data["jumlah"]}}"  id="jumlah"/>
                            @error('jumlah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                </div>
                <div class="card-footer">
                    <button type="submit" id="edit-buku" class="btn btn-primary">Submit</button>
                    <a href="{{route("dari_ci")}}"  class="btn btn-secondary">Kembali</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
