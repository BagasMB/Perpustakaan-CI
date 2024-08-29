<div class="col-12 col-lg-6">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Denda Buku "<?= $denda->judul; ?>"</h5>
      <small class="text-muted float-end">Default label</small>
    </div>
    <div class="card-body">
      <form action="<?= base_url('peminjaman/bayardenda'); ?>" method="post">
        <input type="hidden" name="id_denda" value="<?= $denda->id_denda; ?>">
        <div class="row">
          <div class="mb-3 col-md-6">
            <label for="total_denda" class="form-label">Total Denda</label>
            <input type="text" class="form-control" name="total_denda" readonly id="total_denda" value="<?= $denda->total_denda; ?>" autocomplete="off">
          </div>
          <div class="mb-3 col-md-6">
            <label for="Sudah_dibayar" class="form-label">Sudah Dibayar</label>
            <input type="text" class="form-control" name="sudah_dibayar" readonly id="Sudah_dibayar" value="<?= $denda->sudah_dibayar; ?>" autocomplete="off">
          </div>
        </div>
        <div class="row">
          <div class="mb-3 col-md-6">
            <label for="sisa_denda" class="form-label">Sisa Denda</label>
            <input type="text" class="form-control" name="sisa_denda" readonly id="sisa_denda" value="<?= $denda->total_denda - $denda->sudah_dibayar; ?>" autocomplete="off">
          </div>
          <div class="mb-3 col-md-6">
            <label for="denda" class="form-label">Bayar Denda</label>
            <input type="text" class="form-control" name="bayar_denda" id="denda" <?= $denda->status_denda == 'Lunas' ? 'readonly' : ''; ?> autocomplete="off">
          </div>
        </div>
        <?php if ($this->session->userdata('role') != 'Peminjam') : ?>
          <button type="submit" class="btn btn-<?= $denda->status_denda == 'Lunas' ? 'success' : 'primary'; ?>" <?= $denda->status_denda == 'Lunas' ? 'disabled' : ''; ?>><?= $denda->status_denda == 'Lunas' ? 'Lunas' : 'Bayar'; ?></button>
          <a href="<?= base_url('prosesPeminjaman'); ?>" class="btn btn-secondary">Kembali</a>
        <?php endif; ?>
      </form>
    </div>
  </div>
</div>