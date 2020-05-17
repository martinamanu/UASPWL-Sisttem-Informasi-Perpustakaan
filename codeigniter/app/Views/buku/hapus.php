<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hapus Buku (<?= $buku->nama_buku ?>)</div>

                <div class="card-body">
                    Apakah anda yakin menghapus buku <?= $buku->nama_buku ?>?
                </div>
                <div class="card-footer">
                    <form method="POST" action="/buku/delete/<?= $buku->id ?>">
                        <button type="submit" class="btn btn-danger">Iya</button>
                        <a href="/buku" class="btn btn-primary">Kembali</a>
                    </form>
                </div>
                <!-- <div class="card-footer">
                        <a href="#" class="btn btn-primary">Home</a>
                    </div> -->
            </div>
        </div>
    </div>
</div>

</body>