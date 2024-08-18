<div class="card card-responsive">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Data User</h5>
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
            <th>Username</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $no = 1;
          foreach ($data_user as $value) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['username']; ?></td>
              <td><?= $value['nama']; ?></td>
              <td><?= $value['email']; ?></td>
              <td><?= $value['alamat']; ?></td>
              <td><?= $value['role']; ?></td>
              <td>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $value['id_user']; ?>">
                  <i class="bx bx-edit-alt me-1"></i>Edit
                </button>
                <a href="<?= base_url('user/reset/' . $value['id_user']); ?>" id="yakin" type="button" class="btn btn-warning btn-sm">
                  <i class="bx bx-refresh me-1"></i>Reset
                </a>
                <?php if ($this->session->userdata('username') != $value['username']) : ?>
                  <a href="<?= base_url('user/hapus/' . $value['id_user']); ?>" id="btn-hapus" type="button" class="btn btn-danger btn-sm">
                    <i class="bx bx-trash me-1"></i>Delete
                  </a>
                <?php endif; ?>
              </td>
            </tr>
            <div class="modal fade" id="modalEdit<?= $value['id_user']; ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Edit Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="<?= base_url('user/edit'); ?>" method="post">
                    <div class="modal-body">
                      <input type="hidden" name="id_user" value="<?= $value['id_user']; ?>">
                      <div class="row mb-2">
                        <div class="col mb-2 text-start">
                          <label class="form-label">UserName <strong class="text-danger">*</strong></label>
                          <input type="text" name="username" class="form-control" value="<?= $value['username']; ?>" placeholder="Enter Username" readonly>
                        </div>
                        <div class="col mb-2 text-start">
                          <label class="form-label">Nama</label>
                          <input type="text" name="nama" class="form-control" value="<?= $value['nama']; ?>" placeholder="Enter Nama" autocomplete="off">
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col mb-2 text-start">
                          <label class="form-label">Email</label>
                          <input type="email" name="email" class="form-control" value="<?= $value['email']; ?>" placeholder="Email" autocomplete="off">
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col mb-2 text-start">
                          <label class="form-label">User Role</label>
                          <select class="form-select" name="role">
                            <option value="Peminjam" <?= $value['role'] == 'Peminjam' ? 'selected' : ''; ?>>Peminjam</option>
                            <option value="Petugas" <?= $value['role'] == 'Petugas' ? 'selected' : ''; ?>>Petugas</option>
                            <option value="Admin" <?= $value['role'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                          </select>
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col mb-2 text-start">
                          <label class="form-label">Alamat</label>
                          <textarea name="alamat" id="alamat" class="form-control" cols="30"><?= $value['alamat']; ?></textarea>
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
          <h5 class="modal-title" id="exampleModalLabel3">Tambah Data User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('user/tambah'); ?>" method="post">
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col mb-2 text-start">
                <label class="form-label">UserName <strong class="text-danger">*</strong></label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username" autocomplete="off">
              </div>
              <div class="col mb-2 text-start form-password-toggle">
                <label class="form-label">Password <strong class="text-danger">*</strong></label>
                <div class="input-group">
                  <input type="password" name="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autocomplete="off">
                  <div class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></div>
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col mb-2 text-start">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Enter Nama" autocomplete="off">
              </div>
              <div class="col mb-2 text-start">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off">
              </div>
            </div>
            <div class="row mb-2">
              <div class="col mb-2 text-start">
                <label class="form-label">User Role</label>
                <select class="form-select" name="role">
                  <option value="Peminjam">Peminjam</option>
                  <option value="Petugas">Petugas</option>
                  <option value="Admin">Admin</option>
                </select>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col mb-2 text-start">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" cols="30"></textarea>
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