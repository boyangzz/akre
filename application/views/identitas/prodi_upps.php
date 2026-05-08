<div class="page-header">
    <h4><i class="bi bi-building me-2"></i><?= $page_title ?></h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('identitas') ?>">Identitas</a></li>
            <li class="breadcrumb-item active">Prodi UPPS</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Tambah/Edit Program Studi</div>
            <div class="card-body">
                <form action="<?= base_url('identitas/prodi_upps_save') ?>" method="POST">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label">Jenis Program</label>
                        <select name="jenis_program" id="field-jenis" class="form-select" required>
                            <option value="Diploma Tiga">Diploma Tiga</option>
                            <option value="Sarjana">Sarjana</option>
                            <option value="Sarjana Terapan">Sarjana Terapan</option>
                            <option value="Magister">Magister</option>
                            <option value="Doktor">Doktor</option>
                            <option value="Profesi">Profesi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Program Studi</label>
                        <input type="text" name="nama_prodi" id="field-nama" class="form-control" placeholder="Contoh: Teknik Informatika" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status / Peringkat</label>
                        <input type="text" name="status_peringkat" id="field-status" class="form-control" placeholder="Unggul / Baik Sekali / A / B" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. dan Tgl. SK</label>
                        <input type="text" name="no_tgl_sk" id="field-sk" class="form-control" placeholder="Contoh: 123/SK/BAN-PT/2024" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tgl. Kadaluarsa</label>
                        <input type="date" name="tgl_kadaluarsa" id="field-exp" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Mahasiswa saat TS</label>
                        <input type="number" name="jumlah_mahasiswa" id="field-mhs" class="form-control" value="0" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Data Prodi</button>
                    <button type="reset" class="btn btn-link w-100 mt-2 text-decoration-none" onclick="$('#field-id').val('')">Reset Form</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0 text-center">
                        <thead class="table-dark">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Jenis Program</th>
                                <th rowspan="2">Nama Program Studi</th>
                                <th colspan="3">Akreditasi Program Studi</th>
                                <th rowspan="2">Jumlah Mahasiswa saat TS</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>Status/Peringkat</th>
                                <th>No. dan Tgl. SK</th>
                                <th>Tgl. Kadaluarsa</th>
                            </tr>
                        </thead>
                        <tbody class="bg-light-yellow">
                            <?php if(empty($records)): ?>
                                <tr><td colspan="8" class="py-4 text-muted">Belum ada data program studi.</td></tr>
                            <?php endif; ?>
                            <?php foreach($records as $idx => $r): ?>
                                <tr>
                                    <td><?= $idx + 1 ?></td>
                                    <td><?= $r->jenis_program ?></td>
                                    <td class="text-start"><?= $r->nama_prodi ?></td>
                                    <td><?= $r->status_peringkat ?></td>
                                    <td><?= $r->no_tgl_sk ?></td>
                                    <td><?= date('d/m/Y', strtotime($r->tgl_kadaluarsa)) ?></td>
                                    <td><?= number_format($r->jumlah_mahasiswa) ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary" onclick="edit('<?= $r->id ?>','<?= $r->jenis_program ?>','<?= addslashes($r->nama_prodi) ?>','<?= $r->status_peringkat ?>','<?= $r->no_tgl_sk ?>','<?= $r->tgl_kadaluarsa ?>','<?= $r->jumlah_mahasiswa ?>')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <a href="<?= base_url('identitas/prodi_upps_delete/'.$r->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus prodi ini?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-light-yellow { background-color: #fffde7 !important; }
</style>

<script>
function edit(id, jenis, nama, status, sk, exp, mhs) {
    $('#field-id').val(id);
    $('#field-jenis').val(jenis);
    $('#field-nama').val(nama);
    $('#field-status').val(status);
    $('#field-sk').val(sk);
    $('#field-exp').val(exp);
    $('#field-mhs').val(mhs);
    window.scrollTo(0,0);
}
</script>
