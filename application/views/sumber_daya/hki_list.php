<div class="page-header">
    <h4><i class="bi bi-book me-2"></i>HKI & Buku DTPS (3.b.5)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">HKI & Buku</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Input Data</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('sumber_daya/hki_save') ?>">
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
                        <label class="form-label">Judul Luaran (HKI/Buku)</label>
                        <input type="text" class="form-control" name="judul" id="field-judul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis</label>
                        <select class="form-select" name="jenis" id="field-jenis" required>
                            <option value="Paten">Paten</option>
                            <option value="Hak Cipta">Hak Cipta</option>
                            <option value="Buku Ber-ISBN">Buku Ber-ISBN</option>
                            <option value="Teknologi Tepat Guna">Teknologi Tepat Guna</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="field-tahun" value="<?= date('Y') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan / Nomor HKI</label>
                        <input type="text" class="form-control" name="keterangan" id="field-ket">
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
                                <th>Judul</th>
                                <th>Jenis</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="5" class="py-4 text-center text-muted">Belum ada data HKI/Buku.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->nama_dosen ?></td>
                                    <td><?= $r->judul ?></td>
                                    <td><span class="badge bg-secondary"><?= $r->jenis ?></span></td>
                                    <td><?= $r->tahun ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0" onclick="editData('<?= $r->id ?>', '<?= $r->dosen_id ?>', '<?= addslashes($r->judul) ?>', '<?= $r->jenis ?>', '<?= $r->tahun ?>', '<?= $r->keterangan ?>')"><i class="bi bi-pencil"></i></button>
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
function editData(id, dosen, judul, jenis, tahun, ket) {
    $('#field-id').val(id);
    $('#field-dosen').val(dosen);
    $('#field-judul').val(judul);
    $('#field-jenis').val(jenis);
    $('#field-tahun').val(tahun);
    $('#field-ket').val(ket);
}
</script>
