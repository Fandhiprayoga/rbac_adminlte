<?= $this->extend('layouts/auth-adminlte') ?>

<?= $this->section('content') ?>
<p class="login-box-msg"><?= lang('Auth.checkYourEmail') ?></p>

<div class="alert alert-success" role="alert">
  <?= lang('Auth.magicLinkDetails', [setting('Auth.magicLinkLifetime') / 60]) ?>
</div>

<p class="mb-0">
  <a href="<?= url_to('login') ?>">← <?= lang('Auth.backToLogin') ?></a>
</p>
<?= $this->endSection() ?>
