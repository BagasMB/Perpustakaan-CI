<!-- Basic with Icons -->
<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">My Profile</h5>
    </div>
    <div class="card-body">
      <form action="<?= base_url('myProfile'); ?>" method="post">
        <input type="hidden" class="form-control" name="id_user" value="<?= $this->session->userdata('id_user'); ?>" readonly autocomplete="off" />
        <div class="form-group row">
          <div class="col-sm-6 mb-3">
            <label class="col-sm-2 col-form-label">UserName</label>
            <div class="input-group input-group-merge">
              <input type="text" class="form-control" name="username" value="<?= $this->session->userdata('username'); ?>" readonly autocomplete="off" />
            </div>
            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="col-sm-6 mb-3">
            <label class="col-sm-2 col-form-label">Nama</label>
            <div class="input-group input-group-merge">
              <input type="text" name="nama" class="form-control" value="<?= $this->session->userdata('nama'); ?>" autocomplete="off" />
            </div>
            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="input-group input-group-merge">
              <input type="email" class="form-control" name="email" value="<?= $this->session->userdata('email'); ?>" autocomplete="off" />
            </div>
            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="col-sm-6 mb-3">
            <label class="col-sm-2 col-form-label">Alamat</label>
            <div class="input-group input-group-merge">
              <input type="text" name="alamat" class="form-control" value="<?= $this->session->userdata('alamat'); ?>" autocomplete="off" />
            </div>
            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
      </form>
    </div>
  </div>
</div>