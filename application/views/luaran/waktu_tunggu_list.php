<div class="page-header">
    <h4><i class="bi bi-hourglass-split me-2"></i>Waktu Tunggu Lulusan (8.d.1)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Waktu Tunggu</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">Input Data</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('luaran/waktu_tunggu_save') ?>" class="row g-3">
                    <input type="hidden" name="id" id="field-id">
                    <div class="col-md-2">
                        <label class="form-label">Tahun Lulus</label>
                        <input type="number" class="form-control" name="tahun_lulus" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Jml Lulusan</label>
                        <input type="number" class="form-control" name="jml_lulusan" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Terlacak</label>
                        <input type="number" class="form-control" name="jml_terlacak" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">< 3 Bln</label>
                        <input type="number" class="form-control" name="wt_kurang_3bln">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">3-6 Bln</label>
                        <input type="number" class="form-control" name="wt_3_sd_6bln">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">> 6 Bln</label>
                        <input type="number" class="form-control" name="wt_lebih_6bln">
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th rowspan="2">Tahun Lulus</th>
                                <th rowspan="2">Jml Lulusan</th>
                                <th rowspan="2">Terlacak</th>
                                <th colspan="3">Waktu Tunggu Lulusan</th>
                            </tr>
                            <tr>
                                <th>< 3 Bulan</th>
                                <th>3 - 6 Bulan</th>
                                <th>> 6 Bulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="6" class="py-4 text-muted">Belum ada data waktu tunggu.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->tahun_lulus ?></td>
                                    <td><?= $r->jml_lulusan ?></td>
                                    <td><?= $r->jml_terlacak ?></td>
                                    <td><?= $r->wt_kurang_3bln ?></td>
                                    <td><?= $r->wt_3_sd_6bln ?></td>
                                    <td><?= $r->wt_lebih_6bln ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
