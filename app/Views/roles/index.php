<div class="card">
  <div class="card-header">
    <h3 class="card-title mb-0">Semua role</h3>
  </div>

  <div class="card-body p-0 table-responsive">
    <table class="table table-striped align-middle mb-0">
      <thead>
        <tr>
          <th style="width:48px" class="text-center">#</th>
          <th>Role</th>
          <th>Deskripsi</th>
          <th>Permissions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($groups)): ?>
          <?php $no = 1; foreach ($groups as $key => $group): ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td>
              <?php
                $chipClass = match ($key) {
                    'superadmin' => 'text-bg-danger',
                    'admin'      => 'text-bg-warning',
                    'manager'    => 'text-bg-info',
                    default      => 'text-bg-secondary',
                };
              ?>
              <span class="badge <?= $chipClass ?>"><?= esc($group['title']) ?></span>
            </td>
            <td><?= esc($group['description']) ?></td>
            <td>
              <?php if (!empty($matrix[$key])): ?>
                <div class="d-flex flex-wrap gap-1">
                  <?php foreach ($matrix[$key] as $perm): ?>
                    <span class="badge text-bg-light"><?= esc($perm) ?></span>
                  <?php endforeach; ?>
                </div>
              <?php else: ?>
                <span class="text-muted">Tidak ada permission</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-center py-4 text-muted">Belum ada data role.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

