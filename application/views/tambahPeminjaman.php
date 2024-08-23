<div class="row">
  <div class="col-md-4">
    <div class="card mb-4">
      <div class="card-header">
        <h5 class="mb-0">Pilih Buku</h5>
      </div>
      <div class="card-body">
        <form action="<?= base_url('peminjaman/tambahPeminjaman'); ?>" method="post">
          <input type="hidden" name="id_user" value="<?= $userr->id_user; ?>">
          <div class="form-group mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" value="<?= $userr->nama; ?>" readonly>
          </div>
          <div class="form-group mb-3">
            <label class="form-label">Buku</label>
            <select class="form-select js-select2" name="id_buku">
              <?php foreach ($buku as $value) : ?>
                <option value="<?= $value['id_buku']; ?>" <?= $value['stok'] == 0 ? 'disabled' : ''; ?>><?= $value['judul']; ?>(<?= $value['stok']; ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>
          <button class="btn btn-primary">Tambah</button>
          <a href="<?= base_url('peminjaman'); ?>" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h5>Data Buku Pilihan</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap mb-4">
          <table id="myTable" class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <?php $no = 1;
              foreach ($temp as $value) : ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $value->judul; ?></td>
                  <td><?= $value->penulis; ?></td>
                  <td><?= $value->penerbit; ?></td>
                  <td>
                    <a id="btn-hapus" class="btn btn-danger btn-sm" href="<?= base_url('peminjaman/hpstemp/' . $value->id_temp); ?>"><i class="bx bx-trash me-1"></i>Hapus</a>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <?php if ($temp != null) : ?>
          <form action="<?= base_url('peminjaman/prosesPeminjaman'); ?>" method="post">
            <input type="hidden" name="id_user" value="<?= $userr->id_user; ?>">
            <div class="row mb-2">
              <div class="form-group col-4">
                <label class="form-label">Tanggal Pengembalian</label>
                <input type="date" class="form-control" min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime('+14 days')); ?>" name="tanggal_pengembalian">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Ajukan Peminjam</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>