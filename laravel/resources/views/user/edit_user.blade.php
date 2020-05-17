@extends('layouts.app')
{{--  --}}
<?php
foreach($data as $level) {
    // dd($data);
}
// die();
?>


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User ({{$data->nama}})</div>
                <div class="card-body">
                    <form method="POST" action="" id='edit-user'>
                        @csrf
                        <div class="form-group">
                            <label for="nama_user">Nama user</label>
                        <input type="text" class="form-control @error('nama_user') is-invalid @enderror" name="nama_user" value="{{$data->nama}}" id="nama_user"/>
                            @error('nama_user')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{$data->email}}"  id="email"/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"/>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="level">Jabatan</label>
                            <select name="level" class="custom-select @error('level') is-invalid @enderror">
                                <option>Pilih salah satu</option>
                                <?php foreach ($levels as $level) : ?>
                                {{-- @foreach($levels as $level) --}}
                                    {{-- <option value="" {{($data->level->id === $level->id) ? 'selected' : ''}}>{{$level->nama}}</option> --}}
                                    <option value="<?= $level->id ?>" <?= (($data->level_id === $level->id) ? "selected" : "") ?> >{{$level->nama}}</option>
                            <?php endforeach;?>
                            </select>
                            @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="edit-user" class="btn btn-primary">Submit</button>
                    <a href="{{route("user")}}"  class="btn btn-secondary">Kembali</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
