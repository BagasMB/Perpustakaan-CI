<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Password</h5>
    </div>
    <div class="card-body">
      <?= form_open_multipart('password') ?>
      <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user'); ?>">
      <div class="row form-password-toggle mb-3">
        <label class="col-sm-3 col-form-label" for="password-lama">Password Lama</label>
        <div class="col-sm-4">
          <div class="input-group input-group-merge">
            <input type="password" class="form-control" id="password-lama" name="password_lama" placeholder="Password Lama" autocomplete="off" aria-describedby="password-lama">
            <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="bx bx-hide"></i></span>
          </div>
          <?= form_error('password_lama', '<small class="text-danger">', '</small>'); ?>
        </div>
      </div>
      <div class="row form-password-toggle mb-3">
        <label class="col-sm-3 col-form-label" for="password-baru">Password Baru</label>
        <div class="col-sm-4">
          <div class="input-group input-group-merge">
            <input type="password" class="form-control" id="password-baru" name="password_baru1" placeholder="Password Baru" autocomplete="off" aria-describedby="password-baru" />
            <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="bx bx-hide"></i></span>
          </div>
          <?= form_error('password_baru1', '<small class="text-danger">', '</small>'); ?>
        </div>
      </div>
      <div class="row form-password-toggle mb-3">
        <label class="col-sm-3 col-form-label" for="cofirm">Konfirmasi Password Baru</label>
        <div class="col-sm-4">
          <div class="input-group input-group-merge">
            <input type="password" class="form-control" id="cofirm" name="password_baru2" placeholder="Konfirmasi Password Baru" autocomplete="off" aria-describedby="" />
            <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="bx bx-hide"></i></span>
          </div>
          <?= form_error('password_baru2', '<small class="text-danger">', '</small>'); ?>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
      <?= form_close(); ?>
    </div>
  </div>
</div>