<div class="page-header">
    <h4><i class="bi bi-speedometer2 me-2"></i>Dashboard Utama</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Ringkasan Sistem Akreditasi</li>
        </ol>
    </nav>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card stat-card border-primary h-100">
            <div class="card-body">
                <div class="stat-label">Dosen Tetap</div>
                <div class="stat-value"><?= $stats['dosen'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card stat-card border-success h-100">
            <div class="card-body">
                <div class="stat-label">Kerjasama</div>
                <div class="stat-value"><?= $stats['kerjasama'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card stat-card border-warning h-100">
            <div class="card-body">
                <div class="stat-label">Penelitian</div>
                <div class="stat-value"><?= $stats['penelitian'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card stat-card border-info h-100">
            <div class="card-body">
                <div class="stat-label">PkM DTPS</div>
                <div class="stat-value"><?= $stats['pkm'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card stat-card border-danger h-100">
            <div class="card-body">
                <div class="stat-label">Publikasi</div>
                <div class="stat-value"><?= $stats['publikasi'] ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card stat-card border-dark h-100">
            <div class="card-body">
                <div class="stat-label">Mahasiswa</div>
                <div class="stat-value"><?= $stats['mahasiswa'] ?></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-info-circle me-1"></i>Informasi Program Studi</span>
                <a href="<?= base_url('identitas') ?>" class="btn btn-sm btn-outline-primary">Edit Identitas</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label class="small text-muted d-block">Nama Perguruan Tinggi</label>
                        <span class="fw-bold"><?= $identitas ? $identitas->nama_pt : 'Belum Diatur' ?></span>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="small text-muted d-block">Program Studi</label>
                        <span class="fw-bold"><?= $identitas ? $identitas->nama_prodi : 'Belum Diatur' ?></span>
                    </div>
                    <div class="col-sm-6">
                        <label class="small text-muted d-block">Jenjang Akreditasi</label>
                        <span class="badge bg-primary fs-6"><?= $current_jenjang ?: 'Belum Diatur' ?></span>
                    </div>
                </div>
                <hr>
                <p class="small text-muted mb-0"><i class="bi bi-lightbulb me-1"></i>Tips: Atur jenjang di menu Identitas untuk menyesuaikan tampilan borang secara otomatis.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header">Aksi Cepat</div>
            <div class="list-group list-group-flush">
                <a href="<?= base_url('kerjasama/form') ?>" class="list-group-item list-group-item-action"><i class="bi bi-plus-circle me-2 text-success"></i>Tambah Kerjasama</a>
                <a href="<?= base_url('master_data/dosen') ?>" class="list-group-item list-group-item-action"><i class="bi bi-people me-2 text-primary"></i>Kelola DTPS</a>
                <a href="<?= base_url('setup/borang') ?>" class="list-group-item list-group-item-action"><i class="bi bi-gear me-2 text-dark"></i>Aturan Borang</a>
                <a href="<?= base_url('test_validation') ?>" class="list-group-item list-group-item-action bg-light"><i class="bi bi-shield-check me-2 text-info"></i>🔬 QC Test Engine</a>
                <a href="<?= base_url('auth/logout') ?>" class="list-group-item list-group-item-action text-danger"><i class="bi bi-box-arrow-right me-2"></i>Keluar Sistem</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-info shadow-sm">
            <div class="card-header bg-info text-white py-2">
                <i class="bi bi-journal-bookmark-fill me-2"></i>💡 Petunjuk Sinkronisasi Excel BAN-PT (APS 4.0)
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold border-bottom pb-2">Pemetaan Sheet Excel ke Menu Sistem:</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2"><span class="badge bg-primary me-2">1-1 s/d 1-3</span> 👉 Menu <strong>Kerjasama</strong> (Pendidikan, Penelitian, PkM)</li>
                            <li class="mb-2"><span class="badge bg-success me-2">2a & 2b</span> 👉 Menu <strong>Mahasiswa</strong> (Seleksi & Mhs Asing)</li>
                            <li class="mb-2"><span class="badge bg-warning text-dark me-2">3a1 s/d 3b7</span> 👉 Menu <strong>SDM</strong> (Profil & Kinerja Dosen)</li>
                            <li class="mb-2"><span class="badge bg-info me-2">Tabel 4</span> 👉 Menu <strong>Keuangan & Sarpras</strong> (Penggunaan Dana)</li>
                            <li class="mb-2"><span class="badge bg-danger me-2">5a s/d 5c</span> 👉 Menu <strong>Pendidikan</strong> (Kurikulum & Kepuasan Mhs)</li>
                            <li class="mb-2"><span class="badge bg-primary me-2">6a s/d 7</span> 👉 Menu <strong>SDM > Kinerja</strong> (Penelitian & PkM DTPS)</li>
                            <li class="mb-2"><span class="badge bg-dark me-2">8a s/d 8e2</span> 👉 Menu <strong>Luaran</strong> (IPK, Masa Studi, Waktu Tunggu, dll)</li>
                            <li class="mb-2"><span class="badge bg-secondary me-2">8f1 s/d 8f4</span> 👉 Menu <strong>Luaran > 8f</strong> (Publikasi, HKI, & Produk Mhs)</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold border-bottom pb-2">Catatan Periode Laporan:</h6>
                        <p class="small text-muted mb-1">Data dilaporkan dalam siklus 3 tahun akademik terakhir:</p>
                        <table class="table table-sm table-bordered small text-center">
                            <tr class="table-light">
                                <th>Kode Excel</th>
                                <th>Keterangan</th>
                                <th>Contoh Tahun</th>
                            </tr>
                            <tr>
                                <td class="fw-bold">TS</td>
                                <td>Tahun Sekarang / Laporan</td>
                                <td><?= date('Y') ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">TS-1</td>
                                <td>Satu Tahun Sebelum TS</td>
                                <td><?= date('Y') - 1 ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">TS-2</td>
                                <td>Dua Tahun Sebelum TS</td>
                                <td><?= date('Y') - 2 ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="alert alert-light border mt-2 mb-0 py-2 small">
                    <i class="bi bi-info-circle-fill text-info me-1"></i> <strong>Tips:</strong> Gunakan <strong>Tabel Ringkasan (Summary)</strong> di setiap menu Luaran untuk melihat angka total yang siap disalin ke file Excel Pengusul.
                </div>
            </div>
        </div>
    </div>
</div>
