<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-award me-2"></i>Rekognisi DTPS (3.b.1)</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Rekognisi</li>
            </ol>
        </nav>
    </div>
    <a href="<?= base_url('sumber_daya/rekognisi_form') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Data
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Dosen</th>
                        <th>Bidang Keahlian</th>
                        <th>Rekognisi & Bukti Pendukung</th>
                        <th>Tingkat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr><td colspan="6" class="py-4 text-center text-muted">Belum ada data rekognisi.</td></tr>
                    <?php else: ?>
                        <?php foreach ($records as $i => $r): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $r->nama_dosen ?></td>
                            <td><?= $r->bidang_keahlian ?></td>
                            <td>
                                <div><?= $r->rekognisi ?></div>
                                <small class="text-muted"><i class="bi bi-link-45deg"></i> <?= $r->bukti ?: '-' ?></small>
                            </td>
                            <td><span class="badge bg-info">Nasional</span></td> <!-- Placeholder for level -->
                            <td>
                                <a href="<?= base_url('sumber_daya/rekognisi_form/' . $r->id) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="AKRE.Borang.confirmDelete('<?= base_url('sumber_daya/rekognisi_delete/' . $r->id) ?>', 'Data Rekognisi <?= addslashes($r->nama_dosen) ?>')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
