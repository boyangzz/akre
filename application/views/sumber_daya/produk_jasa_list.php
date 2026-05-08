<div class="page-header d-flex justify-content-between align-items-start">
    <div>
        <h4><i class="bi bi-gear-wide-connected me-2"></i>Produk/Jasa DTPS yang Diadopsi (3.b.6)</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Produk/Jasa</li>
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
                        <th width="20%">Nama Dosen</th>
                        <th width="20%">Nama Produk/Jasa</th>
                        <th width="30%">Deskripsi Produk/Jasa</th>
                        <th width="15%">Bukti</th>
                        <th width="5%">Tahun</th>
                        <th width="5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                    <tr>
                        <td colspan="7" class="py-4 text-muted">Belum ada data produk/jasa.</td>
                    </tr>
                    <?php else: foreach ($records as $idx => $r): ?>
                    <tr>
                        <td><?= $idx + 1 ?></td>
                        <td class="text-start"><?= $r->nama_dosen ?></td>
                        <td class="text-start"><?= $r->nama_produk ?></td>
                        <td class="text-start"><?= $r->deskripsi ?></td>
                        <td class="text-start"><?= $r->bukti ?></td>
                        <td><?= $r->tahun ?></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" onclick='editData(<?= json_encode($r) ?>)'>
                                <i class="bi bi-pencil"></i>
                            </button>
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
            <form action="<?= base_url('sumber_daya/produk_jasa_save') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Produk/Jasa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label">Nama Dosen</label>
                        <select class="form-select" name="dosen_id" id="field-dosen" required>
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach ($list_dosen as $d): ?>
                                <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Produk/Jasa</label>
                        <input type="text" class="form-control" name="nama_produk" id="field-nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="field-deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bukti</label>
                        <input type="text" class="form-control" name="bukti" id="field-bukti" placeholder="Contoh: No. Sertifikat / Link Website">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
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
    $('#field-dosen').val('');
    $('#field-nama').val('');
    $('#field-deskripsi').val('');
    $('#field-bukti').val('');
    $('#modalTitle').text('Tambah Produk/Jasa');
}

function editData(data) {
    $('#field-id').val(data.id);
    $('#field-dosen').val(data.dosen_id);
    $('#field-nama').val(data.nama_produk);
    $('#field-deskripsi').val(data.deskripsi);
    $('#field-bukti').val(data.bukti);
    $('#field-tahun').val(data.tahun);
    $('#modalTitle').text('Edit Produk/Jasa');
    $('#modalForm').modal('show');
}
</script>
