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
                    Daftar Buku
                    @if ($datauser->level->can_add_book)
                    <a href="{{route("tambah_dari_ci_satu")}}" class="btn btn-success float-right">Tambah Buku</a>
                    @endif
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table responsive nowrap w-100" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Buku</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Jumlah</th>
                                @if ($datauser->level->can_edit_book && $datauser->level->can_delete_book)
                                <th  class="text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        @foreach ($bukus as $buku)
                        <tbody>
                            <tr>
                                <td>{{$buku["id"]}}</td>
                                {{-- <td><a href="{{route("dari_ci_satu", ["id" => $buku["id"]])}}">{{$buku["nama_buku"]}}</a></td> --}}
                                <td>{{$buku["nama_buku"]}}</a></td>
                                <td>{{$buku["penulis"]}}</td>
                                <td>{{$buku["penerbit"]}}</td>
                                <td>{{$buku["jumlah"]}}</td>
                                @if ($datauser->level->can_edit_book && $datauser->level->can_delete_book)
                            <td class="text-center">
                                @if ($datauser->level->can_edit_book)
                                <a class="btn btn-primary mr-2 text-white" href="{{route("edit_dari_ci_satu", ["id" => $buku["id"]])}}">Edit</a>
                                @endif
                                @if ($datauser->level->can_delete_book)
                                <a class="btn btn-danger text-white" href="{{route("hapus_dari_ci_satu", ["id" => $buku["id"]])}}">Hapus</a>
                                @endif
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
