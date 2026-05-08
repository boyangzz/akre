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
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-sm text-center align-middle mb-0">
                <thead class="table-dark">
                    <?php if ($jenis == 'industri'): ?>
                    <tr>
                        <th>No</th>
                        <th>Nama Dosen Industri/Praktisi</th>
                        <th>NIDK</th>
                        <th>Perusahaan/Industri</th>
                        <th>Pendidikan</th>
                        <th>Bidang Keahlian</th>
                        <th>Sertifikat Kompetensi</th>
                        <th>Bobot SKS</th>
                        <th>Aksi</th>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <th>NIDN/NIDK</th>
                        <th>Nama Dosen</th>
                        <th>Pendidikan</th>
                        <th>Bidang Keahlian</th>
                        <th>Jabatan Akademik</th>
                        <th>Sertifikat</th>
                        <th>Aksi</th>
                    </tr>
                    <?php endif; ?>
                </thead>
                <tbody>
                    <?php foreach ($records as $idx => $r): ?>
                    <tr>
                        <?php if ($jenis == 'industri'): ?>
                        <td><?= $idx + 1 ?></td>
                        <td class="text-start"><?= $r->nama ?></td>
                        <td><?= $r->nidn ?></td>
                        <td class="text-start"><?= $r->nama_perusahaan ?></td>
                        <td><span class="badge bg-info"><?= $r->pendidikan_pasca ?></span></td>
                        <td class="text-start"><?= $r->bidang_keahlian ?></td>
                        <td class="text-start"><small><?= $r->sertifikat_kompetensi ?></small></td>
                        <td class="fw-bold"><?= $r->bobot_sks_praktisi ?></td>
                        <?php else: ?>
                        <td><?= $r->nidn ?></td>
                        <td class="text-start"><?= $r->nama ?></td>
                        <td><span class="badge bg-info"><?= $r->pendidikan_pasca ?></span></td>
                        <td class="text-start"><?= $r->bidang_keahlian ?></td>
                        <td><?= $r->jabatan_akademik ?></td>
                        <td class="text-start">
                            <small>Pendidik: <?= $r->sertifikat_pendidik ?: '-' ?></small><br>
                            <small>Komp: <?= $r->sertifikat_kompetensi ?: '-' ?></small>
                        </td>
                        <?php endif; ?>
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
