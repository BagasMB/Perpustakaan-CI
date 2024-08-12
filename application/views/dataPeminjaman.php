<div class="card card-responsive">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Data Peminjaman</h5>
    <a href="<?= base_url(''); ?>" class="btn btn-primary">Laporan</a>
  </div>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table id="myTable" class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Kode Peminjam</th>
            <th>Nama Peminjam</th>
            <th>Tanggal</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $no = 1;
          foreach ($peminjaman as $value) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['kode_peminjaman']; ?></td>
              <td><?= $value['nama']; ?></td>
              <td><?= $value['tanggal_peminjaman']; ?></td>
              <td>
                <a href="<?= base_url('peminjaman/detail/' . $value['kode_peminjaman']); ?>" type="button" class="btn btn-primary btn-sm">
                  <i class="bx bx-info-circle me-2"></i> Detail
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>