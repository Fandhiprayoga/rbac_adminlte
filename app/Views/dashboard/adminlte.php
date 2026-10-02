<?php
$user = $user ?? auth()->user();
$userGroups = $userGroups ?? $user->getGroups();
$userCount = $userCount ?? null;
$roleCount = $roleCount ?? count(config('AuthGroups')->groups);
$permissionCount = $permissionCount ?? count(config('AuthGroups')->permissions);
$roleName = $groupTitle ?? activeGroupTitle();
$groupTitles = array_map(
    static fn (string $group): string => config('AuthGroups')->groups[$group]['title'] ?? ucfirst($group),
    $userGroups
);
?>
<div class="row">
  <div class="col-12">
    <div class="callout callout-info mb-4">
      <h5>Selamat datang, <?= esc($user->username) ?>!</h5>
    </div>
  </div>
</div>

<?php if (activeGroupCan('admin.access')): ?>
<div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-primary">
      <div class="inner">
        <h3><?= $userCount !== null ? number_format($userCount) : '1' ?></h3>
        <p>Total Users</p>
      </div>
      <div class="small-box-icon">
        <i class="bi bi-people-fill"></i>
      </div>
      <?php if (activeGroupCan('users.list')): ?>
      <a href="<?= base_url('admin/users') ?>" class="small-box-footer">
        Lihat detail <i class="bi bi-arrow-right-short"></i>
      </a>
      <?php endif; ?>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-success">
      <div class="inner">
        <h3><?= number_format($roleCount) ?></h3>
        <p>Total Roles</p>
      </div>
      <div class="small-box-icon">
        <i class="bi bi-shield-lock-fill"></i>
      </div>
      <?php if (activeGroupIs('superadmin')): ?>
      <a href="<?= base_url('admin/roles') ?>" class="small-box-footer">
        Lihat detail <i class="bi bi-arrow-right-short"></i>
      </a>
      <?php endif; ?>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-warning">
      <div class="inner">
        <h3><?= number_format($permissionCount) ?></h3>
        <p>Total Permissions</p>
      </div>
      <div class="small-box-icon">
        <i class="bi bi-key-fill"></i>
      </div>
      <?php if (activeGroupIs('superadmin')): ?>
      <a href="<?= base_url('admin/roles/permissions') ?>" class="small-box-footer">
        Lihat detail <i class="bi bi-arrow-right-short"></i>
      </a>
      <?php endif; ?>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-danger">
      <div class="inner">
        <h3><?= number_format(count($userGroups)) ?></h3>
        <p>Keanggotaan</p>
      </div>
      <div class="small-box-icon">
        <i class="bi bi-person-badge-fill"></i>
      </div>
      <a href="<?= base_url('profile') ?>" class="small-box-footer">
        Lihat profil <i class="bi bi-arrow-right-short"></i>
      </a>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Informasi Akun</h3>
        <div class="card-tools">
          <a href="<?= base_url('profile') ?>" class="btn btn-sm btn-outline-primary">Buka profil</a>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table">
          <tbody>
            <tr>
              <th style="width: 140px;">Nama pengguna</th>
              <td><?= esc($user->username) ?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?= esc($user->email) ?></td>
            </tr>
            <tr>
              <th>Role aktif</th>
              <td><span class="badge text-bg-primary"><?= esc($roleName) ?></span></td>
            </tr>
            <tr>
              <th>Keanggotaan</th>
              <td>
                <?php foreach ($groupTitles as $groupTitle): ?>
                  <span class="badge <?= $groupTitle === $roleName ? 'text-bg-primary' : 'text-bg-secondary' ?>"><?= esc($groupTitle) ?></span>
                <?php endforeach; ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Akses Cepat</h3>
      </div>
      <div class="card-body">
        <div class="list-group">
          <?php if (activeGroupCan('users.list')): ?>
          <a href="<?= base_url('admin/users') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="bi bi-people me-3 fs-5 text-primary"></i>
            <div>
              <strong>Manajemen User</strong>
              <small class="d-block text-muted">Kelola akun pengguna</small>
            </div>
          </a>
          <?php endif; ?>
          <?php if (activeGroupIs('superadmin')): ?>
          <a href="<?= base_url('admin/roles') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="bi bi-shield-lock me-3 fs-5 text-success"></i>
            <div>
              <strong>Role &amp; Permission</strong>
              <small class="d-block text-muted">Atur akses sistem</small>
            </div>
          </a>
          <?php endif; ?>
          <?php if (activeGroupCan('admin.settings')): ?>
          <a href="<?= base_url('admin/settings') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="bi bi-gear me-3 fs-5 text-warning"></i>
            <div>
              <strong>Pengaturan</strong>
              <small class="d-block text-muted">Konfigurasi aplikasi</small>
            </div>
          </a>
          <?php endif; ?>
          <a href="<?= base_url('profile') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <i class="bi bi-person me-3 fs-5 text-info"></i>
            <div>
              <strong>Profil Saya</strong>
              <small class="d-block text-muted">Perbarui informasi akun</small>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
