<div class="page-header">
    <h4><i class="bi bi-person-badge me-2"></i><?= isset($record) && $record ? 'Edit' : 'Tambah' ?> Dosen</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('master_data/dosen') ?>">Dosen</a></li>
            <li class="breadcrumb-item active"><?= isset($record) && $record ? 'Edit' : 'Tambah' ?></li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <?php $r = isset($record) ? $record : null; ?>
        <form method="POST" action="<?= base_url('master_data/dosen_save' . ($r ? '/' . $r->id : '')) ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">NIDN *</label>
                    <input type="text" class="form-control" name="nidn" value="<?= $r ? $r->nidn : '' ?>" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" class="form-control" name="nama" value="<?= $r ? $r->nama : '' ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pendidikan Pasca</label>
                    <select class="form-select" name="pendidikan_pasca">
                        <option value="S2" <?= ($r && $r->pendidikan_pasca == 'S2') ? 'selected' : '' ?>>S2</option>
                        <option value="S3" <?= ($r && $r->pendidikan_pasca == 'S3') ? 'selected' : '' ?>>S3</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jabatan Akademik</label>
                    <select class="form-select" name="jabatan_akademik">
                        <?php foreach (['Tenaga Pengajar','Asisten Ahli','Lektor','Lektor Kepala','Guru Besar'] as $jab): ?>
                            <option value="<?= $jab ?>" <?= ($r && $r->jabatan_akademik == $jab) ? 'selected' : '' ?>><?= $jab ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status Ikatan</label>
                    <select class="form-select" name="status_ikatan">
                        <option value="tetap" <?= ($r && $r->status_ikatan == 'tetap') ? 'selected' : '' ?>>Tetap</option>
                        <option value="tidak_tetap" <?= ($r && $r->status_ikatan == 'tidak_tetap') ? 'selected' : '' ?>>Tidak Tetap</option>
                        <option value="industri" <?= ($r && $r->status_ikatan == 'industri') ? 'selected' : '' ?>>Industri/Praktisi</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bidang Keahlian</label>
                    <input type="text" class="form-control" name="bidang_keahlian" value="<?= $r ? $r->bidang_keahlian : '' ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sertifikat Kompetensi</label>
                    <input type="text" class="form-control" name="sertifikat_kompetensi" value="<?= $r ? $r->sertifikat_kompetensi : '' ?>">
                </div>
                <div class="col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="kesesuaian_kompetensi" value="1" <?= ($r && $r->kesesuaian_kompetensi) ? 'checked' : '' ?>>
                        <label class="form-check-label">Kesesuaian Kompetensi</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="sertifikat_pendidik" value="1" <?= ($r && $r->sertifikat_pendidik) ? 'checked' : '' ?>>
                        <label class="form-check-label">Sertifikat Pendidik</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="status_aktif" value="1" <?= (!$r || $r->status_aktif) ? 'checked' : '' ?>>
                        <label class="form-check-label">Aktif</label>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
            <a href="<?= base_url('master_data/dosen') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Batal</a>
        </form>
    </div>
</div>
