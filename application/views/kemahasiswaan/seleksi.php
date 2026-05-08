<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-clipboard-check me-2"></i>Seleksi Mahasiswa Baru (Tabel 2.a)</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Seleksi Mahasiswa</li>
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
                <form method="POST" action="<?= base_url('kemahasiswaan/seleksi_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label">Tahun Akademik</label>
                        <input type="text" class="form-control" name="tahun_akademik" id="field-ta" placeholder="Contoh: 2023/2024" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Daya Tampung</label>
                        <input type="number" class="form-control" name="daya_tampung" id="field-dt">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Pendaftar</label>
                        <input type="number" class="form-control" name="pendaftar" id="field-pdft">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Lulus Seleksi</label>
                        <input type="number" class="form-control" name="lulus_seleksi" id="field-ls">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Maba Reguler</label>
                        <input type="number" class="form-control" name="maba_reguler" id="field-mr">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Maba Transfer</label>
                        <input type="number" class="form-control" name="maba_transfer" id="field-mt">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Mhs Aktif Reguler</label>
                        <input type="number" class="form-control" name="mhs_aktif_reguler" id="field-mar">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mhs Aktif Transfer</label>
                        <input type="number" class="form-control" name="mhs_aktif_transfer" id="field-mat">
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
                                <th rowspan="2">Daya Tampung</th>
                                <th colspan="2">Calon Mahasiswa</th>
                                <th colspan="2">Mahasiswa Baru</th>
                                <th colspan="2">Mahasiswa Aktif</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>Pendaftar</th>
                                <th>Lulus Seleksi</th>
                                <th>Reguler</th>
                                <th>Transfer</th>
                                <th>Reguler</th>
                                <th>Transfer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="7" class="py-4 text-muted">Belum ada data seleksi.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->tahun_akademik ?></td>
                                    <td><?= $r->daya_tampung ?></td>
                                    <td><?= $r->pendaftar ?></td>
                                    <td><?= $r->lulus_seleksi ?></td>
                                    <td><?= $r->maba_reguler ?></td>
                                    <td><?= $r->maba_transfer ?></td>
                                    <td><?= $r->mhs_aktif_reguler ?></td>
                                    <td><?= $r->mhs_aktif_transfer ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0 me-1" onclick="editRow('<?= $r->id ?>', '<?= $r->tahun_akademik ?>', '<?= $r->daya_tampung ?>', '<?= $r->pendaftar ?>', '<?= $r->lulus_seleksi ?>', '<?= $r->maba_reguler ?>', '<?= $r->maba_transfer ?>', '<?= $r->mhs_aktif_reguler ?>', '<?= $r->mhs_aktif_transfer ?>')"><i class="bi bi-pencil"></i></button>
                                        <a href="javascript:void(0)" onclick="if(confirm('Hapus data ini?')) window.location='<?= base_url('kemahasiswaan/seleksi_delete/' . $r->id) ?>'"><i class="bi bi-trash text-danger"></i></a>
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
function editRow(id, ta, dt, pdft, ls, mr, mt, mar, mat) {
    $('#field-id').val(id);
    $('#field-ta').val(ta);
    $('#field-dt').val(dt);
    $('#field-pdft').val(pdft);
    $('#field-ls').val(ls);
    $('#field-mr').val(mr);
    $('#field-mt').val(mt);
    $('#field-mar').val(mar);
    $('#field-mat').val(mat);
}
</script>
