<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' — ' : '' ?>AKRE Sistem Akreditasi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-icons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom_admin.css') ?>">
</head>
<body data-jenjang="<?= isset($current_jenjang) ? $current_jenjang : '' ?>">

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-akre fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('dashboard') ?>">
            <i class="bi bi-mortarboard-fill"></i> AKRE
            <small>Universitas XYZ</small>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>

                <!-- Identitas -->
                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'identitas') ? 'active' : '' ?>" href="<?= base_url('identitas') ?>">
                        <i class="bi bi-building"></i> Identitas
                    </a>
                </li>

                <!-- Data Master -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($this->uri->segment(1) == 'master_data') ? 'active' : '' ?>" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-database"></i> Master
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('master_data/dosen') ?>"><i class="bi bi-person-badge"></i> Dosen</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('master_data/mahasiswa') ?>"><i class="bi bi-people"></i> Mahasiswa</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('master_data/matakuliah') ?>"><i class="bi bi-book"></i> Mata Kuliah</a></li>
                    </ul>
                </li>

                <!-- Kerjasama -->
                <?php
                $kerjasama_codes = ['1-1','1-2','1-3'];
                $show_kerjasama = false;
                if (isset($menu_items)) {
                    foreach ($menu_items as $m) {
                        if (in_array($m->kode_tabel, $kerjasama_codes)) { $show_kerjasama = true; break; }
                    }
                }
                if ($show_kerjasama): ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'kerjasama') ? 'active' : '' ?>" href="<?= base_url('kerjasama') ?>">
                        <i class="bi bi-handshake"></i> Kerjasama
                    </a>
                </li>
                <?php endif; ?>

                <!-- Kemahasiswaan -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($this->uri->segment(1) == 'kemahasiswaan') ? 'active' : '' ?>" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-mortarboard"></i> Mahasiswa
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (isset($menu_items)): foreach ($menu_items as $m): ?>
                            <?php if ($m->kode_tabel == '2a'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('kemahasiswaan/seleksi') ?>"><i class="bi bi-clipboard-check"></i> Seleksi (2a)</a></li>
                            <?php elseif ($m->kode_tabel == '2b'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('kemahasiswaan/mhs_asing') ?>"><i class="bi bi-globe"></i> Mhs Asing (2b)</a></li>
                            <?php endif; ?>
                        <?php endforeach; endif; ?>
                    </ul>
                </li>

                <!-- SDM & Dosen -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($this->uri->segment(1) == 'sumber_daya') ? 'active' : '' ?>" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-workspace"></i> SDM
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (isset($menu_items)): foreach ($menu_items as $m): ?>
                            <?php if ($m->kategori == 'dosen' && !in_array($m->kode_tabel, ['3a1'])): ?>
                                <li><a class="dropdown-item" href="<?= base_url('sumber_daya/' . str_replace(['-','.'], '_', $m->kode_tabel)) ?>">
                                    <i class="bi bi-chevron-right"></i> <?= $m->nama_tabel ?> (<?= $m->kode_tabel ?>)
                                </a></li>
                            <?php endif; ?>
                        <?php endforeach; endif; ?>
                    </ul>
                </li>

                <!-- Luaran -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($this->uri->segment(1) == 'luaran') ? 'active' : '' ?>" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-graph-up"></i> Luaran
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (isset($menu_items)): foreach ($menu_items as $m): ?>
                            <?php if ($m->kategori == 'luaran'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('luaran/' . str_replace(['-','.'], '_', $m->kode_tabel)) ?>">
                                    <i class="bi bi-chevron-right"></i> <?= $m->nama_tabel ?> (<?= $m->kode_tabel ?>)
                                </a></li>
                            <?php endif; ?>
                        <?php endforeach; endif; ?>
                    </ul>
                </li>

                <!-- Simulasi -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= ($this->uri->segment(1) == 'simulasi') ? 'active' : '' ?>" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-calculator"></i> Simulasi
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('simulasi') ?>"><i class="bi bi-speedometer2"></i> Dashboard Perbandingan</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('simulasi/kertas_kerja') ?>"><i class="bi bi-pencil-square"></i> Kertas Kerja Asesor</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('simulasi/kamus') ?>"><i class="bi bi-journal-text"></i> Kamus Matriks & Rumus</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right side: user info -->
            <ul class="navbar-nav">
                <?php if (isset($current_jenjang) && $current_jenjang): ?>
                <li class="nav-item">
                    <span class="nav-link"><span class="badge bg-info"><?= $current_jenjang ?></span></span>
                </li>
                <?php endif; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> <?= isset($current_user['nama_lengkap']) ? $current_user['nama_lengkap'] : 'User' ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= base_url('setup/borang') ?>"><i class="bi bi-gear"></i> Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Content -->
<div class="content-wrapper">
    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
            <i class="bi bi-check-circle me-1"></i> <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
            <i class="bi bi-exclamation-circle me-1"></i> <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
