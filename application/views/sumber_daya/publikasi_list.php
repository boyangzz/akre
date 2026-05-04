<div class="page-header">
    <h4><i class="bi bi-journal-text me-2"></i>Publikasi Ilmiah DTPS (3.b.4)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Publikasi DTPS</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Input Data</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('sumber_daya/publikasi_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label">Jenis Publikasi</label>
                        <select class="form-select" name="jenis" id="field-jenis" required>
                            <option value="jurnal_nasional_tdk_terakreditasi">Jurnal Nasional Tidak Terakreditasi</option>
                            <option value="jurnal_nasional_terakreditasi">Jurnal Nasional Terakreditasi</option>
                            <option value="jurnal_internasional">Jurnal Internasional</option>
                            <option value="jurnal_internasional_bereputasi">Jurnal Internasional Bereputasi</option>
                            <option value="seminar_wilayah">Seminar Wilayah/Lokal/PT</option>
                            <option value="seminar_nasional">Seminar Nasional</option>
                            <option value="seminar_internasional">Seminar Internasional</option>
                            <option value="tulisan_media_massa">Tulisan di Media Massa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun Akademik</label>
                        <input type="text" class="form-control" name="tahun_akademik" id="field-tahun" placeholder="TS / TS-1 / TS-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Judul</label>
                        <input type="number" class="form-control" name="jumlah_judul" id="field-judul" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                    <button type="reset" class="btn btn-link btn-sm w-100 mt-2" onclick="$('#field-id').val('')">Reset Form</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm mb-0 text-center align-middle" style="font-size: 0.75rem;">
                        <thead class="table-dark">
                            <tr>
                                <th>Jenis Publikasi</th>
                                <th>TS-2</th>
                                <th>TS-1</th>
                                <th>TS</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $types = [
                                'jurnal_nasional_tdk_terakreditasi' => 'Jurnal Nasional Tidak Terakreditasi',
                                'jurnal_nasional_terakreditasi' => 'Jurnal Nasional Terakreditasi',
                                'jurnal_internasional' => 'Jurnal Internasional',
                                'jurnal_internasional_bereputasi' => 'Jurnal Internasional Bereputasi',
                                'seminar_wilayah' => 'Seminar Wilayah/Lokal/PT',
                                'seminar_nasional' => 'Seminar Nasional',
                                'seminar_internasional' => 'Seminar Internasional',
                                'tulisan_media_massa' => 'Tulisan di Media Massa'
                            ];
                            foreach ($types as $key => $label): 
                                $ts2 = 0; $ts1 = 0; $ts = 0;
                                foreach ($records as $r) {
                                    if ($r->jenis == $key) {
                                        if ($r->tahun_akademik == 'TS-2') $ts2 = $r->jumlah_judul;
                                        if ($r->tahun_akademik == 'TS-1') $ts1 = $r->jumlah_judul;
                                        if ($r->tahun_akademik == 'TS') $ts = $r->jumlah_judul;
                                    }
                                }
                            ?>
                            <tr>
                                <td class="text-start px-2"><?= $label ?></td>
                                <td><?= $ts2 ?></td>
                                <td><?= $ts1 ?></td>
                                <td><?= $ts ?></td>
                                <td class="fw-bold"><?= $ts2 + $ts1 + $ts ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function editData(id, jenis, tahun, judul) {
    $('#field-id').val(id);
    $('#field-jenis').val(jenis);
    $('#field-tahun').val(tahun);
    $('#field-judul').val(judul);
    window.scrollTo(0,0);
}
</script>
