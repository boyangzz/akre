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
                        <span class="fw-bold">Universitas XYZ</span>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="small text-muted d-block">Program Studi</label>
                        <span class="fw-bold">Teknik Informatika</span>
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
                <a href="<?= base_url('auth/logout') ?>" class="list-group-item list-group-item-action text-danger"><i class="bi bi-box-arrow-right me-2"></i>Keluar Sistem</a>
            </div>
        </div>
    </div>
</div>
