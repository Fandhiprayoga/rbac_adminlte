<div class="card">
  <div class="card-header">
    <h3 class="card-title mb-0">Matrix permission per role</h3>
  </div>

  <div class="card-body p-0 table-responsive">
    <table class="table table-striped align-middle mb-0">
      <thead>
        <tr>
          <th>Permission</th>
          <th>Deskripsi</th>
          <?php foreach ($groups as $key => $group): ?>
          <th class="text-center"><?= esc($group['title']) ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($permissions)): ?>
          <?php foreach ($permissions as $permKey => $permDesc): ?>
          <tr>
            <td><span class="fw-bold"><?= esc($permKey) ?></span></td>
            <td><?= esc($permDesc) ?></td>
            <?php foreach ($groups as $groupKey => $group): ?>
            <td class="text-center">
              <?php
                $hasPermission = false;
                foreach ($matrix[$groupKey] ?? [] as $matrixPerm) {
                    if ($matrixPerm === $permKey) {
                        $hasPermission = true;
                        break;
                    }
                    if (str_contains($matrixPerm, '*') && str_starts_with($permKey, str_replace('*', '', $matrixPerm))) {
                        $hasPermission = true;
                        break;
                    }
                }
              ?>
              <?php if ($hasPermission): ?>
                <span class="badge text-bg-success">Ya</span>
              <?php else: ?>
                <span class="badge text-bg-danger">Tidak</span>
              <?php endif; ?>
            </td>
            <?php endforeach; ?>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="<?= 2 + count($groups) ?>" class="text-center py-4 text-muted">Belum ada data permission.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

