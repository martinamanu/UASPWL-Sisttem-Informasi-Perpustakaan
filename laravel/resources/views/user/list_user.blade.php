@extends('layouts.app')

@section("head")
{{-- <script src="{{ asset('js/datatables.js') }}" defer></script> --}}
<link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
<script>
    $(document).ready(function () {
        $('table').DataTable({
            responsive: true
        });
    });
</script>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Daftar User
                    @if ($datauser->level->can_add_user)
                    <a href="{{route("tambah_user")}}" class="btn btn-success float-right">Tambah User</a>
                    @endif
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table responsive nowrap w-100" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th  class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                        <tbody>
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->nama}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->level}}</td>
                            <td class="text-center">
                                @if ($datauser->level->can_edit_user)
                                <a class="btn btn-primary mr-2 text-white" href="{{route("edit_user", ["id" => $user->id])}}">Edit</a>
                                @endif
                                @if ($datauser->level->can_delete_user)
                                <a class="btn btn-danger text-white" href="{{route("hapus_user", ["id" => $user->id])}}">Hapus</a>
                                @endif
                            </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section("end")
@endsection
