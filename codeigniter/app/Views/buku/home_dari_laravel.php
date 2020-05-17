<?php

// dd(json_decode($buku)[0]->id);

use App\Models\Auth;

$auth = new Auth();
?>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Daftar Buku
                    <?php if ($auth->getUserPriv($user["token"])->can_add_book) : ?>
                        <a href="/buku/tambah" class="btn btn-success float-right">Tambah Buku</a>
                    <?php endif ?>
                </div>
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <table class="table " style="width:100%" id="table-buku">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Buku</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Jumlah</th>
                                <?php if ($auth->getUserPriv($user["token"])->can_edit_book && $auth->getUserPriv($user["token"])->can_delete_book) : ?>
                                    <th class="text-center">Aksi</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($buku as $row) : ?>
                                <tr>
                                    <td><?= $row->id; ?></td>
                                    <td><?= $row->nama_buku ?></td>
                                    <td><?= $row->penulis ?></td>
                                    <td><?= $row->penerbit ?></td>
                                    <td><?= $row->jumlah ?></td>
                                    <?php if ($auth->getUserPriv($user["token"])->can_edit_book && $auth->getUserPriv($user["token"])->can_delete_book) : ?>

                                        <td class="text-center">
                                            <?php if ($auth->getUserPriv($user["token"])->can_edit_book) : ?>

                                                <a href="/buku/edit/<?= $row->id; ?>" class="btn btn-primary mr-2">Edit</a>
                                            <?php endif ?>
                                            <?php if ($auth->getUserPriv($user["token"])->can_delete_book) : ?>

                                                <a href="/buku/hapus/<?= $row->id; ?>" class="btn btn-danger mr-2">Hapus</a>
                                            <?php endif ?>

                                        <?php endif ?>
                                        </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="card-footer">
                        <a href="#" class="btn btn-primary">Home</a>
                    </div> -->
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.21/r-2.2.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-buku').DataTable();
        });
    </script>
</body>

</html> -->