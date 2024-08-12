<div class="card card-responsive">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Data Detail Peminjaman #<?= $kode_peminjaman; ?></h5>
    <a href="<?= $this->session->userdata('role') == 'Peminjam' ? base_url('peminjaman') : base_url('prosesPeminjaman'); ?>" class="btn btn-secondary">Kembali</a>
  </div>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Kode Peminjam</th>
            <th>Nama Peminjam</th>
            <th>Tanggal</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $no = 1;
          foreach ($detail as $value) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['kode_peminjaman']; ?></td>
              <td><?= $value['judul']; ?></td>
              <td><?= $value['tanggal_pengembalian']; ?></td>
              <td><span class="badge bg-label-<?= $value['status'] == 'Proses' ? 'warning' : ($value['status'] == 'Dipinjam' ? 'info' : ($value['status'] == 'Dikembalikan' ? 'success' : ($value['status'] == 'Ditolak' ? 'danger' : 'secondary'))); ?>"><?= $value['status']; ?></span></td>

              <?php if ($this->session->userdata('role') != 'Peminjam') : ?>
                <td>
                  <?php if ($value['status'] == 'Dikembalikan') : ?>
                    <!-- Tidak menampilkan tombol apa pun jika status adalah Dikembalikan -->
                  <?php elseif ($value['status'] == 'Dipinjam') : ?>
                    <a href="<?= base_url('peminjaman/kembalikan/' . $value['id_detail_peminjaman'] . '/' . $value['id_buku'] . '/' . $value['kode_peminjaman']); ?>" class="btn btn-primary btn-sm">
                      Kembalikan
                    </a>
                  <?php else: ?>
                    <a href="<?= base_url('peminjaman/persetujuan/' . $value['id_detail_peminjaman'] . '/' . $value['kode_peminjaman']); ?>" class="btn btn-success btn-sm">
                      Persetujuan
                    </a>
                    <?php if ($value['status'] != 'Ditolak') : ?>
                      <a href="<?= base_url('peminjaman/penolakan/' . $value['id_detail_peminjaman'] . '/' . $value['kode_peminjaman']);  ?>" class="btn btn-danger btn-sm">
                        Ditolak
                      </a>
                    <?php endif; ?>
                  <?php endif; ?>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>