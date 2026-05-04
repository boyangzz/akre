<div class="page-header">
    <h4><i class="bi bi-pencil me-2"></i>Edit Aturan: <?= $record->kode_tabel ?></h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('setup/borang') ?>">Pengaturan</a></li>
            <li class="breadcrumb-item active">Edit Aturan</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?= base_url('setup/borang_save/' . $record->id) ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Tabel</label>
                    <input type="text" class="form-control" name="nama_tabel" value="<?= $record->nama_tabel ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Urutan Menu</label>
                    <input type="number" class="form-control" name="urutan" value="<?= $record->urutan ?>" required>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="is_wajib" value="1" <?= $record->is_wajib ? 'checked' : '' ?>>
                        <label class="form-check-label">Tabel Wajib Isi</label>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">Berlaku untuk Jenjang:</label>
                    <div class="d-flex flex-wrap gap-3 p-3 bg-light rounded border">
                        <?php 
                        $current_filters = json_decode($record->jenjang_filter);
                        foreach (['D3','STr','S1','S2','S2T','S3','S3T'] as $j): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="jenjang_filter[]" value="<?= $j ?>" <?= in_array($j, $current_filters) ? 'checked' : '' ?>>
                            <label class="form-check-label"><?= $j ?></label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('setup/borang') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
