    <style>
      .card-img-top {
        width: 100%;
        /* Lebar 100% dari container */
        height: 200px;
        /* Atur tinggi gambar sesuai keinginan */
        object-fit: cover;
        /* Memastikan gambar terpotong secara proporsional */
        object-position: center;
        /* Memusatkan gambar */
      }
    </style>
    <div class="row mb-5">
      <?php if (!empty($koleksi)) : ?>
        <?php foreach ($koleksi as $key => $value) : ?>
          <div class="col-md-6 col-xl-3">
            <div class="card mb-3">
              <img class="card-img-top" src="<?= base_url('assets/img/buku/' . $value['foto']); ?>" alt="Card image cap">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <h5 class="card-title"><?= $value['judul']; ?></h5>
                  <small class="text-muted"><?= $value['penulis']; ?> | <?= $value['tahun_terbit']; ?></small>
                </div>
                <a href="<?= base_url('koleksi/hapus/' . $value['id_koleksi']); ?>" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i> Hapus Koleksi</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="col-12">
          <div class="alert alert-warning text-center" role="alert">
            Data koleksi belum ada.
          </div>
          <a href="<?= base_url(''); ?>" class="btn btn-warning">Kembali</a>
        </div>
      <?php endif; ?>

    </div>