<?php
$avatarColors = ['text-bg-primary', 'text-bg-secondary', 'text-bg-success', 'text-bg-danger', 'text-bg-warning', 'text-bg-info', 'text-bg-dark'];
?>
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
      <h3 class="card-title mb-0">Semua user</h3>
    </div>
    <form method="get" action="<?= base_url('admin/users') ?>" class="d-flex gap-2 flex-wrap align-items-center ms-auto">
      <input type="search" name="q" class="form-control form-control-sm" style="width:200px" placeholder="Cari username atau email"
             value="<?= esc($filters['q'] ?? '', 'attr') ?>" aria-label="Cari user">
      <select name="role" class="form-select form-select-sm" style="width:150px" aria-label="Filter role">
        <option value="">Semua role</option>
        <?php foreach (($roles ?? []) as $roleName => $roleConfig): ?>
        <option value="<?= esc($roleName, 'attr') ?>" <?= ($filters['role'] ?? '') === $roleName ? 'selected' : '' ?>>
          <?= esc($roleConfig['title'] ?? ucfirst($roleName)) ?>
        </option>
        <?php endforeach; ?>
      </select>
      <select name="status" class="form-select form-select-sm" style="width:140px" aria-label="Filter status">
        <option value="">Semua status</option>
        <option value="active" <?= ($filters['status'] ?? '') === 'active' ? 'selected' : '' ?>>Aktif</option>
        <option value="inactive" <?= ($filters['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Nonaktif</option>
      </select>
      <button type="submit" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-search"></i> Filter
      </button>
      <?php if (!empty(array_filter($filters ?? []))): ?>
      <a href="<?= base_url('admin/users') ?>" class="btn btn-sm btn-outline-danger">Reset</a>
      <?php endif; ?>
    </form>
  </div>

  <div class="card-body p-0 table-responsive">
    <table class="table table-striped align-middle mb-0">
      <thead>
        <tr>
          <th style="width:48px" class="text-center">#</th>
          <th>Username</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th style="width:80px" class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($users)): ?>
          <?php $no = isset($pager) ? (($pager->getCurrentPage() - 1) * $pager->getPerPage()) + 1 : 1; ?>
          <?php foreach ($users as $index => $user): ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle d-flex align-items-center justify-content-center <?= $avatarColors[$index % count($avatarColors)] ?>" style="width: 32px; height: 32px; font-weight: bold;">
                  <?= esc(strtoupper(substr($user->username, 0, 2))) ?>
                </div>
                <span class="fw-bold"><?= esc($user->username) ?></span>
              </div>
            </td>
            <td><?= esc($user->email) ?></td>
            <td>
              <?php if (!empty($user->groups)): ?>
                <?php foreach ($user->groups as $group): ?>
                  <?php
                    $chipClass = match ($group) {
                        'superadmin' => 'text-bg-danger',
                        'admin'      => 'text-bg-warning',
                        'manager'    => 'text-bg-info',
                        default      => 'text-bg-secondary',
                    };
                  ?>
                  <span class="badge <?= $chipClass ?>"><?= esc(ucfirst($group)) ?></span>
                <?php endforeach; ?>
              <?php else: ?>
                <span class="badge text-bg-light">No Role</span>
              <?php endif; ?>
            </td>
            <td>
              <?php if ($user->active): ?>
                <span class="badge text-bg-success">Aktif</span>
              <?php else: ?>
                <span class="badge text-bg-danger">Nonaktif</span>
              <?php endif; ?>
            </td>
            <td class="text-end">
              <?php
                $canEdit   = activeGroupCan('users.edit');
                $canDelete = activeGroupCan('users.delete') && (int) $user->id !== (int) auth()->id();
              ?>
              <?php if ($canEdit || $canDelete): ?>
              <div class="dropdown">
                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <?php if ($canEdit): ?>
                  <li><a class="dropdown-item" href="<?= base_url('admin/users/edit/' . $user->id) ?>"><i class="bi bi-pencil me-2"></i> Edit</a></li>
                  <?php endif; ?>
                  <?php if ($canDelete): ?>
                  <li>
                    <button class="dropdown-item text-danger" type="button" onclick="if(confirm('Hapus user <?= esc($user->username, 'js') ?>?')) document.getElementById('delete-user-<?= $user->id ?>').submit();">
                      <i class="bi bi-trash me-2"></i> Hapus
                    </button>
                  </li>
                  <?php endif; ?>
                </ul>
              </div>
              <?php endif; ?>
              <?php if ($canDelete): ?>
              <form id="delete-user-<?= $user->id ?>" action="<?= base_url('admin/users/delete/' . $user->id) ?>" method="post" class="d-none">
                <?= csrf_field() ?>
              </form>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="text-center py-4 text-muted">Tidak ada user yang cocok dengan filter.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php if (isset($pager) && !empty($users)): ?>
  <div class="card-footer clearfix">
    <?= $pager->only(['q', 'status', 'role'])->links('default', 'adminlte') ?>
  </div>
  <?php endif; ?>
</div>

