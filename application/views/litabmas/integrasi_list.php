<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-shuffle me-2"></i>Integrasi Penelitian/PkM (5.b)</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Integrasi</li>
            </ol>
        </nav>
    </div>
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="resetForm()">
        <i class="bi bi-plus-lg me-1"></i>Tambah Data
    </button>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-sm mb-0 text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Judul Penelitian/PkM</th>
                        <th width="20%">Nama Dosen</th>
                        <th width="20%">Mata Kuliah</th>
                        <th width="20%">Bentuk Integrasi</th>
                        <th width="5%">Tahun</th>
                        <th width="5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                    <tr>
                        <td colspan="7" class="py-4 text-muted">Belum ada data integrasi.</td>
                    </tr>
                    <?php else: foreach ($records as $idx => $r): ?>
                    <tr>
                        <td><?= $idx + 1 ?></td>
                        <td class="text-start"><?= $r->judul ?></td>
                        <td class="text-start"><?= $r->nama_dosen ?></td>
                        <td class="text-start"><?= $r->nama_mk ?></td>
                        <td class="text-start"><?= $r->bentuk_integrasi ?></td>
                        <td><?= $r->tahun ?></td>
                        <td>
                            <button class="btn btn-sm btn-link p-0 me-1" onclick='editData(<?= json_encode($r) ?>)'>
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <a href="<?= base_url('litabmas/integrasi_delete/'.$r->id) ?>" class="btn btn-sm btn-link p-0 text-danger" onclick="return confirm('Hapus data ini?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalForm" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('litabmas/integrasi_save') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data Integrasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Penelitian/PkM</label>
                        <input type="text" class="form-control" name="judul" id="field-judul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Dosen</label>
                        <select class="form-select" name="dosen_id" id="field-dosen" required>
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($list_dosen as $d): ?>
                                <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mata Kuliah</label>
                        <select class="form-select" name="matakuliah_id" id="field-mk" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            <?php foreach ($list_mk as $m): ?>
                                <option value="<?= $m->id ?>"><?= $m->nama_mk ?> (<?= $m->kode_mk ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Bentuk Integrasi</label>
                        <textarea class="form-control" name="bentuk_integrasi" id="field-bentuk" rows="2" placeholder="Contoh: Modul, Studi Kasus, Bahan Ajar"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="field-tahun" value="<?= date('Y') ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function resetForm() {
    $('#field-id').val('');
    $('#field-judul').val('');
    $('#field-dosen').val('');
    $('#field-mk').val('');
    $('#field-bentuk').val('');
    $('#modalTitle').text('Tambah Data Integrasi');
}

function editData(data) {
    $('#field-id').val(data.id);
    $('#field-judul').val(data.judul);
    $('#field-dosen').val(data.dosen_id);
    $('#field-mk').val(data.matakuliah_id);
    $('#field-bentuk').val(data.bentuk_integrasi);
    $('#field-tahun').val(data.tahun);
    $('#modalTitle').text('Edit Data Integrasi');
    $('#modalForm').modal('show');
}
</script>
