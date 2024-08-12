<div class="card card-responsive">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Data Kategori Buku</h5>
    <span class="badge bg-label-primary float-end" type="button" data-bs-toggle="modal" data-bs-target="#modalTambah">
      <i class="fa-solid fa-person-circle-plus me-1"></i>
      Tambah
    </span>
  </div>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table id="myTable" class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Kategori</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $no = 1;
          foreach ($kategori as $value) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['nama_kategori']; ?></td>
              <td>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $value['id_kategori']; ?>">
                  <i class="bx bx-edit-alt me-2"></i> Edit
                </button>
                <a href="<?= base_url('user/hapus/' . $value['id_kategori']); ?>" id="btn-hapus" type="button" class="btn btn-danger btn-sm">
                  <i class="bx bx-trash me-2"></i> Delete
                </a>
              </td>
            </tr>
            <div class="modal fade" id="modalEdit<?= $value['id_kategori']; ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Edit Data Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="<?= base_url('kategori/edit'); ?>" method="post">
                    <input type="hidden" name="id_kategori" value="<?= $value['id_kategori']; ?>">
                    <div class="modal-body">
                      <div class="form-group">
                        <div class="form-label">Nama Kategori</div>
                        <input type="text" class="form-control" name="nama_kategori" value="<?= $value['nama_kategori']; ?>" autocomplete="off">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="save" class="btn btn-primary">Save</button>
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


  <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel3">Tambah Data Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('kategori/tambah'); ?>" method="post">
          <div class="modal-body">
            <div class="form-group">
              <div class="form-label">Nama Kategori</div>
              <input type="text" class="form-control" name="nama_kategori" autocomplete="off">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>