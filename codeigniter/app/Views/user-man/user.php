<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Daftar User
                    <?php if ($auth->getUserPriv($user["token"])->can_see_user) : ?>
                        <a class="btn btn-success mr-2 text-white float-right" href="/user/tambah">Tambah User</a>
                    <?php endif ?>
                </div>
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <table class="table" style="width:100%" id="table-buku">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <?php if ($auth->getUserPriv($user['token'])->can_edit_user && $auth->getUserPriv($user['token'])->can_delete_user) : ?>
                                    <th class="text-center">Aksi</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datauser as $row) : ?>
                                <tr>
                                    <td><?= $row->id; ?></td>
                                    <td><?= $row->name; ?></td>
                                    <td><?= $row->email; ?></td>
                                    <td><?= $row->level; ?></td>
                                    <td class="text-center">
                                        <?php if ($auth->getUserPriv($user['token'])->can_edit_user) : ?>
                                            <a class="btn btn-primary mr-2 text-white" href="/user/edit/<?= $row->id; ?>">Edit</a>
                                        <?php endif ?>
                                        <?php if ($auth->getUserPriv($user['token'])->can_delete_user) : ?>
                                            <a class="btn btn-danger mr-2 text-white" href="/user/hapus/<?= $row->id; ?>">Hapus</a>
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
<!-- <script>
    $(document).ready(function() {
        $('#table-buku').DataTable();
    });
</script> -->