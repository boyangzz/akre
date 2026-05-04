<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-book me-2"></i>Data Mata Kuliah</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Mata Kuliah</li>
            </ol>
        </nav>
    </div>
    <a href="<?= base_url('master_data/matakuliah_form') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah Mata Kuliah</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS T</th>
                        <th>SKS P</th>
                        <th>Smt</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr><td colspan="7" class="py-4 text-center text-muted">Belum ada data mata kuliah.</td></tr>
                    <?php else: ?>
                        <?php foreach ($records as $r): ?>
                        <tr>
                            <td><?= $r->kode_mk ?></td>
                            <td><?= $r->nama_mk ?></td>
                            <td><?= $r->sks_teori ?></td>
                            <td><?= $r->sks_praktek ?></td>
                            <td><?= $r->semester ?></td>
                            <td><span class="badge bg-secondary"><?= $r->jenis_mk ?></span></td>
                            <td>
                                <a href="<?= base_url('master_data/matakuliah_form/' . $r->id) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="AKRE.Borang.confirmDelete('<?= base_url('master_data/matakuliah_delete/' . $r->id) ?>', '<?= addslashes($r->nama_mk) ?>')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
