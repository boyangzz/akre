<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-person-badge me-2"></i>Data Dosen Tetap</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li><li class="breadcrumb-item active">Dosen</li></ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalImport">
            <i class="bi bi-file-earmark-spreadsheet me-1"></i>Import CSV
        </button>
        <a href="<?= base_url('master_data/dosen_form') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Tambah
        </a>
    </div>
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

<!-- Modal Import -->
<div class="modal fade" id="modalImport" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('master_data/dosen_import') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Bulk Import Dosen (CSV)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info small">
                        <i class="bi bi-info-circle me-1"></i> <strong>Format CSV:</strong><br>
                        NIDN, Nama, Pendidikan, Jabatan, Status Ikatan<br>
                        <em>Contoh: 00123, Budi S.Kom, S2, Asisten Ahli, tetap</em>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih File CSV</label>
                        <input type="file" name="csv_file" class="form-control" accept=".csv" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Unggah & Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>
