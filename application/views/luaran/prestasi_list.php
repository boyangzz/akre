<div class="page-header">
    <h4><i class="bi bi-trophy me-2"></i><?= $page_title ?></h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Luaran</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header">Input Data</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('luaran/prestasi_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <input type="hidden" name="jenis_prestasi" value="<?= $jenis ?>">
                    <div class="mb-3">
                        <label class="form-label">Mahasiswa</label>
                        <select class="form-select" name="mahasiswa_id" id="field-mhs" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            <?php foreach ($list_mhs as $m): ?>
                                <option value="<?= $m->id ?>"><?= $m->nama ?> (<?= $m->nim ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Kegiatan / Kompetisi</label>
                        <input type="text" class="form-control" name="nama_kegiatan" id="field-kegiatan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tingkat</label>
                        <select class="form-select" name="tingkat" id="field-tingkat" required>
                            <option value="internasional">Internasional</option>
                            <option value="nasional">Nasional</option>
                            <option value="wilayah">Wilayah</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prestasi / Penghargaan</label>
                        <input type="text" class="form-control" name="prestasi" id="field-prestasi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="field-tahun" value="<?= date('Y') ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                    <button type="reset" class="btn btn-link btn-sm w-100 mt-1" onclick="$('#field-id').val('')">Reset Form</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Tingkat</th>
                                <th>Prestasi</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="5" class="py-4 text-center text-muted">Belum ada data prestasi.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->nama_kegiatan ?></td>
                                    <td><span class="badge bg-secondary"><?= $r->tingkat ?></span></td>
                                    <td><?= $r->prestasi ?></td>
                                    <td><?= $r->tahun ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0 me-2" onclick="editRow('<?= $r->id ?>', '<?= $r->mahasiswa_id ?>', '<?= addslashes($r->nama_kegiatan) ?>', '<?= $r->tingkat ?>', '<?= addslashes($r->prestasi) ?>', '<?= $r->tahun ?>')"><i class="bi bi-pencil"></i></button>
                                        <a href="<?= base_url('luaran/prestasi_delete/'.$r->id) ?>" class="btn btn-sm btn-link p-0 text-danger" onclick="return confirm('Hapus data prestasi ini?')"><i class="bi bi-trash"></i></a>
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
function editRow(id, mhs, kegiatan, tingkat, prestasi, tahun) {
    $('#field-id').val(id);
    $('#field-mhs').val(mhs);
    $('#field-kegiatan').val(kegiatan);
    $('#field-tingkat').val(tingkat);
    $('#field-prestasi').val(prestasi);
    $('#field-tahun').val(tahun);
}
</script>
