<?php
$validation = \Config\Services::validation();
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tambah Buku
                    <!-- <a class="btn btn-success mr-2 text-white float-right" href="#">Tambah Buku</a> -->
                </div>
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <form method="POST" action="/buku/save">
                        <div class="form-group">
                            <label for="nama_buku">Nama Buku</label>
                            <input type="text" class="form-control  <?= (!empty($validation->getError("nama_buku")) ? "is-invalid" : "") ?>" name="nama_buku" id="nama_buku" />
                            <?php if (!empty($validation->getError("nama_buku"))) : ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong class="h6"><?= $validation->getError("nama_buku") ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control  <?= (!empty($validation->getError("penulis")) ? "is-invalid" : "") ?>" name="penulis" id="penulis" />
                            <?php if (!empty($validation->getError("penulis"))) : ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong class="h6"><?= $validation->getError("penulis") ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control  <?= (!empty($validation->getError("penerbit")) ? "is-invalid" : "") ?>" name="penerbit" id="penerbit" />
                            <?php if (!empty($validation->getError("penerbit"))) : ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong class="h6"><?= $validation->getError("penerbit") ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control  <?= (!empty($validation->getError("jumlah")) ? "is-invalid" : "") ?>" name="jumlah" id="jumlah" />
                            <?php if (!empty($validation->getError("jumlah"))) : ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong class="h6"><?= $validation->getError("jumlah") ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/buku" class="btn btn-secondary">Kembali</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>