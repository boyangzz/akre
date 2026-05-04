<div class="page-header">
    <h4><i class="bi bi-person-check me-2"></i>Pembimbing Utama TA (3.a.2)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Pembimbing TA</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Input Data</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('sumber_daya/pembimbing_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label">Dosen DTPS</label>
                        <select class="form-select" name="dosen_id" id="field-dosen" required>
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($list_dosen as $d): ?>
                                <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun Akademik</label>
                        <input type="text" class="form-control" name="tahun_akademik" id="field-ta" placeholder="Contoh: 2023/2024" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bimbingan di PS Sendiri</label>
                        <input type="number" class="form-control" name="jml_bimbingan_ps" id="field-ps" value="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bimbingan di PS Lain</label>
                        <input type="number" class="form-control" name="jml_bimbingan_ps_lain" id="field-psl" value="0">
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
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Dosen</th>
                                <th>Tahun Akademik</th>
                                <th>Bimbingan PS Sendiri</th>
                                <th>Bimbingan PS Lain</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="5" class="py-4 text-center text-muted">Belum ada data pembimbingan TA.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->nama_dosen ?></td>
                                    <td><?= $r->tahun_akademik ?></td>
                                    <td><?= $r->jml_bimbingan_ps ?></td>
                                    <td><?= $r->jml_bimbingan_ps_lain ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0" onclick="editRow('<?= $r->id ?>', '<?= $r->dosen_id ?>', '<?= $r->tahun_akademik ?>', '<?= $r->jml_bimbingan_ps ?>', '<?= $r->jml_bimbingan_ps_lain ?>')"><i class="bi bi-pencil"></i></button>
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
function editRow(id, dosen, ta, ps, psl) {
    $('#field-id').val(id);
    $('#field-dosen').val(dosen);
    $('#field-ta').val(ta);
    $('#field-ps').val(ps);
    $('#field-psl').val(psl);
}
</script>
