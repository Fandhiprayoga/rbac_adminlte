<?= $this->extend('layouts/auth-adminlte') ?>

<?= $this->section('content') ?>
<div class="text-center">
  <div class="mb-3 text-warning">
    <i class="bi bi-exclamation-triangle display-1"></i>
  </div>

  <h4 class="mb-2">Layanan Sedang Dalam Pemeliharaan</h4>
  <p class="text-muted small">
    <?= esc(setting('App.maintenanceMsg') ?? 'Sistem sedang dalam pemeliharaan. Silakan coba beberapa saat lagi.') ?>
  </p>
  <p class="text-muted small mb-4">
    Kami akan segera kembali. Terima kasih atas kesabaran Anda.
  </p>

  <?php if (auth()->loggedIn()): ?>
    <a href="<?= base_url('logout') ?>" class="btn btn-outline-secondary w-100">
      Keluar
    </a>
  <?php else: ?>
    <a href="<?= base_url('login') ?>" class="btn btn-primary w-100">
      Masuk sebagai Administrator
    </a>
  <?php endif; ?>

  <p class="text-muted small mt-4 mb-0">
    <?= esc(setting('App.siteName') ?? 'CI4 Shield RBAC') ?> - v<?= esc(setting('App.siteVersion') ?? '1.0.0') ?>
  </p>
</div>
<?= $this->endSection() ?>
