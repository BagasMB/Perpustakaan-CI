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

              <?php if ($value['status'] == 'Dikembalikan') : ?>
                <?php if ($this->session->userdata('role') == 'Peminjam') : ?>
                  <td>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalUlasan<?= $value['id_detail_peminjaman']; ?>">Ulasan</button>
                  </td>
                <?php endif; ?>
              <?php elseif ($this->session->userdata('role') != 'Peminjam') : ?>
                <td>
                  <?php if ($value['status'] == 'Dipinjam') : ?>
                    <a href="<?= base_url('peminjaman/kembalikan/' . $value['id_detail_peminjaman'] . '/' . $value['id_buku'] . '/' . $value['kode_peminjaman']); ?>" id="yakin" class="btn btn-primary btn-sm">
                      Kembalikan
                    </a>
                  <?php else : ?>
                    <a href="<?= base_url('peminjaman/persetujuan/' . $value['id_detail_peminjaman'] . '/' . $value['kode_peminjaman']); ?>" id="yakin" class="btn btn-success btn-sm">
                      Persetujuan
                    </a>
                    <?php if ($value['status'] != 'Ditolak') : ?>
                      <a href="<?= base_url('peminjaman/penolakan/' . $value['id_detail_peminjaman'] . '/' . $value['kode_peminjaman']); ?>" id="yakin" class="btn btn-danger btn-sm">
                        Ditolak
                      </a>
                    <?php endif; ?>
                  <?php endif; ?>
                </td>
              <?php endif; ?>
            </tr>

            <div class="modal fade" id="modalUlasan<?= $value['id_detail_peminjaman']; ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Ulasan Buku <?= $value['judul']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="<?= base_url('ulasan/simpan'); ?>" method="post">
                    <input type="hidden" value="<?= $value['id_buku']; ?>" name="id_buku">
                    <input type="hidden" value="<?= $value['id_user']; ?>" name="id_user">
                    <div class="modal-body">
                      <div class="mb-2 text-start">
                        <label class="form-label">Ulasan</label>
                        <textarea name="ulasan" class="form-control" autocomplete="off"></textarea>
                      </div>
                      <div class="mb-2 text-start">
                        <label class="form-label">Rating</label>
                        <select class="form-select" name="rating">
                          <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <option value="<?= $i; ?>">
                              <?= str_repeat('⭐', $i); ?>
                            </option>
                          <?php endfor; ?>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>