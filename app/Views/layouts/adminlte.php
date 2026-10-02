<?php
$currentUser = auth()->user();
$userGroups = $currentUser->getGroups();
$siteName = setting('App.siteName') ?? 'CI4 Shield RBAC';
$siteNameShort = setting('App.siteNameShort') ?? 'C4';
$logo = setting('App.siteLogo');
$logoUrl = ! empty($logo) ? base_url($logo) : base_url('adminlte/assets/img/AdminLTELogo.png');
$favicon = setting('App.siteFavicon');
$faviconUrl = ! empty($favicon) ? base_url($favicon) : base_url('adminlte/assets/img/AdminLTELogo.png');
$currentUrl = uri_string();
$isCurrent = static fn (string $path): bool => $currentUrl === $path || str_starts_with($currentUrl, $path . '/');
// ponytail: bg/theme pairs stored as separate settings; validated against AdminLTE bg utility allowlist.
$bgPattern = '/^(bg|text-bg|bg-gradient)-[a-z0-9-]+$/';
$themeSideBar = setting('App.themeSidebarBg') ?? 'bg-body-secondary';
$themeSideBar = preg_match($bgPattern, $themeSideBar) ? $themeSideBar : 'bg-body-secondary';
$themeSideBarTheme = setting('App.themeSidebarTheme') ?? 'dark';
$themeSideBarTheme = in_array($themeSideBarTheme, ['light', 'dark'], true) ? $themeSideBarTheme : 'dark';
$themeNavBar = setting('App.themeNavbarBg') ?? 'bg-body';
$themeNavBar = preg_match($bgPattern, $themeNavBar) ? $themeNavBar : 'bg-body';
$themeNavBarTheme = setting('App.themeNavbarTheme') ?? 'light';
$themeNavBarTheme = in_array($themeNavBarTheme, ['light', 'dark'], true) ? $themeNavBarTheme : 'light';
$themeFootBar = setting('App.themeFooterBg') ?? 'bg-body';
$themeFootBar = preg_match($bgPattern, $themeFootBar) ? $themeFootBar : 'bg-body';
$themeFootBarTheme = setting('App.themeFooterTheme') ?? 'light';
$themeFootBarTheme = in_array($themeFootBarTheme, ['light', 'dark'], true) ? $themeFootBarTheme : 'light';
$themePrimaryColor = setting('App.themePrimaryColor') ?? '';
$themePrimaryColor = preg_match('/^[a-z0-9-]+$/', (string) $themePrimaryColor) ? $themePrimaryColor : '';
$themeMode = setting('App.themeMode') ?? 'system';
$themeMode = in_array($themeMode, ['system', 'light', 'dark'], true) ? $themeMode : 'system';
$themeRadius = setting('App.themeRadius') ?? '4';
$themeRadius = ctype_digit((string) $themeRadius) ? min((int) $themeRadius, 16) : 4;
$themeSidebarWidth = setting('App.themeSidebarWidth') ?? '250';
$themeSidebarWidth = ctype_digit((string) $themeSidebarWidth) ? min((int) $themeSidebarWidth, 320) : 250;
$themeFontSize = setting('App.themeFontSize') ?? '14';
$themeFontSize = in_array((string) $themeFontSize, ['13','13.5','14','14.5','15','15.5','16'], true) ? $themeFontSize : '14';
?>
<!doctype html>
<html lang="id"<?= $themePrimaryColor ? " data-lte-primary=\"{$themePrimaryColor}\"" : '' ?><?= $themeMode !== 'system' ? " data-bs-theme=\"{$themeMode}\"" : '' ?> style="--bs-border-radius: <?= $themeRadius ?>px; --lte-sidebar-width: <?= $themeSidebarWidth ?>px; --bs-body-font-size: <?= $themeFontSize ?>px;">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= esc($title ?? 'Dashboard') ?> | <?= esc($siteName) ?></title>
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
    <link rel="stylesheet" href="<?= base_url('adminlte/css/adminlte-colors.css') ?>" />
    <style>
      .user-initials {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        margin-top: -2px;
        border-radius: 50%;
        background: #0d6efd;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        user-select: none;
      }
      .user-header .user-initials {
        width: 90px;
        height: 90px;
        margin-top: 0;
        border: 3px solid var(--bs-border-color-translucent);
        font-size: 2.5rem;
        z-index: 5;
      }
    </style>
    <?= $this->renderSection('css') ?>
  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
      <nav class="app-header navbar navbar-expand <?= esc($themeNavBar, 'attr') ?>" <?= $themeNavBarTheme ? "data-bs-theme=\"{$themeNavBarTheme}\"" : '' ?>>

        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button" aria-label="Toggle sidebar">
                <i class="bi bi-list"></i>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen" aria-label="Toggle fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="bd-theme" aria-label="Toggle color scheme" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme" style="--bs-dropdown-min-width: 8rem">
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                    <i class="bi bi-sun-fill me-2"></i> Light <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                    <i class="bi bi-moon-fill me-2"></i> Dark <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                    <i class="bi bi-circle-half me-2"></i> Auto <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <span class="user-image user-initials" aria-hidden="true"><?= esc(mb_substr($currentUser->username ?? 'U', 0, 1)) ?></span>
                <span class="d-none d-md-inline"><?= esc($currentUser->username ?? 'Pengguna') ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <li class="user-header text-bg-primary">
                  <span class="user-initials" aria-hidden="true"><?= esc(mb_substr($currentUser->username ?? 'P', 0, 1)) ?></span>
                  <p>
                    <?= esc($currentUser->username ?? 'Pengguna') ?> - <?= esc(activeGroupTitle()) ?>
                  </p>
                </li>
                <li class="user-footer">
                  <a href="<?= base_url('profile') ?>" class="btn btn-outline-secondary">Profile</a>
                  <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger float-end">Sign out</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <aside class="app-sidebar <?= esc($themeSideBar, 'attr') ?> shadow" <?= $themeSideBarTheme ? "data-bs-theme=\"{$themeSideBarTheme}\"" : '' ?>>
        <div class="sidebar-brand">
          <a href="<?= base_url('dashboard') ?>" class="brand-link">
            <img src="<?= esc($logoUrl, 'attr') ?>" alt="<?= esc($siteName) ?>" class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light"><?= esc($siteName) ?></span>
          </a>
        </div>
        <div class="sidebar-wrapper">
          <nav class="mt-2" aria-label="Main navigation">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="false" id="navigation">
              <li class="nav-item">
                <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $isCurrent('dashboard') ? 'active' : '' ?>">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <?php if (activeGroupCan('admin.access')): ?>
              <li class="nav-header">ADMINISTRASI</li>
              <?php if (activeGroupCan('users.list')): ?>
              <li class="nav-item">
                <a href="<?= base_url('admin/users') ?>" class="nav-link <?= $isCurrent('admin/users') ? 'active' : '' ?>">
                  <i class="nav-icon bi bi-people"></i>
                  <p>Manajemen User</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if (activeGroupIs('superadmin')): ?>
              <li class="nav-item <?= $isCurrent('admin/roles') || $isCurrent('admin/roles/permissions') ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= $isCurrent('admin/roles') || $isCurrent('admin/roles/permissions') ? 'active' : '' ?>">
                  <i class="nav-icon bi bi-shield-lock"></i>
                  <p>Role & Permission <i class="nav-arrow bi bi-chevron-right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('admin/roles') ?>" class="nav-link <?= $isCurrent('admin/roles') && ! $isCurrent('admin/roles/permissions') ? 'active' : '' ?>">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Daftar Role</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('admin/roles/permissions') ?>" class="nav-link <?= $isCurrent('admin/roles/permissions') ? 'active' : '' ?>">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Permission Matrix</p>
                    </a>
                  </li>
                </ul>
              </li>
              <?php endif; ?>
              <?php if (activeGroupCan('admin.settings')): ?>
              <li class="nav-item">
                <a href="<?= base_url('admin/settings') ?>" class="nav-link <?= $isCurrent('admin/settings') ? 'active' : '' ?>">
                  <i class="nav-icon bi bi-gear"></i>
                  <p>Pengaturan</p>
                </a>
              </li>
              <?php endif; ?>
              <?php endif; ?>
              <li class="nav-header">AKUN</li>
              <li class="nav-item">
                <a href="<?= base_url('profile') ?>" class="nav-link <?= $isCurrent('profile') ? 'active' : '' ?>">
                  <i class="nav-icon bi bi-person"></i>
                  <p>Profil Saya</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('logout') ?>" class="nav-link">
                  <i class="nav-icon bi bi-box-arrow-right"></i>
                  <p>Keluar</p>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </aside>
      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3"><?= esc($page_title ?? 'Dashboard') ?></h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= esc($page_title ?? 'Dashboard') ?></li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <?php foreach (['success' => 'alert-success', 'error' => 'alert-danger'] as $flashType => $alertClass): ?>
              <?php if ($message = session()->getFlashdata($flashType)): ?>
              <div class="alert <?= $alertClass ?> alert-dismissible fade show" role="alert">
                <?= esc($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php if ($errors = session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul class="mb-0">
                <?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?>
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <?= $content ?? '' ?>
          </div>
        </div>
      </main>
      <footer class="app-footer <?= esc($themeFootBar, 'attr') ?>" <?= $themeFootBarTheme ? "data-bs-theme=\"{$themeFootBarTheme}\"" : '' ?>>
        <div class="float-end d-none d-sm-inline">CI4 Shield RBAC</div>
        <strong>Copyright &copy; <?= date('Y') ?> <?= esc($siteName) ?>.</strong> All rights reserved.
      </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('adminlte/js/adminlte.js') ?>"></script>
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = { scrollbarTheme: 'os-theme-light', scrollbarAutoHide: 'leave', scrollbarClickScroll: true };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        const isMobile = window.innerWidth <= 992;
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && !isMobile) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: { theme: Default.scrollbarTheme, autoHide: Default.scrollbarAutoHide, clickScroll: Default.scrollbarClickScroll },
          });
        }
      });
    </script>
    <?= $this->renderSection('js') ?>
  </body>
</html>
