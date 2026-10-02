<?php if (activeGroupCan('users.create')): ?>
<a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary btn-sm">
  <i class="bi bi-plus-lg me-1"></i> Tambah User
</a>
<?php endif; ?>
