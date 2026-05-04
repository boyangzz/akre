<div class="page-header">
    <h4><i class="bi bi-briefcase me-2"></i><?= $page_title ?></h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Luaran</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Input Data</div>
            <div class="card-body">
                <?php $kode = strpos($page_title, '8.d') !== false ? '8d2' : '8e1'; ?>
                <form method="POST" action="<?= base_url('luaran/tempat_kerja_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <input type="hidden" name="kode_asal" value="<?= $kode ?>">
                    <div class="mb-3">
                        <label class="form-label">Tahun Lulus</label>
                        <input type="number" class="form-control" name="tahun_lulus" id="field-tahun" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Lokal / Wirausaha</label>
                        <input type="number" class="form-control" name="jml_lokal" id="field-lokal" value="0">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Nasional</label>
                        <input type="number" class="form-control" name="jml_nasional" id="field-nasional" value="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Multinasional</label>
                        <input type="number" class="form-control" name="jml_multinasional" id="field-multi" value="0">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                    <button type="reset" class="btn btn-link btn-sm w-100 mt-1" onclick="$('#field-id').val('')">Reset Form</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th rowspan="2">Tahun Lulus</th>
                                <th colspan="3">Jumlah Lulusan yang Bekerja di</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>Lokal / Wirausaha</th>
                                <th>Nasional</th>
                                <th>Multinasional</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="5" class="py-4 text-muted">Belum ada data.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->tahun_lulus ?></td>
                                    <td><?= $r->jml_lokal ?></td>
                                    <td><?= $r->jml_nasional ?></td>
                                    <td><?= $r->jml_multinasional ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0" onclick="editRow('<?= $r->id ?>', '<?= $r->tahun_lulus ?>', '<?= $r->jml_lokal ?>', '<?= $r->jml_nasional ?>', '<?= $r->jml_multinasional ?>')"><i class="bi bi-pencil"></i></button>
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
function editRow(id, tahun, lokal, nasional, multi) {
    $('#field-id').val(id);
    $('#field-tahun').val(tahun);
    $('#field-lokal').val(lokal);
    $('#field-nasional').val(nasional);
    $('#field-multi').val(multi);
}
</script>
