<?= $this->extend('layouts/auth-adminlte') ?>

<?= $this->section('content') ?>
<p class="login-box-msg">Masukkan email untuk menerima tautan masuk aman.</p>

<?php if (session('error') !== null) : ?>
  <div class="alert alert-danger" role="alert"><?= esc(session('error')) ?></div>
<?php endif ?>

<?php if (session('errors') !== null) : ?>
  <div class="alert alert-danger" role="alert">
    <?php if (is_array(session('errors'))) : ?>
      <?php foreach (session('errors') as $error) : ?>
        <div><?= esc($error) ?></div>
      <?php endforeach ?>
    <?php else : ?>
      <div><?= esc(session('errors')) ?></div>
    <?php endif ?>
  </div>
<?php endif ?>

<?php if (session('message') !== null) : ?>
  <div class="alert alert-success" role="alert"><?= session('message') ?></div>
<?php endif ?>

<form method="POST" action="<?= url_to('magic-link') ?>" novalidate>
  <?= csrf_field() ?>

  <div class="input-group mb-3">
    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" value="<?= old('email', auth()->user()->email ?? null) ?>" placeholder="email@example.com" autocomplete="email" required autofocus>
      <label for="email">Email</label>
    </div>
    <div class="input-group-text">
      <span class="bi bi-envelope"></span>
    </div>
  </div>

  <div class="d-grid gap-2">
    <button type="submit" class="btn btn-primary">Kirim tautan masuk</button>
  </div>
</form>

<p class="mb-0 mt-3">
  <a href="<?= url_to('login') ?>">← <?= lang('Auth.backToLogin') ?></a>
</p>
<?= $this->endSection() ?>
