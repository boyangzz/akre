<div class="page-header">
    <h4><i class="bi bi-mortarboard me-2"></i>IPK Lulusan (8.a)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">IPK Lulusan</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Input Data Lulusan</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('luaran/ipk_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label">Tahun Lulus</label>
                        <input type="number" class="form-control" name="tahun_lulus" id="field-tahun" placeholder="TS" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Lulusan</label>
                        <input type="number" class="form-control" name="jml_lulusan" id="field-jml" required>
                    </div>
                    <div class="row g-2">
                        <div class="col-4">
                            <label class="form-label">Min</label>
                            <input type="number" step="0.01" class="form-control" name="ipk_min" id="field-min">
                        </div>
                        <div class="col-4">
                            <label class="form-label">Rata</label>
                            <input type="number" step="0.01" class="form-control" name="ipk_rata" id="field-rata" required>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Max</label>
                            <input type="number" step="0.01" class="form-control" name="ipk_max" id="field-max">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Data</button>
                    <button type="reset" class="btn btn-link btn-sm w-100 mt-2" onclick="$('#field-id').val('')">Reset Form</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm mb-0 text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Tahun Lulus</th>
                                <th>Jml Lulusan</th>
                                <th>IPK Min</th>
                                <th>IPK Rata-rata</th>
                                <th>IPK Max</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="6" class="py-4 text-muted">Belum ada data IPK.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->tahun_lulus ?></td>
                                    <td><?= $r->jml_lulusan ?></td>
                                    <td><?= number_format($r->ipk_min, 2) ?></td>
                                    <td class="fw-bold"><?= number_format($r->ipk_rata, 2) ?></td>
                                    <td><?= number_format($r->ipk_max, 2) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0" onclick="editData('<?= $r->id ?>', '<?= $r->tahun_lulus ?>', '<?= $r->jml_lulusan ?>', '<?= $r->ipk_min ?>', '<?= $r->ipk_rata ?>', '<?= $r->ipk_max ?>')"><i class="bi bi-pencil"></i></button>
                                    </td>
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

<script>
function editData(id, tahun, jml, min, rata, max) {
    $('#field-id').val(id);
    $('#field-tahun').val(tahun);
    $('#field-jml').val(jml);
    $('#field-min').val(min);
    $('#field-rata').val(rata);
    $('#field-max').val(max);
}
</script>
