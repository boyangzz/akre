<div class="page-header">
    <h4><i class="bi bi-people me-2"></i><?= isset($record) ? 'Edit' : 'Tambah' ?> Mahasiswa</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('master_data/mahasiswa') ?>">Mahasiswa</a></li>
            <li class="breadcrumb-item active"><?= isset($record) ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <?php $r = isset($record) ? $record : null; ?>
        <form method="POST" action="<?= base_url('master_data/mahasiswa_save' . ($r ? '/' . $r->id : '')) ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">NIM *</label>
                    <input type="text" class="form-control" name="nim" value="<?= $r ? $r->nim : '' ?>" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" class="form-control" name="nama" value="<?= $r ? $r->nama : '' ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Angkatan *</label>
                    <input type="number" class="form-control" name="angkatan" value="<?= $r ? $r->angkatan : date('Y') ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jenis</label>
                    <select class="form-select" name="jenis">
                        <option value="reguler" <?= ($r && $r->jenis == 'reguler') ? 'selected' : '' ?>>Reguler</option>
                        <option value="transfer" <?= ($r && $r->jenis == 'transfer') ? 'selected' : '' ?>>Transfer</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="aktif" <?= ($r && $r->status == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                        <option value="lulus" <?= ($r && $r->status == 'lulus') ? 'selected' : '' ?>>Lulus</option>
                        <option value="cuti" <?= ($r && $r->status == 'cuti') ? 'selected' : '' ?>>Cuti</option>
                        <option value="do" <?= ($r && $r->status == 'do') ? 'selected' : '' ?>>Drop Out</option>
                        <option value="transfer" <?= ($r && $r->status == 'transfer') ? 'selected' : '' ?>>Transfer</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('master_data/mahasiswa') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
