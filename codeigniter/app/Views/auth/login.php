<?php
$validation = \Config\Services::validation();
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Login
                    <!-- <a class="btn btn-success mr-2 text-white float-right" href="#">Tambah Buku</a> -->
                </div>
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <form method="POST" action="/auth/login">
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
                            <input type="password" class="form-control <?= (!empty($validation->getError("email")) ? "is-invalid" : "") ?>" name="password" id="password" />
                            <?php if (!empty($validation->getError("password"))) : ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong class="h6"><?= $validation->getError("password") ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/" class="btn btn-secondary">Kembali</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>