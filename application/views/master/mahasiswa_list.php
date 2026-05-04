<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-people me-2"></i>Data Mahasiswa</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Mahasiswa</li>
            </ol>
        </nav>
    </div>
    <a href="<?= base_url('master_data/mahasiswa_form') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah Mahasiswa</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr><td colspan="5" class="py-4 text-center text-muted">Belum ada data mahasiswa.</td></tr>
                    <?php else: ?>
                        <?php foreach ($records as $r): ?>
                        <tr>
                            <td><?= $r->nim ?></td>
                            <td><?= $r->nama ?></td>
                            <td><?= $r->angkatan ?></td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <a href="<?= base_url('master_data/mahasiswa_form/' . $r->id) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="AKRE.Borang.confirmDelete('<?= base_url('master_data/mahasiswa_delete/' . $r->id) ?>', '<?= addslashes($r->nama) ?>')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
