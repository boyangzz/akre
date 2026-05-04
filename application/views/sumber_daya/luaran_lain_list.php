<div class="page-header">
    <h4><i class="bi bi-award me-2"></i>Luaran Lain DTPS (3.b.7)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Luaran Lain</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Input Data</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('sumber_daya/luaran_lain_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label">Mahasiswa</label>
                        <select class="form-select" name="mahasiswa_id" id="field-mhs">
                            <option value="">-- Pilih Mahasiswa --</option>
                            <?php foreach ($list_mhs as $m): ?>
                                <option value="<?= $m->id ?>"><?= $m->nama ?> (<?= $m->nim ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Luaran</label>
                        <select class="form-select" name="jenis" id="field-jenis" required>
                            <option value="Paten">Paten</option>
                            <option value="Hak Cipta">Hak Cipta</option>
                            <option value="Teknologi Tepat Guna">Teknologi Tepat Guna</option>
                            <option value="Produk">Produk</option>
                            <option value="Rekayasa Sosial">Rekayasa Sosial</option>
                            <option value="Karya Seni">Karya Seni</option>
                            <option value="Buku">Buku</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="field-judul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="field-tahun" value="<?= date('Y') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="field-ket">
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
                                <th>Mahasiswa</th>
                                <th>Jenis</th>
                                <th>Judul</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="5" class="py-4 text-center text-muted">Belum ada data luaran.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->nama_dosen ?? '-' ?></td>
                                    <td><span class="badge bg-secondary"><?= $r->jenis ?></span></td>
                                    <td><?= $r->judul ?></td>
                                    <td><?= $r->tahun ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0" onclick="editRow('<?= $r->id ?>', '<?= $r->mahasiswa_id ?>', '<?= $r->jenis ?>', '<?= addslashes($r->judul) ?>', '<?= $r->tahun ?>', '<?= addslashes($r->keterangan) ?>')"><i class="bi bi-pencil"></i></button>
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
function editRow(id, mhs, jenis, judul, tahun, ket) {
    $('#field-id').val(id);
    $('#field-mhs').val(mhs);
    $('#field-jenis').val(jenis);
    $('#field-judul').val(judul);
    $('#field-tahun').val(tahun);
    $('#field-ket').val(ket);
}
</script>
