<?= $this->extend('layouts/auth-adminlte') ?>

<?= $this->section('content') ?>
<p class="login-box-msg">Silakan masuk ke dashboard Anda.</p>

<?php if (session('error') !== null) : ?>
  <div class="alert alert-danger" role="alert">
    <?= session('error') ?>
  </div>
<?php endif ?>

<?php if (session('errors') !== null) : ?>
  <div class="alert alert-danger" role="alert">
    <?php foreach (session('errors') as $error) : ?>
      <div><?= $error ?></div>
    <?php endforeach ?>
  </div>
<?php endif ?>

<?php if (session('message') !== null) : ?>
  <div class="alert alert-success" role="alert">
    <?= session('message') ?>
  </div>
<?php endif ?>

<form method="POST" action="<?= url_to('login') ?>" novalidate>
  <?= csrf_field() ?>

  <div class="input-group mb-3">
    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" placeholder="email@example.com" autocomplete="email" required autofocus>
      <label for="email">Email</label>
    </div>
    <div class="input-group-text">
      <span class="bi bi-envelope"></span>
    </div>
  </div>

  <div class="input-group mb-3">
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="••••••••••" autocomplete="current-password" required>
      <label for="password">Password</label>
    </div>
    <div class="input-group-text">
      <span class="bi bi-lock-fill"></span>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-8 d-inline-flex align-items-center">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember-me" <?php if (old('remember')): ?>checked<?php endif ?>>
        <label class="form-check-label" for="remember-me">
          Tetap Masuk
        </label>
      </div>
    </div>
    <div class="col-4">
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Masuk</button>
      </div>
    </div>
  </div>
</form>

<p class="mb-1">
  <a href="<?= url_to('magic-link') ?>">Lupa Kata Sandi?</a>
</p>

<?php if (setting('Auth.allowRegistration')): ?>
<p class="mb-0">
  <a href="<?= url_to('register') ?>" class="text-center">Belum memiliki akun? Daftar</a>
</p>
<?php endif ?>
<?= $this->endSection() ?>
