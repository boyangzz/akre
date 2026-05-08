<div class="page-header">
    <h4><i class="bi bi-emoji-smile me-2"></i>Kepuasan Mahasiswa (5.c)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Kepuasan Mahasiswa</li>
        </ol>
    </nav>
</div>

<div class="alert alert-info border-info shadow-sm">
    <i class="bi bi-info-circle me-1"></i> <strong>Panduan:</strong> Masukkan persentase (%) kepuasan mahasiswa untuk setiap aspek. Pastikan total per baris adalah 100%.
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <form action="<?= base_url('litabmas/kepuasan_save') ?>" method="POST">
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0 text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2" width="5%">No</th>
                            <th rowspan="2" width="30%">Aspek yang Diukur</th>
                            <th colspan="4">Tingkat Kepuasan Mahasiswa (%)</th>
                            <th rowspan="2" width="25%">Rencana Tindak Lanjut</th>
                        </tr>
                        <tr class="table-secondary text-dark">
                            <th width="10%">Sangat Baik</th>
                            <th width="10%">Baik</th>
                            <th width="10%">Cukup</th>
                            <th width="10%">Kurang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $idx => $r): ?>
                        <tr>
                            <td><?= $idx + 1 ?></td>
                            <td class="text-start ps-3 fw-bold">
                                <?= $r->aspek ?>
                                <input type="hidden" name="data[<?= $idx ?>][id]" value="<?= $r->id ?>">
                            </td>
                            <td><input type="number" step="0.01" name="data[<?= $idx ?>][sangat_baik]" class="form-control form-control-sm text-end" value="<?= $r->sangat_baik ?>"></td>
                            <td><input type="number" step="0.01" name="data[<?= $idx ?>][baik]" class="form-control form-control-sm text-end" value="<?= $r->baik ?>"></td>
                            <td><input type="number" step="0.01" name="data[<?= $idx ?>][cukup]" class="form-control form-control-sm text-end" value="<?= $r->cukup ?>"></td>
                            <td><input type="number" step="0.01" name="data[<?= $idx ?>][kurang]" class="form-control form-control-sm text-end" value="<?= $r->kurang ?>"></td>
                            <td><textarea name="data[<?= $idx ?>][tindak_lanjut]" class="form-control form-control-sm" rows="2"><?= $r->tindak_lanjut ?></textarea></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white text-end py-3">
                <button type="submit" class="btn btn-primary px-5"><i class="bi bi-save me-2"></i>Simpan Seluruh Data Kepuasan</button>
            </div>
        </form>
    </div>
</div>
