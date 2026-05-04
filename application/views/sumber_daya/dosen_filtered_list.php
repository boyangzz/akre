<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-person-badge me-2"></i><?= $page_title ?></h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">SDM</li>
            </ol>
        </nav>
    </div>
    <a href="<?= base_url('master_data/dosen_form') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Dosen
    </a>
</div>

<?php if (empty($records)): ?>
<div class="alert alert-info">
    <i class="bi bi-info-circle me-2"></i>
    Belum ada data dosen dengan status <strong><?= $jenis == 'tidak_tetap' ? 'Tidak Tetap' : 'Industri/Praktisi' ?></strong>.
    Data dikelola melalui menu <a href="<?= base_url('master_data/dosen') ?>">Master &rarr; Dosen</a>.
    Pastikan mengisi kolom <em>Status Ikatan</em> dengan benar saat input data.
</div>
<?php else: ?>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>NIDN</th>
                        <th>Nama</th>
                        <th>Pendidikan</th>
                        <th>Bidang Keahlian</th>
                        <th>Jabatan Akademik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $r): ?>
                    <tr>
                        <td><?= $r->nidn ?></td>
                        <td><?= $r->nama ?></td>
                        <td><span class="badge bg-info"><?= $r->pendidikan_pasca ?></span></td>
                        <td><?= $r->bidang_keahlian ?></td>
                        <td><?= $r->jabatan_akademik ?></td>
                        <td>
                            <a href="<?= base_url('master_data/dosen_form/' . $r->id) ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>
