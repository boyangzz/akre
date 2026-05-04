<div class="page-header">
    <h4><i class="bi bi-clock-history me-2"></i>Masa Studi Lulusan (8.c)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Masa Studi</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">Input Data Cohort Lulusan</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('luaran/masa_studi_save') ?>" class="row g-3">
                    <input type="hidden" name="id" id="field-id">
                    <div class="col-md-2">
                        <label class="form-label">Tahun Masuk</label>
                        <input type="number" class="form-control" name="tahun_masuk" id="field-tahun" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Mhs Diterima</label>
                        <input type="number" class="form-control" name="jml_mhs_diterima" id="field-mhs" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Lulus TS</label>
                        <input type="number" class="form-control" name="jml_lulus_akhir_ts" id="field-ts">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Lulus TS-1</label>
                        <input type="number" class="form-control" name="jml_lulus_akhir_ts1" id="field-ts1">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Rata Masa Studi</label>
                        <input type="number" step="0.01" class="form-control" name="rata_masa_studi" id="field-rata">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
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
                                <th rowspan="2">Tahun Masuk</th>
                                <th rowspan="2">Jml Mhs Diterima</th>
                                <th colspan="5">Jml Lulusan pada Akhir</th>
                                <th rowspan="2">Rata Masa Studi</th>
                            </tr>
                            <tr>
                                <th>TS-4</th>
                                <th>TS-3</th>
                                <th>TS-2</th>
                                <th>TS-1</th>
                                <th>TS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="8" class="py-4 text-muted">Belum ada data masa studi.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->tahun_masuk ?></td>
                                    <td><?= $r->jml_mhs_diterima ?></td>
                                    <td>-</td><td>-</td><td>-</td>
                                    <td><?= $r->jml_lulus_akhir_ts1 ?></td>
                                    <td><?= $r->jml_lulus_akhir_ts ?></td>
                                    <td><?= $r->rata_masa_studi ?></td>
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
