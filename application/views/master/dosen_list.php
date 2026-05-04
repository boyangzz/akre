<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-person-badge me-2"></i>Data Dosen Tetap</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li><li class="breadcrumb-item active">Dosen</li></ol>
        </nav>
    </div>
    <a href="<?= base_url('master_data/dosen_form') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIDN</th>
                        <th>Nama Dosen</th>
                        <th class="d-none d-md-table-cell">Pendidikan</th>
                        <th class="d-none d-md-table-cell">Jabatan</th>
                        <th class="d-none d-lg-table-cell">Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data dosen.</td></tr>
                    <?php else: ?>
                        <?php foreach ($records as $i => $r): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><code><?= $r->nidn ?></code></td>
                            <td><?= $r->nama ?></td>
                            <td class="d-none d-md-table-cell"><span class="badge bg-secondary"><?= $r->pendidikan_pasca ?></span></td>
                            <td class="d-none d-md-table-cell"><?= $r->jabatan_akademik ?></td>
                            <td class="d-none d-lg-table-cell">
                                <span class="badge bg-<?= $r->status_aktif ? 'success' : 'danger' ?>"><?= $r->status_aktif ? 'Aktif' : 'Nonaktif' ?></span>
                            </td>
                            <td>
                                <a href="<?= base_url('master_data/dosen_form/' . $r->id) ?>" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="AKRE.Borang.confirmDelete('<?= base_url('master_data/dosen_delete/' . $r->id) ?>', '<?= addslashes($r->nama) ?>')" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
