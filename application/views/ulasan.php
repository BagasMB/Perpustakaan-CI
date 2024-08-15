<div class="card card-responsive">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Data User</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table id="myTable" class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Judul Buku</th>
            <th>Nama</th>
            <th>Ulasan</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $no = 1;
          foreach ($ulasan as $value) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['judul']; ?></td>
              <td><?= $value['nama']; ?></td>
              <td><?= $value['ulasan']; ?></td>
              <td>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $value['id_ulasan']; ?>">
                  <i class="bx bx-edit-alt me-2"></i> Edit
                </button>
                <a href="<?= base_url('ulasan/hapus/' . $value['id_ulasan']); ?>" id="btn-hapus" type="button" class="btn btn-danger btn-sm">
                  <i class="bx bx-trash me-2"></i> Delete
                </a>
              </td>
            </tr>
            <div class="modal fade" id="modalEdit<?= $value['id_ulasan']; ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Edit Data Ulasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="<?= base_url('ulasan/edit'); ?>" method="post">
                    <input type="hidden" name="id_ulasan" value="<?= $value['id_ulasan']; ?>">
                    <input type="hidden" name="id_buku" value="<?= $value['id_buku']; ?>">
                    <input type="hidden" name="id_user" value="<?= $value['id_user']; ?>">
                    <div class="modal-body">
                      <div class="mb-2 text-start">
                        <label class="form-label">Ulasan</label>
                        <textarea name="ulasan" class="form-control" autocomplete="off"><?= $value['ulasan']; ?></textarea>
                      </div>
                      <div class="mb-2 text-start">
                        <label class="form-label">Rating</label>
                        <select class="form-select" name="rating">
                          <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <option value="<?= $i; ?>" <?= $value['rating'] == $i ? 'selected' : ''; ?>>
                              <?= str_repeat('⭐', $i); ?>
                            </option>
                          <?php endfor; ?>
                        </select>
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
</div>