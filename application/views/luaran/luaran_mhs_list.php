<?php
// Mapping Categories to BAN-PT Excel Standards
if (strpos($page_title, '8.f.1') !== false) {
    $kode_asal = '8f1';
    $jenis_options = [
        'Jurnal penelitian tidak terakreditasi',
        'Jurnal penelitian nasional terakreditasi',
        'Jurnal penelitian internasional',
        'Jurnal penelitian internasional bereputasi',
        'Seminar wilayah/lokal/perguruan tinggi',
        'Seminar nasional',
        'Seminar internasional',
        'Pagelaran/pameran/presentasi (Wilayah)',
        'Pagelaran/pameran/presentasi (Nasional)',
        'Pagelaran/pameran/presentasi (Internasional)'
    ];
} elseif (strpos($page_title, '8.f.4') !== false) {
    $kode_asal = '8f4';
    $jenis_options = [
        'Paten (8f4-1)',
        'Paten Sederhana (8f4-1)',
        'Hak Cipta (8f4-2)',
        'Teknologi Tepat Guna (8f4-3)',
        'Produk / Karya Seni / Rekayasa Sosial (8f4-3)',
        'Buku Ber-ISBN / Book Chapter (8f4-4)',
        'Desain Industri / Rahasia Dagang'
    ];
} elseif (strpos($page_title, '8.f.3') !== false) {
    $kode_asal = '8f3';
    $jenis_options = ['Produk yang mendapatkan HKI','Produk yang diadopsi oleh Industri','Produk yang diadopsi oleh Masyarakat'];
} else {
    $kode_asal = '8f2';
    $jenis_options = ['Karya Ilmiah Mahasiswa yang Disitasi'];
}

// Logic for Summary Table (Excel-like)
$ts_year = date('Y');
$summary = [];
foreach($jenis_options as $j) {
    $summary[$j] = ['ts' => 0, 'ts1' => 0, 'ts2' => 0];
}
foreach($records as $r) {
    if (isset($summary[$r->jenis])) {
        if ($r->tahun == $ts_year) $summary[$r->jenis]['ts']++;
        elseif ($r->tahun == $ts_year - 1) $summary[$r->jenis]['ts1']++;
        elseif ($r->tahun == $ts_year - 2) $summary[$r->jenis]['ts2']++;
    }
}
?>
<div class="page-header">
    <h4><i class="bi bi-mortarboard me-2"></i><?= $page_title ?></h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Luaran</li>
        </ol>
    </nav>
</div>

<?php if (in_array($kode_asal, ['8f1', '8f3', '8f4'])): ?>
<div class="card mb-4 border-info">
    <div class="card-header bg-info text-white py-2">
        <i class="bi bi-table me-2"></i>Ringkasan Tabel <?= strtoupper(str_replace('f', '.f.', $kode_asal)) ?> (Automated Summary)
    </div>
    <div class="card-body p-0">
        <table class="table table-sm table-bordered mb-0 text-center align-middle small">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="align-middle">No</th>
                    <th rowspan="2" class="align-middle text-start">Jenis Publikasi</th>
                    <th colspan="3">Jumlah Judul</th>
                    <th rowspan="2" class="align-middle bg-light">Jumlah</th>
                </tr>
                <tr>
                    <th>TS-2</th>
                    <th>TS-1</th>
                    <th>TS</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; $gt=0; foreach($jenis_options as $j): 
                    $row_total = $summary[$j]['ts'] + $summary[$j]['ts1'] + $summary[$j]['ts2'];
                    $gt += $row_total;
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td class="text-start"><?= $j ?></td>
                    <td><?= $summary[$j]['ts2'] ?></td>
                    <td><?= $summary[$j]['ts1'] ?></td>
                    <td><?= $summary[$j]['ts'] ?></td>
                    <td class="bg-light fw-bold"><?= $row_total ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="table-dark">
                <tr>
                    <th colspan="2" class="text-center">Jumlah</th>
                    <th><?= array_sum(array_column($summary, 'ts2')) ?></th>
                    <th><?= array_sum(array_column($summary, 'ts1')) ?></th>
                    <th><?= array_sum(array_column($summary, 'ts')) ?></th>
                    <th><?= $gt ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php endif; ?>

<div class="row g-3">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header">Input Data</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('luaran/luaran_mhs_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <input type="hidden" name="kode_asal" value="<?= $kode_asal ?>">
                    <div class="mb-3">
                        <label class="form-label">Mahasiswa</label>
                        <select class="form-select" name="mahasiswa_id" id="field-mhs" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            <?php foreach ($list_mhs as $m): ?>
                                <option value="<?= $m->id ?>"><?= $m->nama ?> (<?= $m->nim ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Luaran</label>
                        <select class="form-select" name="jenis" id="field-jenis" required>
                            <?php foreach ($jenis_options as $j): ?>
                                <option value="<?= $j ?>"><?= $j ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="field-judul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" id="field-tahun" value="<?= date('Y') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="field-ket">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                    <button type="reset" class="btn btn-link btn-sm w-100 mt-1" onclick="$('#field-id').val('')">Reset Form</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Jenis</th>
                                <th>Tahun</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($records)): ?>
                                <tr><td colspan="5" class="py-4 text-center text-muted">Belum ada data.</td></tr>
                            <?php else: ?>
                                <?php foreach ($records as $r): ?>
                                <tr>
                                    <td><?= $r->judul ?></td>
                                    <td><span class="badge bg-secondary"><?= $r->jenis ?></span></td>
                                    <td><?= $r->tahun ?></td>
                                    <td><?= $r->keterangan ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-link p-0 me-2" onclick="editRow('<?= $r->id ?>', '<?= $r->mahasiswa_id ?>', '<?= $r->jenis ?>', '<?= addslashes($r->judul) ?>', '<?= $r->tahun ?>', '<?= addslashes($r->keterangan) ?>')"><i class="bi bi-pencil"></i></button>
                                        <a href="<?= base_url('luaran/luaran_mhs_delete/'.$r->id) ?>" class="btn btn-sm btn-link p-0 text-danger" onclick="return confirm('Hapus data luaran ini?')"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function editRow(id, mhs, jenis, judul, tahun, ket) {
    $('#field-id').val(id);
    $('#field-mhs').val(mhs);
    $('#field-jenis').val(jenis);
    $('#field-judul').val(judul);
    $('#field-tahun').val(tahun);
    $('#field-ket').val(ket);
}
</script>
