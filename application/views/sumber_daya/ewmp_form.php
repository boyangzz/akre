<div class="page-header">
    <h4><i class="bi bi-calculator me-2"></i><?= isset($record) ? 'Edit' : 'Tambah' ?> Data EWMP</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('sumber_daya/ewmp') ?>">EWMP</a></li>
            <li class="breadcrumb-item active"><?= isset($record) ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <?php $r = isset($record) ? $record : null; ?>
        <form method="POST" action="<?= base_url('sumber_daya/ewmp_save' . ($r ? '/' . $r->id : '')) ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Dosen Tetap *</label>
                    <select class="form-select" name="dosen_id" required>
                        <option value="">-- Pilih Dosen --</option>
                        <?php foreach ($list_dosen as $d): ?>
                            <option value="<?= $d->id ?>" <?= ($r && $r->dosen_id == $d->id) ? 'selected' : '' ?>><?= $d->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tahun Akademik *</label>
                    <input type="text" class="form-control" name="tahun_akademik" value="<?= $r ? $r->tahun_akademik : '' ?>" placeholder="Contoh: 2023/2024" required>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">SKS Pendidikan (PS Sendiri)</label>
                    <input type="number" step="0.01" class="form-control" name="sks_pendidikan_ps" value="<?= $r ? $r->sks_pendidikan_ps : '0' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">SKS Pendidikan (PS Lain)</label>
                    <input type="number" step="0.01" class="form-control" name="sks_pendidikan_luar" value="<?= $r ? $r->sks_pendidikan_luar : '0' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">SKS Penelitian</label>
                    <input type="number" step="0.01" class="form-control" name="sks_penelitian" value="<?= $r ? $r->sks_penelitian : '0' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">SKS PkM</label>
                    <input type="number" step="0.01" class="form-control" name="sks_pkm" value="<?= $r ? $r->sks_pkm : '0' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">SKS Tugas Tambahan / Penunjang</label>
                    <input type="number" step="0.01" class="form-control" name="sks_tugas_tambahan" value="<?= $r ? $r->sks_tugas_tambahan : '0' ?>">
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('sumber_daya/ewmp') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
