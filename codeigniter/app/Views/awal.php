    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">

                    </div> -->
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <p class="card-text">Selamat Datang Di Perpustakaan</p>
                    </div>
                    <div class="card-footer">
                        <?php if ($session->has("token")) : ?>
                            <a href="/buku" class="btn btn-primary">Home</a>
                        <?php else : ?>
                            <a href="/auth/login" class="btn btn-primary">Login</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>