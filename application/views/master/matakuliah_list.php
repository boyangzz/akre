<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-book me-2"></i>Kurikulum & CPL (Tabel 5.a)</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Kurikulum</li>
            </ol>
        </nav>
    </div>
    <a href="<?= base_url('master_data/matakuliah_form') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Mata Kuliah
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-sm mb-0 text-center align-middle" style="font-size: 0.75rem;">
                <thead class="table-dark">
                    <tr>
                        <th rowspan="2" width="3%">No</th>
                        <th rowspan="2" width="5%">Smt</th>
                        <th rowspan="2" width="8%">Kode MK</th>
                        <th rowspan="2" width="15%">Nama Mata Kuliah</th>
                        <th rowspan="2" width="5%">MK Komp</th>
                        <th colspan="3">Bobot Kredit (sks)</th>
                        <th rowspan="2" width="5%">Konv Jam</th>
                        <th colspan="4">Capaian Pembelajaran</th>
                        <th rowspan="2" width="8%">Dok RPS</th>
                        <th rowspan="2" width="8%">Unit Penyelenggara</th>
                        <th rowspan="2" width="5%">Aksi</th>
                    </tr>
                    <tr class="table-secondary text-dark">
                        <th>Kuliah</th>
                        <th>Semin</th>
                        <th>Prakt</th>
                        <th>Sikp</th>
                        <th>Penget</th>
                        <th>KU</th>
                        <th>KK</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                    <tr>
                        <td colspan="16" class="py-4 text-muted">Belum ada data mata kuliah.</td>
                    </tr>
                    <?php else: foreach ($records as $idx => $r): ?>
                    <tr>
                        <td><?= $idx + 1 ?></td>
                        <td><?= $r->semester ?></td>
                        <td class="fw-bold"><?= $r->kode_mk ?></td>
                        <td class="text-start ps-2"><?= $r->nama_mk ?></td>
                        <td><?= $r->is_kompetensi ? 'V' : '' ?></td>
                        <td><?= $r->sks_kuliah ?></td>
                        <td><?= $r->sks_seminar ?></td>
                        <td><?= $r->sks_praktikum ?></td>
                        <td><?= number_format($r->konversi_jam, 1) ?></td>
                        <td><?= $r->cpl_sikap ? 'V' : '' ?></td>
                        <td><?= $r->cpl_pengetahuan ? 'V' : '' ?></td>
                        <td><?= $r->cpl_ku ? 'V' : '' ?></td>
                        <td><?= $r->cpl_kk ? 'V' : '' ?></td>
                        <td class="text-truncate" style="max-width: 80px;">
                            <?php if($r->rps_link): ?>
                                <a href="<?= $r->rps_link ?>" target="_blank" class="text-decoration-none">Ada</a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= $r->unit_penyelenggara ?></td>
                        <td>
                            <a href="<?= base_url('master_data/matakuliah_form/'.$r->id) ?>" class="btn btn-sm btn-link p-0">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
                <tfoot class="table-light fw-bold">
                    <tr>
                        <td colspan="5" class="text-end">Jumlah</td>
                        <td><?php echo array_sum(array_column($records, 'sks_kuliah')); ?></td>
                        <td><?php echo array_sum(array_column($records, 'sks_seminar')); ?></td>
                        <td><?php echo array_sum(array_column($records, 'sks_praktikum')); ?></td>
                        <td colspan="8"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
