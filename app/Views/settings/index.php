<?php
/** @var array $settings */
/** @var array $groups */
/** @var string $activeTab */

$s = function (string $key) use ($settings) {
    return esc($settings[$key] ?? '');
};
?>

<style>
  .brand-preview {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 72px;
    padding: 8px;
    margin-bottom: 8px;
    border: 1px solid var(--bs-border-color);
    border-radius: 8px;
    background: var(--bs-tertiary-bg);
  }
  .brand-preview img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
  }
  .brand-preview--favicon img {
    max-height: 40px;
    max-width: 40px;
  }
  .brand-preview .badge {
    position: absolute;
    top: 6px;
    right: 6px;
  }
</style>

<div class="row">
  <div class="col-12">
    <ul class="nav nav-pills mb-4 overflow-x-auto flex-nowrap" id="settingsTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link text-nowrap <?= $activeTab === 'general' ? 'active' : '' ?>" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="<?= $activeTab === 'general' ? 'true' : 'false' ?>">Umum</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link text-nowrap <?= $activeTab === 'appearance' ? 'active' : '' ?>" id="appearance-tab" data-bs-toggle="tab" data-bs-target="#appearance" type="button" role="tab" aria-controls="appearance" aria-selected="<?= $activeTab === 'appearance' ? 'true' : 'false' ?>">Tampilan</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link text-nowrap <?= $activeTab === 'auth' ? 'active' : '' ?>" id="auth-tab" data-bs-toggle="tab" data-bs-target="#auth" type="button" role="tab" aria-controls="auth" aria-selected="<?= $activeTab === 'auth' ? 'true' : 'false' ?>">Autentikasi</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link text-nowrap <?= $activeTab === 'mail' ? 'active' : '' ?>" id="mail-tab" data-bs-toggle="tab" data-bs-target="#mail" type="button" role="tab" aria-controls="mail" aria-selected="<?= $activeTab === 'mail' ? 'true' : 'false' ?>">Email</button>
      </li>
    </ul>

    <div class="tab-content" id="settingsTabsContent">

      <!-- ======================== TAB: UMUM ======================== -->
      <div class="tab-pane fade <?= $activeTab === 'general' ? 'show active' : '' ?>" id="general" role="tabpanel" aria-labelledby="general-tab">
        <div class="d-flex flex-column gap-4">
          <section>
            <form action="<?= base_url('admin/settings/update/general') ?>" method="post">
              <?= csrf_field() ?>
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title mb-0">Pengaturan Umum</h3>
                </div>
                <div class="card-body">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="site_name" class="form-label">Nama Aplikasi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="site_name" name="site_name"
                               value="<?= old('site_name', $s('App.siteName')) ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="site_name_short" class="form-label">Nama Pendek</label>
                        <input type="text" class="form-control" id="site_name_short" name="site_name_short"
                               value="<?= old('site_name_short', $s('App.siteNameShort')) ?>" maxlength="10">
                        <div class="form-text">Maks 10 karakter, ditampilkan saat sidebar diminimalkan.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                        <label for="site_description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="site_description" name="site_description" rows="2"><?= old('site_description', $s('App.siteDescription')) ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="mb-3">
                        <label for="site_footer" class="form-label">Teks Footer</label>
                        <input type="text" class="form-control" id="site_footer" name="site_footer"
                               value="<?= old('site_footer', $s('App.siteFooter')) ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="site_version" class="form-label">Versi</label>
                        <input type="text" class="form-control" id="site_version" name="site_version"
                               value="<?= old('site_version', $s('App.siteVersion')) ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">
                    <i class="bi bi-floppy me-1"></i> Simpan
                  </button>
                </div>
              </div>
            </form>
          </section>

          <section>
            <form action="<?= base_url('admin/settings/update/branding') ?>" method="post" enctype="multipart/form-data">
              <?= csrf_field() ?>
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title mb-0">Branding</h3>
                </div>
                <div class="card-body">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Logo Aplikasi</label>
                        <?php
                          $currentLogo = $settings['App.siteLogo'] ?? '';
                          $logoUrl = ! empty($currentLogo) ? base_url($currentLogo) : base_url('assets/img/stisla-fill.svg');
                        ?>
                        <div class="brand-preview">
                          <img src="<?= $logoUrl ?>" alt="Current Logo" id="logoPreview">
                          <?php if (empty($currentLogo)): ?>
                            <span class="badge text-bg-secondary">Default</span>
                          <?php endif; ?>
                        </div>
                        <input type="file" class="form-control" id="site_logo" name="site_logo" accept="image/*"
                               onchange="previewImage(this, 'logoPreview')">
                        <div class="form-text">PNG, JPG, SVG, WebP. Maks 2MB.</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Favicon</label>
                        <?php
                          $currentFavicon = $settings['App.siteFavicon'] ?? '';
                          $faviconUrl = ! empty($currentFavicon) ? base_url($currentFavicon) : base_url('assets/img/stisla-fill.svg');
                        ?>
                        <div class="brand-preview brand-preview--favicon">
                          <img src="<?= $faviconUrl ?>" alt="Current Favicon" id="faviconPreview">
                          <?php if (empty($currentFavicon)): ?>
                            <span class="badge text-bg-secondary">Default</span>
                          <?php endif; ?>
                        </div>
                        <input type="file" class="form-control" id="site_favicon" name="site_favicon" accept="image/*,.ico"
                               onchange="previewImage(this, 'faviconPreview')">
                        <div class="form-text">PNG, ICO, SVG, WebP. Maks 1MB.</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">Upload Branding</button>
                </div>
              </div>
            </form>
          </section>

          <section>
            <form action="<?= base_url('admin/settings/reset') ?>" method="post"
                  onsubmit="return confirm('Reset pengaturan Umum & Branding ke default?')">
              <?= csrf_field() ?>
              <input type="hidden" name="tab" value="general">
              <button type="submit" class="btn btn-danger btn-sm">Reset ke Default</button>
            </form>
          </section>
        </div>
      </div>

      <!-- ======================== TAB: TAMPILAN ======================== -->
      <div class="tab-pane fade <?= $activeTab === 'appearance' ? 'show active' : '' ?>" id="appearance" role="tabpanel" aria-labelledby="appearance-tab">
        <?php
        $bootstrapBg = [
            'bg-primary' => 'Primary', 'bg-secondary' => 'Secondary', 'bg-success' => 'Success',
            'bg-danger' => 'Danger', 'bg-warning' => 'Warning', 'bg-info' => 'Info',
            'bg-light' => 'Light', 'bg-dark' => 'Dark', 'bg-body' => 'Body',
            'bg-body-secondary' => 'Body secondary', 'bg-body-tertiary' => 'Body tertiary',
            'bg-white' => 'White', 'bg-black' => 'Black', 'bg-transparent' => 'Transparent',
        ];
        $paletteColors = ['orange', 'amber', 'olive', 'teal', 'sky', 'indigo', 'violet', 'fuchsia', 'pink', 'navy', 'steel', 'slate', 'graphite', 'midnight'];
        $bgOptions = $bootstrapBg;
        foreach ($paletteColors as $c) {
            $bgOptions['text-bg-' . $c] = ucfirst($c) . ' (palette)';
        }
        ?>
        <div class="d-flex flex-column gap-4">
          <section>
            <form id="theme-settings" action="<?= base_url('admin/settings/update/appearance') ?>" method="post">
              <?= csrf_field() ?>
              <div class="row g-4">
                <div class="col-lg-6">
                  <div class="card card-primary card-outline mb-4">
                    <div class="card-header"><h3 class="card-title mb-0">Warna utama</h3></div>
                    <div class="card-body">
                      <div class="d-flex flex-wrap gap-2 mb-3" aria-label="Pilih warna utama">
                        <?php foreach (['#1ABB9C' => 'Teal', '#066fd1' => 'Biru', '#4263eb' => 'Indigo', '#ae3ec9' => 'Ungu', '#d6336c' => 'Merah muda', '#d63939' => 'Merah', '#f76707' => 'Oranye', '#f59f00' => 'Kuning', '#2fb344' => 'Hijau', '#17a2b8' => 'Sian', '#0f1623' => 'Hitam'] as $color => $label): ?>
                          <button type="button" class="btn rounded-circle p-0" style="width:32px;height:32px;background:<?= $color ?>" data-theme-color="<?= $color ?>" title="<?= $label ?>" aria-label="<?= $label ?>"></button>
                        <?php endforeach; ?>
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="theme_primary">Warna kustom</label>
                        <div class="input-group">
                          <input type="color" class="form-control form-control-color" id="theme_primary_picker" value="<?= esc(old('theme_primary', $s('App.themePrimary')), 'attr') ?>" aria-label="Pilih warna kustom">
                          <input type="text" id="theme_primary" name="theme_primary" class="form-control" value="<?= esc(old('theme_primary', $s('App.themePrimary')), 'attr') ?>" pattern="^#[0-9A-Fa-f]{6}$" maxlength="7" required>
                        </div>
                      </div>
                      <div class="mb-0">
                        <label class="form-label" for="theme_primary_color">Palette utama (data-lte-primary)</label>
                        <select class="form-select" id="theme_primary_color" name="theme_primary_color">
                          <option value="">— Biru bawaan Bootstrap —</option>
                          <?php foreach ($paletteColors as $c): ?>
                          <option value="<?= $c ?>" <?= old('theme_primary_color', $s('App.themePrimaryColor')) === $c ? 'selected' : '' ?>><?= ucfirst($c) ?></option>
                          <?php endforeach; ?>
                        </select>
                        <div class="form-text">Rewire komponen Bootstrap (tombol, link, checkbox) ke warna palette.</div>
                      </div>
                    </div>
                  </div>

                  <div class="card card-primary card-outline mb-4">
                    <div class="card-header"><h3 class="card-title mb-0">Mode</h3></div>
                    <div class="card-body">
                      <div class="btn-group w-100" role="group" aria-label="Mode tampilan">
                        <?php foreach (['system' => 'Sistem', 'light' => 'Terang', 'dark' => 'Gelap'] as $value => $label): ?>
                          <input type="radio" class="btn-check" name="theme_mode" id="mode_<?= $value ?>" value="<?= $value ?>" <?= old('theme_mode', $s('App.themeMode')) === $value ? 'checked' : '' ?>>
                          <label class="btn btn-outline-secondary" for="mode_<?= $value ?>"><?= $label ?></label>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>

                  <div class="card card-primary card-outline mb-4">
                    <div class="card-header"><h3 class="card-title mb-0">Bentuk &amp; ukuran</h3></div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="form-label" for="theme_radius">Radius (<span id="radius-out"><?= esc(old('theme_radius', $s('App.themeRadius')), 'attr') ?></span>px)</label>
                        <input type="range" class="form-range" id="theme_radius" name="theme_radius" min="0" max="16" step="1" value="<?= esc(old('theme_radius', $s('App.themeRadius')), 'attr') ?>" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="theme_sidebar_width">Lebar sidebar (<span id="sw-out"><?= esc(old('theme_sidebar_width', $s('App.themeSidebarWidth')), 'attr') ?></span>px)</label>
                        <input type="range" class="form-range" id="theme_sidebar_width" name="theme_sidebar_width" min="200" max="320" step="4" value="<?= esc(old('theme_sidebar_width', $s('App.themeSidebarWidth')), 'attr') ?>" required>
                      </div>
                      <div class="mb-0">
                        <label class="form-label" for="theme_font_size">Ukuran font</label>
                        <select class="form-select" id="theme_font_size" name="theme_font_size" required>
                          <?php foreach (['13', '13.5', '14', '14.5', '15', '15.5', '16'] as $fs): ?>
                          <option value="<?= $fs ?>" <?= (string) old('theme_font_size', $s('App.themeFontSize')) === $fs ? 'selected' : '' ?>><?= $fs ?>px</option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <?php
                  $regions = [
                      ['sidebar', 'Sidebar', 'App.themeSidebarBg', 'App.themeSidebarTheme', 'bg-body-secondary', 'dark'],
                      ['navbar', 'Navbar', 'App.themeNavbarBg', 'App.themeNavbarTheme', 'bg-body', 'light'],
                      ['footer', 'Footer', 'App.themeFooterBg', 'App.themeFooterTheme', 'bg-body', 'light'],
                  ];
                  foreach ($regions as [$key, $label, $bgKey, $themeKey, $bgDefault, $themeDefault]):
                  ?>
                  <div class="card card-primary card-outline mb-4">
                    <div class="card-header"><h3 class="card-title mb-0"><?= $label ?> theme</h3></div>
                    <div class="card-body">
                      <div class="row g-3">
                        <div class="col-sm-6">
                          <label class="form-label" for="theme_<?= $key ?>_theme">Color mode</label>
                          <select class="form-select" id="theme_<?= $key ?>_theme" name="theme_<?= $key ?>_theme">
                            <?php foreach (['light' => 'Light', 'dark' => 'Dark'] as $v => $l): ?>
                            <option value="<?= $v ?>" <?= old("theme_{$key}_theme", $s($themeKey) ?: $themeDefault) === $v ? 'selected' : '' ?>><?= $l ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-sm-6">
                          <label class="form-label" for="theme_<?= $key ?>_bg">Background</label>
                          <select class="form-select" id="theme_<?= $key ?>_bg" name="theme_<?= $key ?>_bg">
                            <?php foreach ($bgOptions as $v => $l): ?>
                            <option value="<?= $v ?>" <?= old("theme_{$key}_bg", $s($bgKey) ?: $bgDefault) === $v ? 'selected' : '' ?>><?= $l ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>

                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <h3 class="card-title mb-0">Pratinjau langsung</h3>
                    </div>
                    <div class="card-body">
                      <div class="border rounded p-3 mb-3" style="background: var(--bs-body-bg); color: var(--bs-body-color);">
                        <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                          <span class="fw-bold">Menu utama</span>
                          <span class="text-muted">Dashboard</span>
                        </div>
                        <strong>Tampilan aplikasi</strong>
                        <p class="text-muted small">Warna, kontrol, dan bentuk komponen.</p>
                        <div class="d-flex gap-2">
                          <span class="btn btn-primary">Utama</span>
                          <span class="btn btn-outline-secondary">Sekunder</span>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end gap-2">
                      <button type="reset" class="btn btn-outline-secondary">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </section>

          <section>
            <form id="theme-settings-reset" action="<?= base_url('admin/settings/reset') ?>" method="post"
                  onsubmit="return confirm('Reset pengaturan Tampilan ke default?')">
              <?= csrf_field() ?>
              <input type="hidden" name="tab" value="appearance">
              <button type="submit" class="btn btn-danger btn-sm">Reset ke Default</button>
            </form>
          </section>
        </div>
      </div>

      <!-- ======================== TAB: AUTENTIKASI ======================== -->
      <div class="tab-pane fade <?= $activeTab === 'auth' ? 'show active' : '' ?>" id="auth" role="tabpanel" aria-labelledby="auth-tab">
        <div class="d-flex flex-column gap-4">
          <section>
            <form action="<?= base_url('admin/settings/update/auth') ?>" method="post">
              <?= csrf_field() ?>
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title mb-0">Pengaturan Autentikasi</h3>
                </div>
                <div class="card-body">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="auth_allow_registration" class="form-label">Registrasi Publik</label>
                        <?php $reg = $settings['Auth.allowRegistration'] ?? 'true'; ?>
                        <select class="form-select" id="auth_allow_registration" name="auth_allow_registration">
                          <option value="true" <?= $reg === 'true' ? 'selected' : '' ?>>Diizinkan</option>
                          <option value="false" <?= $reg === 'false' ? 'selected' : '' ?>>Ditutup</option>
                        </select>
                        <div class="form-text">Izinkan pengunjung membuat akun baru.</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="auth_allow_magic_link" class="form-label">Login Magic Link</label>
                        <?php $magic = $settings['Auth.allowMagicLinkLogins'] ?? 'false'; ?>
                        <select class="form-select" id="auth_allow_magic_link" name="auth_allow_magic_link">
                          <option value="true" <?= $magic === 'true' ? 'selected' : '' ?>>Aktif</option>
                          <option value="false" <?= $magic === 'false' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                        <div class="form-text">Izinkan login menggunakan link yang dikirim ke email.</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="auth_allow_remembering" class="form-label">Fitur "Ingat Saya"</label>
                        <?php $rem = $settings['Auth.sessionConfig']['allowRemembering'] ?? 'true'; ?>
                        <select class="form-select" id="auth_allow_remembering" name="auth_allow_remembering">
                          <option value="true" <?= $rem === 'true' ? 'selected' : '' ?>>Aktif</option>
                          <option value="false" <?= $rem === 'false' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                        <div class="form-text">Tampilkan opsi "Ingat Saya" di halaman login.</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="auth_remember_length" class="form-label">Durasi "Ingat Saya" (Hari)</label>
                        <?php
                          $remLen = $settings['Auth.sessionConfig']['rememberLength'] ?? (30 * 24 * 60 * 60);
                          $remDays = $remLen / (24 * 60 * 60);
                        ?>
                        <input type="number" class="form-control" id="auth_remember_length" name="auth_remember_length"
                               value="<?= old('auth_remember_length', $remDays) ?>" min="1" max="365">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </form>
          </section>

          <section>
            <form action="<?= base_url('admin/settings/reset') ?>" method="post"
                  onsubmit="return confirm('Reset pengaturan Autentikasi ke default?')">
              <?= csrf_field() ?>
              <input type="hidden" name="tab" value="auth">
              <button type="submit" class="btn btn-danger btn-sm">Reset ke Default</button>
            </form>
          </section>
        </div>
      </div>

      <!-- ======================== TAB: EMAIL ======================== -->
      <div class="tab-pane fade <?= $activeTab === 'mail' ? 'show active' : '' ?>" id="mail" role="tabpanel" aria-labelledby="mail-tab">
        <div class="d-flex flex-column gap-4">
          <section>
            <form action="<?= base_url('admin/settings/update/mail') ?>" method="post">
              <?= csrf_field() ?>
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title mb-0">Pengaturan Email</h3>
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <label for="mail_protocol" class="form-label">Protokol</label>
                    <?php $proto = $settings['Mail.protocol'] ?? 'smtp'; ?>
                    <select class="form-select" id="mail_protocol" name="mail_protocol" onchange="toggleSmtp()">
                      <option value="smtp" <?= $proto === 'smtp' ? 'selected' : '' ?>>SMTP</option>
                      <option value="mail" <?= $proto === 'mail' ? 'selected' : '' ?>>Mail (PHP mail())</option>
                      <option value="sendmail" <?= $proto === 'sendmail' ? 'selected' : '' ?>>Sendmail</option>
                    </select>
                  </div>

                  <div id="smtp-settings">
                    <hr class="my-4">
                    <h5 class="fs-6 fw-semibold mb-3">Kredensial SMTP</h5>

                    <div class="row g-3">
                      <div class="col-md-8">
                        <div class="mb-3">
                          <label for="mail_hostname" class="form-label">Hostname</label>
                          <input type="text" class="form-control" id="mail_hostname" name="mail_hostname"
                                 value="<?= old('mail_hostname', $s('Mail.hostname')) ?>" placeholder="smtp.gmail.com">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label for="mail_port" class="form-label">Port</label>
                          <input type="number" class="form-control" id="mail_port" name="mail_port"
                                 value="<?= old('mail_port', $s('Mail.port')) ?>" placeholder="587">
                        </div>
                      </div>
                    </div>

                    <div class="row g-3">
                      <div class="col-md-4">
                        <div class="mb-3">
                          <label for="mail_encryption" class="form-label">Enkripsi</label>
                          <?php $enc = $settings['Mail.encryption'] ?? 'tls'; ?>
                          <select class="form-select" id="mail_encryption" name="mail_encryption">
                            <option value="tls" <?= $enc === 'tls' ? 'selected' : '' ?>>TLS</option>
                            <option value="ssl" <?= $enc === 'ssl' ? 'selected' : '' ?>>SSL</option>
                            <option value="none" <?= $enc === 'none' ? 'selected' : '' ?>>Tanpa Enkripsi</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="mb-3">
                          <label for="mail_username" class="form-label">Username</label>
                          <input type="text" class="form-control" id="mail_username" name="mail_username"
                                 value="<?= old('mail_username', $s('Mail.username')) ?>" placeholder="email@gmail.com" autocomplete="off">
                        </div>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="mail_password" class="form-label">Password</label>
                      <input type="password" class="form-control" id="mail_password" name="mail_password"
                             placeholder="Kosongkan jika tidak ingin mengubah" autocomplete="new-password">
                      <?php if (! empty($settings['Mail.password'])): ?>
                        <div class="form-text text-success"><i class="bi bi-check-circle"></i> Password sudah diatur</div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <hr class="my-4">
                  <h5 class="fs-6 fw-semibold mb-3">Identitas Pengirim</h5>

                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="mail_from_email" class="form-label">Email Pengirim</label>
                        <input type="email" class="form-control" id="mail_from_email" name="mail_from_email"
                               value="<?= old('mail_from_email', $s('Mail.fromEmail')) ?>" placeholder="noreply@example.com">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="mail_from_name" class="form-label">Nama Pengirim</label>
                        <input type="text" class="form-control" id="mail_from_name" name="mail_from_name"
                               value="<?= old('mail_from_name', $s('Mail.fromName')) ?>" placeholder="My App">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                  <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#testEmailModal">
                    <i class="bi bi-envelope me-1"></i> Test Email
                  </button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </form>
          </section>

          <section>
            <form action="<?= base_url('admin/settings/reset') ?>" method="post"
                  onsubmit="return confirm('Reset pengaturan Email ke default?')">
              <?= csrf_field() ?>
              <input type="hidden" name="tab" value="mail">
              <button type="submit" class="btn btn-danger btn-sm">Reset ke Default</button>
            </form>
          </section>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Modal: Test Email -->
<div class="modal fade" id="testEmailModal" tabindex="-1" aria-labelledby="testEmailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="testEmailModalLabel">Test Kirim Email</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div id="testEmailResult" class="d-none alert"></div>

        <div class="mb-3">
          <label for="test_email_to" class="form-label">Alamat Email Tujuan <span class="text-danger">*</span></label>
          <input type="email" class="form-control" id="test_email_to" placeholder="contoh@email.com" required>
        </div>
        <div class="mb-3">
          <label for="test_email_subject" class="form-label">Subjek</label>
          <input type="text" class="form-control" id="test_email_subject" value="Test Email - <?= esc(setting('App.siteName') ?? 'CI4 Shield RBAC') ?>">
        </div>
        <div class="mb-3">
          <label for="test_email_message" class="form-label">Pesan</label>
          <textarea class="form-control" id="test_email_message" rows="3">Ini adalah email percobaan dari <?= esc(setting('App.siteName') ?? 'CI4 Shield RBAC') ?>. Jika Anda menerima email ini, konfigurasi SMTP sudah benar.</textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSendTestEmail">Kirim</button>
      </div>
    </div>
  </div>
</div>

<script>
  function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) { document.getElementById(previewId).src = e.target.result; };
      reader.readAsDataURL(input.files[0]);
    }
  }

  function toggleSmtp() {
    var proto = document.getElementById('mail_protocol').value;
    var smtp = document.getElementById('smtp-settings');
    if (smtp) smtp.style.display = proto === 'smtp' ? '' : 'none';
  }

  document.getElementById('btnSendTestEmail').addEventListener('click', function() {
    var btn = this;
    var resultDiv = document.getElementById('testEmailResult');
    var emailTo = document.getElementById('test_email_to').value.trim();
    var subject = document.getElementById('test_email_subject').value.trim();
    var message = document.getElementById('test_email_message').value.trim();

    if (!emailTo) {
      resultDiv.className = 'alert alert-warning mb-3';
      resultDiv.textContent = 'Alamat email tujuan wajib diisi.';
      resultDiv.classList.remove('d-none');
      return;
    }

    btn.disabled = true;
    btn.textContent = 'Mengirim...';
    resultDiv.classList.add('d-none');

    fetch('<?= base_url('admin/settings/test-email') ?>', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
      },
      body: JSON.stringify({ email: emailTo, subject: subject, message: message })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
      resultDiv.classList.remove('d-none');
      if (data.success) {
        resultDiv.className = 'alert alert-success mb-3';
      } else {
        resultDiv.className = 'alert alert-danger mb-3';
      }
      resultDiv.textContent = data.message;
    })
    .catch(function() {
      resultDiv.classList.remove('d-none');
      resultDiv.className = 'alert alert-danger mb-3';
      resultDiv.textContent = 'Terjadi kesalahan saat mengirim email.';
    })
    .finally(function() {
      btn.disabled = false;
      btn.textContent = 'Kirim';
    });
  });

  toggleSmtp();
  
  // Update URL hash when tab changes
  var tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
  tabEls.forEach(function(tabEl) {
    tabEl.addEventListener('shown.bs.tab', function (event) {
      var value = event.target.id.replace('-tab', '');
      var url = new URL(window.location.href);
      url.searchParams.set('tab', value);
      window.history.pushState({ tab: value }, '', url);
    });
  });
</script>
<script>
  (function () {
    var form = document.getElementById('theme-settings');
    if (!form) return;
    var root = document.documentElement;
    var primary = document.getElementById('theme_primary');
    var picker = document.getElementById('theme_primary_picker');
    var swatches = form.querySelectorAll('[data-theme-color]');

    function refreshTheme() {
      var color = primary.value.trim();
      if (/^#[0-9a-f]{6}$/i.test(color)) {
        root.style.setProperty('--bs-primary', color);
        picker.value = color;
      }
      var mode = form.querySelector('[name="theme_mode"]:checked').value;
      root.dataset.bsTheme = mode === 'system' ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light') : mode;
    }

    swatches.forEach(function (swatch) {
      swatch.addEventListener('click', function () {
        primary.value = swatch.dataset.themeColor;
        refreshTheme();
      });
    });
    picker.addEventListener('input', function () { primary.value = picker.value; refreshTheme(); });
    primary.addEventListener('input', refreshTheme);
    form.querySelectorAll('input[name^="theme_"]').forEach(function (input) {
      input.addEventListener('input', refreshTheme);
      input.addEventListener('change', refreshTheme);
    });
    form.addEventListener('reset', function () { requestAnimationFrame(function () { refreshTheme(); }); });
    refreshTheme();
  })();
</script>
<script>
  (function () {
    var form = document.getElementById('theme-settings');
    if (!form) return;
    var pairs = [['theme_radius', 'radius-out'], ['theme_sidebar_width', 'sw-out']];
    pairs.forEach(function (pair) {
      var input = document.getElementById(pair[0]);
      var out = document.getElementById(pair[1]);
      if (!input || !out) return;
      var sync = function () { out.textContent = input.value; };
      input.addEventListener('input', sync);
      form.addEventListener('reset', function () { requestAnimationFrame(sync); });
      sync();
    });

    var palette = document.getElementById('theme_primary_color');
    if (palette) {
      var apply = function () {
        if (palette.value) {
          document.documentElement.setAttribute('data-lte-primary', palette.value);
        } else {
          document.documentElement.removeAttribute('data-lte-primary');
        }
      };
      palette.addEventListener('change', apply);
      form.addEventListener('reset', function () { requestAnimationFrame(apply); });
      apply();
    }
  })();
</script>
