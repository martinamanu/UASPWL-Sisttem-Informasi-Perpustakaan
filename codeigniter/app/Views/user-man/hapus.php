<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hapus User (<?= $userinfo->name ?>)</div>

                <div class="card-body">
                    Apakah anda yakin menghapus user <?= $userinfo->email ?>?
                </div>
                <div class="card-footer">
                    <form method="POST" action="">
                        <button type="submit" class="btn btn-danger">Iya</button>
                        <a href="/user" class="btn btn-primary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>