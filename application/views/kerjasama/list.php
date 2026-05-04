<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-handshake me-2"></i>Kerjasama Tridharma</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Kerjasama</li>
            </ol>
        </nav>
    </div>
    <a href="<?= base_url('kerjasama/form') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Kerjasama
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Lembaga Mitra</th>
                        <th>Tingkat</th>
                        <th>Jenis</th>
                        <th>Judul Kegiatan</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada data kerjasama.</td></tr>
                    <?php else: ?>
                        <?php foreach ($records as $i => $r): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $r->lembaga_mitra ?></td>
                            <td><span class="badge bg-info"><?= ucfirst($r->tingkat) ?></span></td>
                            <td><span class="badge bg-secondary"><?= ucfirst($r->jenis_kerjasama) ?></span></td>
                            <td class="text-truncate" style="max-width: 200px;"><?= $r->judul_kegiatan ?></td>
                            <td>
                                <?php if ($r->bukti): ?>
                                    <a href="<?= $r->bukti ?>" target="_blank" class="btn btn-sm btn-link p-0"><i class="bi bi-file-earmark-text"></i> Lihat</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('kerjasama/form/' . $r->id) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="AKRE.Borang.confirmDelete('<?= base_url('kerjasama/delete/' . $r->id) ?>', '<?= addslashes($r->lembaga_mitra) ?>')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
