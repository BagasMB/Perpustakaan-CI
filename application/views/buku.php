<div class="card card-responsive">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Data Buku</h5>
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
            <th>Judul</th>
            <th>Kategori</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Stok</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $no = 1;
          foreach ($buku as $value) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['judul']; ?></td>
              <td><?= $value['nama_kategori']; ?></td>
              <td><?= $value['penulis']; ?></td>
              <td><?= $value['penerbit']; ?></td>
              <td><?= $value['tahun_terbit']; ?></td>
              <td><?= $value['stok']; ?></td>
              <td>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $value['id_buku']; ?>">
                  <i class="bx bx-edit-alt me-2"></i> Edit
                </button>
                <a href="<?= base_url('user/hapus/' . $value['id_kategori']); ?>" id="btn-hapus" type="button" class="btn btn-danger btn-sm">
                  <i class="bx bx-trash me-2"></i> Delete
                </a>
              </td>
            </tr>
            <div class="modal fade" id="modalEdit<?= $value['id_buku']; ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Edit Data Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="<?= base_url('buku/edit'); ?>" method="post">
                    <input type="hidden" name="id_buku" value="<?= $value['id_buku']; ?>">
                    <div class="modal-body">
                      <div class="row">
                        <div class="form-group col-sm-6 mb-2">
                          <label class="form-label">Judul</label>
                          <input type="text" class="form-control" name="judul" value="<?= $value['judul']; ?>" autocomplete="off">
                        </div>
                        <div class="form-group col-sm-6 mb-2">
                          <label class="form-label">Kategori Buku</label>
                          <select class="form-select" name="id_kategori">
                            <?php foreach ($kategori as  $i) : ?>
                              <option value="<?= $i->id_kategori; ?>" <?= $i->id_kategori == $value['id_kategori'] ? 'selected' : '' ?>><?= $i->nama_kategori; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6 mb-2">
                          <label class="form-label">Penulis</label>
                          <input type="text" class="form-control" name="penulis" value="<?= $value['penulis']; ?>" autocomplete="off">
                        </div>
                        <div class="form-group col-sm-6 mb-2">
                          <label class="form-label">Penerbit</label>
                          <input type="text" class="form-control" name="penerbit" value="<?= $value['penerbit']; ?>" autocomplete="off">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6 mb-2">
                          <label class="form-label">Tahun Terbit</label>
                          <input type="number" class="form-control" name="tahun_terbit" value="<?= $value['tahun_terbit']; ?>" autocomplete="off">
                        </div>
                        <div class="form-group col-sm-6 mb-2">
                          <label class="form-label">Stok Buku</label>
                          <input type="number" class="form-control" name="stok" value="<?= $value['stok']; ?>" autocomplete="off">
                        </div>
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
          <h5 class="modal-title" id="exampleModalLabel3">Tambah Data Buku</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('buku/tambah'); ?>" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="form-group col-sm-6 mb-2">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" autocomplete="off">
              </div>
              <div class="form-group col-sm-6 mb-2">
                <label class="form-label">Kategori Buku</label>
                <select class="form-select" name="id_kategori">
                  <?php foreach ($kategori as  $i) : ?>
                    <option value="<?= $i->id_kategori; ?>"><?= $i->nama_kategori; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-6 mb-2">
                <label class="form-label">Penulis</label>
                <input type="text" class="form-control" name="penulis" autocomplete="off">
              </div>
              <div class="form-group col-sm-6 mb-2">
                <label class="form-label">Penerbit</label>
                <input type="text" class="form-control" name="penerbit" autocomplete="off">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-6 mb-2">
                <label class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" name="tahun_terbit" autocomplete="off">
              </div>
              <div class="form-group col-sm-6 mb-2">
                <label class="form-label">Stok Buku</label>
                <input type="number" class="form-control" name="stok" autocomplete="off">
              </div>
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