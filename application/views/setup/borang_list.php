<div class="page-header">
    <h4><i class="bi bi-gear me-2"></i>Pengaturan Borang</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengaturan</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Aturan Visibilitas Tabel per Jenjang (Rule Engine)</span>
        <a href="<?= base_url('setup/reset_standard') ?>" class="btn btn-sm btn-warning" onclick="return confirm('Kembalikan semua pengaturan D3 ke Standar Resmi BAN-PT? Semua ceklis yang salah akan dihapus otomatis.')">
            <i class="bi bi-arrow-counterclockwise"></i> Reset ke Standar D3 BAN-PT
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Kode</th>
                        <th>Nama Tabel</th>
                        <th>Kategori</th>
                        <th>Jenjang Filter</th>
                        <th>Wajib</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $r): ?>
                    <tr>
                        <td><code><?= $r->urutan ?></code></td>
                        <td><code><?= $r->kode_tabel ?></code></td>
                        <td><?= $r->nama_tabel ?></td>
                        <td><span class="badge bg-secondary"><?= $r->kategori ?></span></td>
                        <td>
                            <?php 
                            $filters = json_decode($r->jenjang_filter);
                            foreach ($filters as $f): ?>
                                <span class="badge bg-light text-dark border"><?= $f ?></span>
                            <?php endforeach; ?>
                        </td>
                        <td><?= $r->is_wajib ? '<i class="bi bi-check-circle-fill text-success"></i>' : '<i class="bi bi-circle text-muted"></i>' ?></td>
                        <td>
                            <a href="<?= base_url('setup/borang_form/' . $r->id) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
