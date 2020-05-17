<?php
$validation = \Config\Services::validation();
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <form method="POST" action="/user/tambah/">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control <?= (!empty($validation->getError("nama")) ? "is-invalid" : "") ?>" name="nama" id="nama" />
                            <?php if (!empty($validation->getError("nama"))) : ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong class="h6"><?= $validation->getError("nama") ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control <?= (!empty($validation->getError("email")) ? "is-invalid" : "") ?>" name="email" id="email" />
                            <?php if (!empty($validation->getError("email"))) : ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong class="h6"><?= $validation->getError("email") ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control <?= (!empty($validation->getError("password")) ? "is-invalid" : "") ?>" name="password" id="password" />
                            <?php if (!empty($validation->getError("password"))) : ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong class="h6"><?= $validation->getError("password") ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <select class="custom-select <?= (!empty($validation->getError("jabatan")) ? "is-invalid" : "") ?>" name="jabatan">
                                <option value="">Pilih salah satu jabatan</option>
                                <?php foreach ($jabatan as $row) : ?>
                                    <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($validation->getError("jabatan"))) : ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong class="h6"><?= $validation->getError("jabatan") ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/user" class="btn btn-secondary">Kembali</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>