<?php
$siteName = setting('App.siteName') ?? 'CI4 Shield RBAC';
$logo = setting('App.siteLogo');
$logoUrl = ! empty($logo) ? base_url($logo) : base_url('adminlte/assets/img/AdminLTELogo.png');
$favicon = setting('App.siteFavicon');
$faviconUrl = ! empty($favicon) ? base_url($favicon) : base_url('adminlte/assets/img/AdminLTELogo.png');
?>
<!doctype html>
<html lang="id">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= esc($title ?? 'Autentikasi') ?> | <?= esc($siteName) ?></title>
    <script>
      (() => {
        'use strict';
        const root = document.documentElement;
        if (root.getAttribute('data-lte-color-mode') === 'off') {
          return;
        }
        const STORAGE_KEY = 'lte-theme';
        let stored = null;
        try {
          stored = localStorage.getItem(STORAGE_KEY);
        } catch {}
        const authored = root.getAttribute('data-bs-theme');
        let resolved = 'light';
        if (stored === 'dark' || stored === 'light') {
          resolved = stored;
        } else if (authored === 'dark' || authored === 'light') {
          resolved = authored;
        } else if (globalThis.matchMedia('(prefers-color-scheme: dark)').matches) {
          resolved = 'dark';
        }
        root.setAttribute('data-bs-theme', resolved);
        root.style.colorScheme = resolved;
        if (resolved !== authored) {
          root.setAttribute('data-lte-theme-resolved', '');
        }
      })();
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <link rel="icon" href="<?= esc($faviconUrl, 'attr') ?>" type="image/x-icon">
    <link rel="preload" href="<?= base_url('adminlte/css/adminlte.css') ?>" as="style" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" media="print" onload="this.media = 'all'" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= base_url('adminlte/css/adminlte.css') ?>" />
    <?= $this->renderSection('css') ?>
  </head>
  <body class="login-page bg-body-secondary">
    <main class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a href="<?= base_url() ?>" class="link-body-emphasis text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
            <h1 class="mb-0"><b><?= esc($siteName) ?></b></h1>
          </a>
        </div>
        <div class="card-body login-card-body">
          <?= $this->renderSection('content') ?>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('adminlte/js/adminlte.js') ?>"></script>
    <?= $this->renderSection('js') ?>
  </body>
</html>
