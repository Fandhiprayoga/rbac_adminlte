<div class="row justify-content-center">
  <div class="col-md-8 col-lg-7">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title mb-0">Edit User: <?= esc($user_edit->username) ?></h3>
        <div class="text-muted small">Perbarui informasi akun dan role pengguna.</div>
      </div>
      <form action="<?= base_url('admin/users/update/' . $user_edit->id) ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label" for="username">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="username" name="username"
                   value="<?= old('username', $user_edit->username) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?= old('email', $user_edit->email) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <div class="form-text">Kosongkan jika tidak ingin mengubah password. Minimal 8 karakter.</div>
          </div>

          <?php if (activeGroupCan('users.manage-roles')): ?>
          <div class="mb-3">
            <label class="form-label d-block">Role <span class="text-muted small">(bisa pilih lebih dari satu)</span></label>
            <?php foreach ($groups as $key => $group): ?>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="role-<?= esc($key) ?>" name="groups[]" value="<?= $key ?>"
                       <?= in_array($key, $userGroups) ? 'checked' : '' ?>>
                <label class="form-check-label" for="role-<?= esc($key) ?>">
                  <strong><?= esc($group['title']) ?></strong> &mdash; <?= esc($group['description']) ?>
                </label>
              </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>

        <div class="card-footer d-flex justify-content-end gap-2">
          <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-secondary">Batal</a>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-floppy me-1"></i> Perbarui
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
