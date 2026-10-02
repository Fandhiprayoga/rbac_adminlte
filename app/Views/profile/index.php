<?php $currentUser = auth()->user(); ?>

<div class="row g-3">
  <div class="col-lg-4">
    <div class="card card-primary card-outline" aria-label="Ringkasan profil">
      <div class="card-body text-center py-4">
        <div class="rounded-circle d-inline-flex align-items-center justify-content-center text-bg-primary mb-3" style="width:96px;height:96px;font-size:32px;font-weight:600" aria-hidden="true">
          <?= esc(strtoupper(substr($currentUser->username, 0, 1))) ?>
        </div>
        <div class="fs-5 fw-semibold"><?= esc($currentUser->username) ?></div>
        <div class="text-muted small text-break"><?= esc($currentUser->email) ?></div>
        <div class="mt-3">
                  <label class="form-label small mb-1" for="active-group-select">Role Aktif</label>
                  <form action="<?= base_url('switch-group') ?>" method="post" class="d-flex gap-2">
            <?= csrf_field() ?>
                    <input type="hidden" name="return" value="profile">
                    <select name="group" id="active-group-select" class="form-select form-select-sm">
                      <?php foreach ($currentUser->getGroups() as $group): ?>
                        <option value="<?= esc($group, 'attr') ?>" <?= $group === activeGroup() ? 'selected' : '' ?>>
                          <?= esc(config('AuthGroups')->groups[$group]['title'] ?? ucfirst($group)) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-sm btn-outline-primary">Ganti</button>
                  </form>
                </div>
        <div class="d-flex flex-wrap gap-1 justify-content-center mt-3">
          <?php foreach ($currentUser->getGroups() as $group): ?>
            <span class="badge <?= $group === activeGroup() ? 'text-bg-primary' : 'text-bg-info' ?>">
              <?= esc(config('AuthGroups')->groups[$group]['title'] ?? ucfirst($group)) ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-8">
    <div class="card" aria-labelledby="profile-form-title">
      <div class="card-header">
        <h3 class="card-title mb-0" id="profile-form-title">Informasi pribadi</h3>
      </div>
      <form action="<?= base_url('profile/update') ?>" method="post">
        <?= csrf_field() ?>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="username">Username <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="username" name="username"
                     value="<?= esc(old('username', $currentUser->username), 'attr') ?>" minlength="3" maxlength="30" autocomplete="username" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="email">Email</label>
              <input type="email" class="form-control" id="email" value="<?= esc($currentUser->email, 'attr') ?>" disabled>
              <div class="form-text">Email tidak dapat diubah.</div>
            </div>
          </div>

          <div class="mt-3">
            <label class="form-label" for="password">Password baru</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" autocapitalize="off" spellcheck="false">
            <div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
          </div>
        </div>

        <div class="card-footer d-flex justify-content-end gap-2">
          <button type="reset" class="btn btn-outline-secondary">Batalkan</button>
          <button type="submit" class="btn btn-primary">Simpan perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
