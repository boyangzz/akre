<div class="page-header">
    <h4><i class="bi bi-emoji-smile me-2"></i>Kepuasan Pengguna Lulusan (8.e.2)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Kepuasan Pengguna</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Input Penilaian</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('luaran/kepuasan_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label">Jenis Kemampuan</label>
                        <select class="form-select" name="jenis_kemampuan" id="field-jenis" required>
                            <option value="Etika">Etika</option>
                            <option value="Keahlian bidang ilmu">Keahlian bidang ilmu</option>
                            <option value="Kemampuan bahasa asing">Kemampuan bahasa asing</option>
                            <option value="Penggunaan teknologi informasi">Penggunaan teknologi informasi</option>
                            <option value="Kemampuan berkomunikasi">Kemampuan berkomunikasi</option>
                            <option value="Kerjasama tim">Kerjasama tim</option>
                            <option value="Pengembangan diri">Pengembangan diri</option>
                        </select>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label">Sangat Baik (%)</label>
                            <input type="number" step="0.01" class="form-control" name="persen_sangat_baik" id="field-sb" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Baik (%)</label>
                            <input type="number" step="0.01" class="form-control" name="persen_baik" id="field-b" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Cukup (%)</label>
                            <input type="number" step="0.01" class="form-control" name="persen_cukup" id="field-c" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Kurang (%)</label>
                            <input type="number" step="0.01" class="form-control" name="persen_kurang" id="field-k" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rencana Tindak Lanjut</label>
                        <textarea class="form-control" name="rencana_tindak_lanjut" id="field-rtl" rows="2"></textarea>
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
                    <table class="table table-bordered table-sm text-center align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th rowspan="2">Jenis Kemampuan</th>
                                <th colspan="4">Tingkat Kepuasan Pengguna (%)</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>SB</th>
                                <th>B</th>
                                <th>C</th>
                                <th>K</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="6" class="py-4 text-muted">Belum ada data kepuasan.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td class="text-start px-2"><?= $r->jenis_kemampuan ?></td>
                                    <td><?= $r->persen_sangat_baik ?></td>
                                    <td><?= $r->persen_baik ?></td>
                                    <td><?= $r->persen_cukup ?></td>
                                    <td><?= $r->persen_kurang ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0" onclick="editData('<?= $r->id ?>', '<?= $r->jenis_kemampuan ?>', '<?= $r->persen_sangat_baik ?>', '<?= $r->persen_baik ?>', '<?= $r->persen_cukup ?>', '<?= $r->persen_kurang ?>', '<?= addslashes($r->rencana_tindak_lanjut) ?>')"><i class="bi bi-pencil"></i></button>
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
function editData(id, jenis, sb, b, c, k, rtl) {
    $('#field-id').val(id);
    $('#field-jenis').val(jenis);
    $('#field-sb').val(sb);
    $('#field-b').val(b);
    $('#field-c').val(c);
    $('#field-k').val(k);
    $('#field-rtl').val(rtl);
}
</script>
