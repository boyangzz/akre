<div class="page-header">
    <h4><i class="bi bi-book me-2"></i><?= isset($record) ? 'Edit' : 'Tambah' ?> Mata Kuliah</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('master_data/matakuliah') ?>">Mata Kuliah</a></li>
            <li class="breadcrumb-item active"><?= isset($record) ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <?php $r = isset($record) ? $record : null; ?>
        <form method="POST" action="<?= base_url('master_data/matakuliah_save' . ($r ? '/' . $r->id : '')) ?>">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Kode MK *</label>
                    <input type="text" class="form-control" name="kode_mk" value="<?= $r ? $r->kode_mk : '' ?>" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Nama Mata Kuliah *</label>
                    <input type="text" class="form-control" name="nama_mk" value="<?= $r ? $r->nama_mk : '' ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Semester *</label>
                    <input type="number" class="form-control" name="semester" value="<?= $r ? $r->semester : '1' ?>" min="1" max="14" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Jenis MK *</label>
                    <select class="form-select" name="jenis_mk" required>
                        <option value="wajib" <?= ($r && $r->jenis_mk == 'wajib') ? 'selected' : '' ?>>Wajib</option>
                        <option value="pilihan" <?= ($r && $r->jenis_mk == 'pilihan') ? 'selected' : '' ?>>Pilihan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">SKS Teori</label>
                    <input type="number" class="form-control" name="sks_teori" value="<?= $r ? $r->sks_teori : '2' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">SKS Praktek</label>
                    <input type="number" class="form-control" name="sks_praktek" value="<?= $r ? $r->sks_praktek : '1' ?>">
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('master_data/matakuliah') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
