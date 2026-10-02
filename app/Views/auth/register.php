<?= $this->extend('layouts/auth-adminlte') ?>

<?= $this->section('content') ?>
<?php if (! setting('Auth.allowRegistration')): ?>
<p class="login-box-msg text-danger">Registrasi pengguna baru saat ini tidak diizinkan.</p>
<div class="d-grid gap-2">
  <a href="<?= url_to('login') ?>" class="btn btn-primary">Kembali ke Halaman Masuk</a>
</div>
<?php $this->endSection(); return; endif; ?>

<p class="login-box-msg">Pendaftaran Akun Baru</p>

<?php if (session('error') !== null) : ?>
  <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
<?php endif ?>

<?php if (session('errors') !== null) : ?>
  <div class="alert alert-danger" role="alert">
    <?php foreach (session('errors') as $error) : ?>
      <div><?= $error ?></div>
    <?php endforeach ?>
  </div>
<?php endif ?>

<form method="POST" action="<?= url_to('register') ?>" novalidate>
  <?= csrf_field() ?>

  <div class="input-group mb-3">
    <div class="form-floating">
      <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" placeholder="Nama pengguna" autocomplete="username" required autofocus>
      <label for="username">Username</label>
    </div>
    <div class="input-group-text"><span class="bi bi-person"></span></div>
  </div>

  <div class="input-group mb-3">
    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="email@example.com" autocomplete="email" required>
      <label for="email">Email</label>
    </div>
    <div class="input-group-text"><span class="bi bi-envelope"></span></div>
  </div>

  <div class="input-group mb-3">
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" autocomplete="new-password" required>
      <label for="password">Password</label>
    </div>
    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
  </div>

  <div class="input-group mb-3">
    <div class="form-floating">
      <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Konfirmasi password" autocomplete="new-password" required>
      <label for="password_confirm">Konfirmasi Password</label>
    </div>
    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
  </div>

  <div class="d-grid gap-2 mb-3">
    <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
  </div>
</form>

<p class="mb-0 text-center">
  Sudah memiliki akun? <a href="<?= url_to('login') ?>">Masuk</a>
</p>
<?= $this->endSection() ?>
