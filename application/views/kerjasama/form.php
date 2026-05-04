<div class="page-header">
    <h4><i class="bi bi-handshake me-2"></i><?= isset($record) ? 'Edit' : 'Tambah' ?> Kerjasama</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('kerjasama') ?>">Kerjasama</a></li>
            <li class="breadcrumb-item active"><?= isset($record) ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <?php $r = isset($record) ? $record : null; ?>
        <form method="POST" action="<?= base_url('kerjasama/save' . ($r ? '/' . $r->id : '')) ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Lembaga Mitra *</label>
                    <input type="text" class="form-control" name="lembaga_mitra" value="<?= $r ? $r->lembaga_mitra : '' ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tingkat *</label>
                    <select class="form-select" name="tingkat" required>
                        <option value="lokal" <?= ($r && $r->tingkat == 'lokal') ? 'selected' : '' ?>>Lokal / Wilayah</option>
                        <option value="nasional" <?= ($r && $r->tingkat == 'nasional') ? 'selected' : '' ?>>Nasional</option>
                        <option value="internasional" <?= ($r && $r->tingkat == 'internasional') ? 'selected' : '' ?>>Internasional</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jenis Kerjasama *</label>
                    <select class="form-select" name="jenis_kerjasama" required>
                        <option value="pendidikan" <?= ($r && $r->jenis_kerjasama == 'pendidikan') ? 'selected' : '' ?>>Pendidikan</option>
                        <option value="penelitian" <?= ($r && $r->jenis_kerjasama == 'penelitian') ? 'selected' : '' ?>>Penelitian</option>
                        <option value="pkm" <?= ($r && $r->jenis_kerjasama == 'pkm') ? 'selected' : '' ?>>PkM</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Judul Kegiatan Kerjasama</label>
                    <input type="text" class="form-control" name="judul_kegiatan" value="<?= $r ? $r->judul_kegiatan : '' ?>">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Manfaat bagi PS yang Diakreditasi</label>
                    <textarea class="form-control" name="manfaat" rows="3"><?= $r ? $r->manfaat : '' ?></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Waktu dan Durasi</label>
                    <input type="text" class="form-control" name="waktu_durasi" value="<?= $r ? $r->waktu_durasi : '' ?>" placeholder="Contoh: 3 Tahun (2021-2024)">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bukti Kerjasama (URL/Path)</label>
                    <input type="text" class="form-control" name="bukti" value="<?= $r ? $r->bukti : '' ?>" placeholder="http://...">
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('kerjasama') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Batal</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan Data</button>
            </div>
        </form>
    </div>
</div>
