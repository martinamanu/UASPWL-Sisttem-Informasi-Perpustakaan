@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Buku</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group">
                            <label for="nama_buku">Nama Buku</label>
                            <input type="text" class="form-control @error('nama_buku') is-invalid @enderror" name="nama_buku" id="nama_buku"/>
                            @error('nama_buku')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror" name="penulis" id="penulis"/>
                            @error('penulis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" id="penerbit"/>
                            @error('penerbit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah"/>
                            @error('jumlah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route("home")}}"  class="btn btn-secondary">Kembali</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
