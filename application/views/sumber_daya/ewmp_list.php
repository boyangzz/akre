<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-calculator me-2"></i>EWMP Dosen Tetap (3.a.3)</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">EWMP</li>
            </ol>
        </nav>
    </div>
    <a href="<?= base_url('sumber_daya/ewmp_form') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Data
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-hover mb-0 text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama Dosen</th>
                        <th rowspan="2">Tahun Akademik</th>
                        <th colspan="3">SKS Pendidikan</th>
                        <th rowspan="2">SKS Penelitian</th>
                        <th rowspan="2">SKS PkM</th>
                        <th rowspan="2">SKS Tambahan</th>
                        <th rowspan="2">Total</th>
                        <th rowspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <th>PS Sendiri</th>
                        <th>PS Lain (Internal)</th>
                        <th>PS Lain (Eksternal)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr><td colspan="11" class="py-4 text-muted">Belum ada data EWMP.</td></tr>
                    <?php else: ?>
                        <?php foreach ($records as $i => $r): 
                            $total = $r->sks_pendidikan_ps + $r->sks_pendidikan_luar + $r->sks_penelitian + $r->sks_pkm + $r->sks_tugas_tambahan;
                        ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="text-start"><?= $r->nama_dosen ?></td>
                            <td><?= $r->tahun_akademik ?></td>
                            <td><?= $r->sks_pendidikan_ps ?></td>
                            <td><?= $r->sks_pendidikan_luar ?></td>
                            <td>0</td> <!-- Placeholder for external -->
                            <td><?= $r->sks_penelitian ?></td>
                            <td><?= $r->sks_pkm ?></td>
                            <td><?= $r->sks_tugas_tambahan ?></td>
                            <td class="fw-bold"><?= $total ?></td>
                            <td>
                                <a href="<?= base_url('sumber_daya/ewmp_form/' . $r->id) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="AKRE.Borang.confirmDelete('<?= base_url('sumber_daya/ewmp_delete/' . $r->id) ?>', 'Data EWMP <?= addslashes($r->nama_dosen) ?>')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
