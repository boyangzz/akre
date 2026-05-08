<div class="page-header">
    <h4><i class="bi bi-journal-text me-2"></i>Publikasi Ilmiah DTPS (3.b.4)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Publikasi DTPS</li>
        </ol>
    </nav>
</div>

<?php 
// Logika Penentuan Label Baris 8-10 berdasarkan Jenjang
$is_vokasi = (isset($current_jenjang) && (strpos(strtolower($current_jenjang), 'd3') !== false || strpos(strtolower($current_jenjang), 'terapan') !== false));

$label_8 = $is_vokasi ? 'Pagelaran/Pameran/Presentasi Tingkat Wilayah' : 'Tulisan di Media Massa Wilayah';
$label_9 = $is_vokasi ? 'Pagelaran/Pameran/Presentasi Tingkat Nasional' : 'Tulisan di Media Massa Nasional';
$label_10 = $is_vokasi ? 'Pagelaran/Pameran/Presentasi Tingkat Internasional' : 'Tulisan di Media Massa Internasional';

$types = [
    'jurnal_nasional_tdk_terakreditasi' => '1. Jurnal penelitian tidak terakreditasi',
    'jurnal_nasional_terakreditasi' => '2. Jurnal penelitian nasional terakreditasi',
    'jurnal_internasional' => '3. Jurnal penelitian internasional',
    'jurnal_internasional_bereputasi' => '4. Jurnal penelitian internasional bereputasi',
    'seminar_wilayah' => '5. Seminar wilayah/lokal/perguruan tinggi',
    'seminar_nasional' => '6. Seminar nasional',
    'seminar_internasional' => '7. Seminar internasional',
    'karya_8' => '8. ' . $label_8,
    'karya_9' => '9. ' . $label_9,
    'karya_10' => '10. ' . $label_10
];
?>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">Input Data Publikasi</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('sumber_daya/publikasi_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Publikasi</label>
                        <select class="form-select" name="jenis" id="field-jenis" required>
                            <option value="">-- Pilih Jenis --</option>
                            <?php foreach ($types as $k => $v): ?>
                                <option value="<?= $k ?>"><?= $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tahun Akademik</label>
                        <select class="form-select" name="tahun_akademik" id="field-tahun" required>
                            <option value="TS">TS</option>
                            <option value="TS-1">TS-1</option>
                            <option value="TS-2">TS-2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jumlah Judul</label>
                        <input type="number" class="form-control" name="jumlah_judul" id="field-judul" value="0" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                    <button type="reset" class="btn btn-link btn-sm w-100 mt-2" onclick="$('#field-id').val('')">Reset Form</button>
                </form>
            </div>
        </div>
        
        <div class="alert alert-info mt-3" style="font-size: 0.85rem;">
            <i class="bi bi-info-circle me-1"></i> <strong>Mode Deteksi Otomatis:</strong><br>
            Sistem mendeteksi jenjang prodi Anda adalah <strong><?= $current_jenjang ?></strong>, sehingga label baris 8-10 disesuaikan secara otomatis.
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm mb-0 text-center align-middle">
                        <thead class="table-dark" style="font-size: 0.8rem;">
                            <tr>
                                <th rowspan="2" width="50%">Jenis Publikasi</th>
                                <th colspan="3">Jumlah Judul</th>
                                <th rowspan="2">Jumlah</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>TS-2</th>
                                <th>TS-1</th>
                                <th>TS</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.85rem;">
                            <?php 
                            $grand_total = 0;
                            foreach ($types as $key => $label): 
                                $ts2 = 0; $ts1 = 0; $ts = 0; $row_id = null;
                                foreach ($records as $r) {
                                    if ($r->jenis == $key) {
                                        if ($r->tahun_akademik == 'TS-2') { $ts2 = $r->jumlah_judul; }
                                        if ($r->tahun_akademik == 'TS-1') { $ts1 = $r->jumlah_judul; }
                                        if ($r->tahun_akademik == 'TS')   { $ts = $r->jumlah_judul; }
                                    }
                                }
                                $row_total = $ts2 + $ts1 + $ts;
                                $grand_total += $row_total;
                            ?>
                            <tr>
                                <td class="text-start px-2"><?= $label ?></td>
                                <td class="<?= $ts2 > 0 ? 'fw-bold text-primary' : 'text-muted' ?>"><?= $ts2 ?></td>
                                <td class="<?= $ts1 > 0 ? 'fw-bold text-primary' : 'text-muted' ?>"><?= $ts1 ?></td>
                                <td class="<?= $ts > 0 ? 'fw-bold text-primary' : 'text-muted' ?>"><?= $ts ?></td>
                                <td class="fw-bold bg-light"><?= $row_total ?></td>
                                <td>
                                    <button class="btn btn-sm btn-link p-0" onclick="editRow('<?= $key ?>','<?= $ts2 ?>','<?= $ts1 ?>','<?= $ts ?>')">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-secondary fw-bold">
                            <tr>
                                <td class="text-end px-2">Jumlah</td>
                                <td colspan="3"></td>
                                <td><?= $grand_total ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function editRow(jenis, ts2, ts1, ts) {
    // Mode edit di sini lebih mudah dengan pilih tahun di form
    $('#field-jenis').val(jenis);
    // Kita arahkan user untuk memilih tahun mana yang mau diupdate angkanya di form
    alert('Silakan pilih Tahun (TS/TS-1/TS-2) di form untuk memperbarui angka pada baris ini.');
    window.scrollTo(0,0);
}
</script>
