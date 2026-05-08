<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-globe me-2"></i>Mahasiswa Asing (Tabel 2.b)</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Mahasiswa Asing</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row g-3">
    <!-- Form Input -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Input Data</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('kemahasiswaan/mhs_asing_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label">Tahun Akademik</label>
                        <input type="text" class="form-control" name="tahun_akademik" id="field-ta" placeholder="Contoh: 2023/2024" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Full-Time</label>
                        <input type="number" class="form-control" name="jml_fulltime" id="field-ft" value="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Part-Time</label>
                        <input type="number" class="form-control" name="jml_parttime" id="field-pt" value="0">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                    <button type="reset" class="btn btn-link btn-sm w-100 mt-1" onclick="$('#field-id').val('')">Reset Form</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th rowspan="2">Tahun Akademik</th>
                                <th rowspan="2">Jml Mhs Aktif (dari 2a)</th>
                                <th colspan="2">Mahasiswa Asing</th>
                                <th rowspan="2">Total Asing</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>Full-Time</th>
                                <th>Part-Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="6" class="py-4 text-muted">Belum ada data mahasiswa asing.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->tahun_akademik ?></td>
                                    <td class="bg-light text-primary fw-bold"><?= number_format($r->total_mhs_aktif) ?></td>
                                    <td><?= $r->jml_fulltime ?></td>
                                    <td><?= $r->jml_parttime ?></td>
                                    <td class="fw-bold"><?= $r->jml_fulltime + $r->jml_parttime ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0 me-1" onclick="editRow('<?= $r->id ?>', '<?= $r->tahun_akademik ?>', '<?= $r->jml_fulltime ?>', '<?= $r->jml_parttime ?>')"><i class="bi bi-pencil"></i></button>
                                        <a href="javascript:void(0)" onclick="if(confirm('Hapus data ini?')) window.location='<?= base_url('kemahasiswaan/mhs_asing_delete/' . $r->id) ?>'"><i class="bi bi-trash text-danger"></i></a>
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
function editRow(id, ta, ft, pt) {
    $('#field-id').val(id);
    $('#field-ta').val(ta);
    $('#field-ft').val(ft);
    $('#field-pt').val(pt);
}
</script>
