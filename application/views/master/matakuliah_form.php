<div class="page-header">
    <h4><i class="bi bi-journal-plus me-2"></i><?= $page_title ?></h4>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="<?= base_url('master_data/matakuliah_save/'.($record ? $record->id : '')) ?>" method="POST">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-bold">Kode Mata Kuliah</label>
                    <input type="text" class="form-control" name="kode_mk" value="<?= $record ? $record->kode_mk : '' ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Mata Kuliah</label>
                    <input type="text" class="form-control" name="nama_mk" value="<?= $record ? $record->nama_mk : '' ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Semester</label>
                    <input type="number" class="form-control" name="semester" value="<?= $record ? $record->semester : '' ?>" required>
                </div>

                <div class="col-12">
                    <hr>
                    <h6 class="text-primary fw-bold">Bobot Kredit (sks)</h6>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Kuliah/Responsi/Tutorial</label>
                    <input type="number" class="form-control" name="sks_kuliah" value="<?= $record ? $record->sks_kuliah : 0 ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Seminar</label>
                    <input type="number" class="form-control" name="sks_seminar" value="<?= $record ? $record->sks_seminar : 0 ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Praktikum / Praktik Lapangan</label>
                    <input type="number" class="form-control" name="sks_praktikum" value="<?= $record ? $record->sks_praktikum : 0 ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Konversi Kredit ke Jam</label>
                    <input type="number" step="0.1" class="form-control" name="konversi_jam" value="<?= $record ? $record->konversi_jam : 0 ?>">
                </div>

                <div class="col-12">
                    <hr>
                    <h6 class="text-primary fw-bold">Capaian Pembelajaran (CPL)</h6>
                </div>
                <div class="col-md-3">
                    <div class="form-check form-switch card p-3 shadow-none border">
                        <input class="form-check-input ms-0" type="checkbox" name="cpl_sikap" id="cpl1" <?= ($record && $record->cpl_sikap) ? 'checked' : '' ?>>
                        <label class="form-check-label ms-2 fw-bold" for="cpl1">Sikap</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check form-switch card p-3 shadow-none border">
                        <input class="form-check-input ms-0" type="checkbox" name="cpl_pengetahuan" id="cpl2" <?= ($record && $record->cpl_pengetahuan) ? 'checked' : '' ?>>
                        <label class="form-check-label ms-2 fw-bold" for="cpl2">Pengetahuan</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check form-switch card p-3 shadow-none border">
                        <input class="form-check-input ms-0" type="checkbox" name="cpl_ku" id="cpl3" <?= ($record && $record->cpl_ku) ? 'checked' : '' ?>>
                        <label class="form-check-label ms-2 fw-bold" for="cpl3">Keterampilan Umum</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check form-switch card p-3 shadow-none border">
                        <input class="form-check-input ms-0" type="checkbox" name="cpl_kk" id="cpl4" <?= ($record && $record->cpl_kk) ? 'checked' : '' ?>>
                        <label class="form-check-label ms-2 fw-bold" for="cpl4">Keterampilan Khusus</label>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                </div>
                <div class="col-md-4">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="is_kompetensi" id="comp" <?= ($record && $record->is_kompetensi) ? 'checked' : '' ?>>
                        <label class="form-check-label fw-bold" for="comp">Mata Kuliah Kompetensi</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Unit Penyelenggara</label>
                    <input type="text" class="form-control" name="unit_penyelenggara" value="<?= $record ? $record->unit_penyelenggara : '' ?>" placeholder="Contoh: Jurusan Teknik Mesin">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Link RPS / Dokumen Pembelajaran</label>
                    <input type="text" class="form-control" name="rps_link" value="<?= $record ? $record->rps_link : '' ?>" placeholder="https://drive.google.com/...">
                </div>

                <div class="col-12 text-end mt-4">
                    <a href="<?= base_url('master_data/matakuliah') ?>" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-5">Simpan Data Kurikulum</button>
                </div>
            </div>
        </form>
    </div>
</div>
