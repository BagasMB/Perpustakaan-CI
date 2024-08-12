<div class="card card-responsive">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Data Peminjaman <?= $this->session->userdata('nama'); ?></h5>
    <a href="<?= base_url('peminjaman/user/' . $this->session->userdata('id_user')); ?>" class="badge bg-label-primary float-end" type="button">
      <i class="fa-solid fa-person-circle-plus me-1"></i>
      Tambah
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table id="myTable" class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Kode Peminjaman</th>
            <th>Tanggal Peminjaman</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $no = 1;
          foreach ($peminjaman as $value) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['kode_peminjaman']; ?></td>
              <td><?= $value['tanggal_peminjaman']; ?></td>
              <td>
                <a href="<?= base_url('peminjaman/detail/' . $value['kode_peminjaman']); ?>" type="button" class="btn btn-warning btn-sm">
                  <i class="bx bx-info-circle me-2"></i> Info
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>


</div>