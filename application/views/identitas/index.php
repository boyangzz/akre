<div class="page-header">
    <h4><i class="bi bi-building me-2"></i>Identitas Pengusul</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li><li class="breadcrumb-item active">Identitas</li></ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <?php $r = isset($record) ? $record : null; ?>
        <form method="POST" action="<?= base_url('identitas/update') ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Perguruan Tinggi</label>
                    <input type="text" class="form-control" name="nama_pt" value="<?= $r ? $r->nama_pt : '' ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fakultas</label>
                    <input type="text" class="form-control" name="nama_fakultas" value="<?= $r ? $r->nama_fakultas : '' ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Program Studi</label>
                    <input type="text" class="form-control" name="nama_prodi" value="<?= $r ? $r->nama_prodi : '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jenjang *</label>
                    <select class="form-select" name="jenjang" id="jenjang-selector">
                        <?php foreach (['D3','STr','S1','S2','S2T','S3','S3T'] as $j): ?>
                            <option value="<?= $j ?>" <?= ($r && $r->jenjang == $j) ? 'selected' : '' ?>><?= $j ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-text">Mengubah jenjang akan menyesuaikan menu & form yang tersedia.</div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Peringkat Akreditasi</label>
                    <input type="text" class="form-control" name="peringkat_akreditasi" value="<?= $r ? $r->peringkat_akreditasi : '' ?>">
                </div>
                <div class="col-md-8">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" value="<?= $r ? $r->alamat : '' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Telepon</label>
                    <input type="text" class="form-control" name="telepon" value="<?= $r ? $r->telepon : '' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $r ? $r->email : '' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Website</label>
                    <input type="url" class="form-control" name="website" value="<?= $r ? $r->website : '' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">No. SK BAN-PT</label>
                    <input type="text" class="form-control" name="no_sk_banpt" value="<?= $r ? $r->no_sk_banpt : '' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Kadaluarsa</label>
                    <input type="date" class="form-control" name="tanggal_kadaluarsa" value="<?= $r ? $r->tanggal_kadaluarsa : '' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nama Kaprodi</label>
                    <input type="text" class="form-control" name="kaprodi_nama" value="<?= $r ? $r->kaprodi_nama : '' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">NIDN Kaprodi</label>
                    <input type="text" class="form-control" name="kaprodi_nidn" value="<?= $r ? $r->kaprodi_nidn : '' ?>">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
        </form>
    </div>
</div>
