<div class="row justify-content-center">
  <div class="col-md-8 col-lg-7">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title mb-0">Tambah User Baru</h3>
        <div class="text-muted small">Lengkapi informasi akun dan tentukan role pengguna.</div>
      </div>
      <form action="<?= base_url('admin/users/store') ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label" for="username">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="username" name="username" placeholder="e.g. johndoe" value="<?= old('username') ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="nama@example.com" value="<?= old('email') ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div class="form-text">Minimal 8 karakter.</div>
          </div>

          <div class="mb-3">
            <label class="form-label d-block">Role <span class="text-danger">*</span> <span class="text-muted small">(bisa pilih lebih dari satu)</span></label>
            <?php foreach ($groups as $key => $group): ?>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="role-<?= esc($key) ?>" name="groups[]" value="<?= $key ?>"
                       <?= is_array(old('groups')) && in_array($key, old('groups')) ? 'checked' : '' ?>>
                <label class="form-check-label" for="role-<?= esc($key) ?>">
                  <strong><?= esc($group['title']) ?></strong> &mdash; <?= esc($group['description']) ?>
                </label>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="card-footer d-flex justify-content-end gap-2">
          <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-secondary">Batal</a>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-floppy me-1"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
