<div class="card card-responsive">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Data Peminjaman</h5>
    <button data-bs-toggle="modal" data-bs-target="#modalLaporan" class="btn btn-danger"><i class="bx bx-printer me-1"></i> Laporan</button>
  </div>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table id="myTable" class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Kode Peminjam</th>
            <th>Nama Peminjam</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
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
              <td><?= $value['tanggal_pengembalian']; ?></td>
              <td>
                <a href="<?= base_url('peminjaman/detail/' . $value['kode_peminjaman']); ?>" type="button" class="btn btn-primary btn-sm">
                  <i class="bx bx-info-circle me-1"></i> Detail
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="modalLaporan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Laporan Peminjaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('laporan'); ?>" method="post" target="_blank">
        <div class="modal-body">
          <div class="form-group mb-3">
            <label class="form-label">Nama</label>
            <select class="form-select" name="id_user">
              <option value="">-- Pilih --</option>
              <?php foreach ($user as $value) : ?>
                <option value="<?= $value['id_user']; ?>"><?= $value['nama']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="row mb-2">
            <div class="col mb-2 text-start">
              <label class="form-label">Tanggal Awal</label>
              <input type="date" name="tanggal_awal" class="form-control" required autocomplete="off">
            </div>
            <div class="col mb-2 text-start form-password-toggle">
              <label class="form-label">Tanggal Akhir</label>
              <input type="date" name="tanggal_akhir" class="form-control" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="save" class="btn btn-primary">Laporan</button>
        </div>
      </form>
    </div>
  </div>
</div>