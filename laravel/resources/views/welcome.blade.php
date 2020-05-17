<?php
// dd($datauser->data[0]);
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Awal</div>

                <div class="card-body">
                    Selamat Datang Diperpustakaan kami
                </div>
                <div class="card-footer">
                    @if(!$hasapi)
                    <a href="{{ route('api.login') }}" class="btn btn-primary">Login</a>
                    @else
                    <a href="{{ route('dari_ci') }}" class="btn btn-primary">Home</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

