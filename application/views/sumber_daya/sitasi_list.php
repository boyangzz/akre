<div class="page-header">
    <h4><i class="bi bi-quote me-2"></i>Sitasi DTPS (3.b.6)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Sitasi</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Input Data</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('sumber_daya/sitasi_save') ?>">
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
                        <label class="form-label">Judul Artikel yang Disitasi</label>
                        <input type="text" class="form-control" name="judul_artikel" id="field-judul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jurnal (Vol, Tahun, Hal)</label>
                        <input type="text" class="form-control" name="jurnal_vol_tahun_hal" id="field-jurnal" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Sitasi</label>
                        <input type="number" class="form-control" name="jumlah_sitasi" id="field-jumlah" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                    <button type="reset" class="btn btn-link btn-sm w-100 mt-2" onclick="$('#field-id').val('')">Reset Form</button>
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
                                <th>Judul Artikel</th>
                                <th>Sitasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="4" class="py-4 text-center text-muted">Belum ada data sitasi.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->nama_dosen ?></td>
                                    <td>
                                        <div><?= $r->judul_artikel ?></div>
                                        <small class="text-muted"><?= $r->jurnal_vol_tahun_hal ?></small>
                                    </td>
                                    <td class="fw-bold"><?= $r->jumlah_sitasi ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0" onclick="editData('<?= $r->id ?>', '<?= $r->dosen_id ?>', '<?= addslashes($r->judul_artikel) ?>', '<?= addslashes($r->jurnal_vol_tahun_hal) ?>', '<?= $r->jumlah_sitasi ?>')"><i class="bi bi-pencil"></i></button>
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
function editData(id, dosen, judul, jurnal, jumlah) {
    $('#field-id').val(id);
    $('#field-dosen').val(dosen);
    $('#field-judul').val(judul);
    $('#field-jurnal').val(jurnal);
    $('#field-jumlah').val(jumlah);
}
</script>
