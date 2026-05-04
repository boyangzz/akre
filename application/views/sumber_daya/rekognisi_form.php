<div class="page-header">
    <h4><i class="bi bi-award me-2"></i><?= isset($record) ? 'Edit' : 'Tambah' ?> Rekognisi DTPS</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('sumber_daya/rekognisi') ?>">Rekognisi</a></li>
            <li class="breadcrumb-item active"><?= isset($record) ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <?php $r = isset($record) ? $record : null; ?>
        <form method="POST" action="<?= base_url('sumber_daya/rekognisi_save' . ($r ? '/' . $r->id : '')) ?>">
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
                    <label class="form-label">Bidang Keahlian</label>
                    <input type="text" class="form-control" name="bidang_keahlian" value="<?= $r ? $r->bidang_keahlian : '' ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Rekognisi dan Bukti Pendukung *</label>
                    <textarea class="form-control" name="rekognisi" rows="3" placeholder="Sebutkan pengakuan/rekognisi yang diterima..." required><?= $r ? $r->rekognisi : '' ?></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Bukti Rekognisi (URL / Nomor Sertifikat)</label>
                    <input type="text" class="form-control" name="bukti" value="<?= $r ? $r->bukti : '' ?>" placeholder="http://...">
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('sumber_daya/rekognisi') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
