<div class="page-header">
    <h4><i class="bi bi-hourglass-split me-2"></i>Waktu Tunggu Lulusan (8.d.1)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Waktu Tunggu</li>
        </ol>
    </nav>
</div>

<?php 
$jenjang = $this->session->userdata('jenjang') ?: 'S1';
$isD3 = ($jenjang == 'D3');

// Define labels based on level
$labels = [
    'D3' => ['< 3 bln', '3 - 6 bln', '> 6 bln'],
    'S1' => ['< 6 bln', '6 - 18 bln', '> 18 bln'],
    'S1 Terapan' => ['< 3 bln', '3 - 6 bln', '> 6 bln'],
];
$l = $labels[$jenjang] ?? $labels['S1'];
?>

<div class="alert alert-info border-info shadow-sm mb-4">
    <i class="bi bi-info-circle-fill me-2"></i>
    Format tabel disesuaikan untuk jenjang <strong><?= $jenjang ?></strong>.
    <?php if($isD3): ?>
        <span class="badge bg-warning text-dark ms-2">Kolom 'Dipesan' Aktif</span>
    <?php endif; ?>
</div>

<form action="<?= base_url('luaran/waktu_tunggu_save_bulk') ?>" method="POST">
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0 text-center align-middle" style="font-size: 0.8rem;">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2" width="10%">Tahun Lulus</th>
                            <th rowspan="2" width="10%">Jumlah Lulusan</th>
                            <th rowspan="2" width="10%">Jumlah Lulusan Terlacak</th>
                            <?php if($isD3): ?>
                                <th rowspan="2" width="15%">Jml Lulusan Dipesan Sebelum Lulus</th>
                            <?php endif; ?>
                            <th colspan="3">Jumlah Lulusan Terlacak dengan Waktu Tunggu Mendapatkan Pekerjaan</th>
                        </tr>
                        <tr class="table-secondary text-dark">
                            <th><?= $l[0] ?></th>
                            <th><?= $l[1] ?></th>
                            <th><?= $l[2] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tahuns = ['TS-4', 'TS-3', 'TS-2'];
                        foreach ($tahuns as $idx => $thn): 
                            $existing = null;
                            foreach ($records as $r) {
                                if ($r->tahun_lulus == $thn) { $existing = $r; break; }
                            }
                        ?>
                        <tr class="row-wt">
                            <td class="fw-bold bg-light">
                                <?= $thn ?>
                                <input type="hidden" name="data[<?= $idx ?>][tahun_lulus]" value="<?= $thn ?>">
                                <input type="hidden" name="data[<?= $idx ?>][id]" value="<?= $existing ? $existing->id : '' ?>">
                            </td>
                            <td><input type="number" name="data[<?= $idx ?>][jml_lulusan]" class="form-control form-control-sm text-end input-lulusan" value="<?= $existing ? $existing->jml_lulusan : 0 ?>"></td>
                            <td><input type="number" name="data[<?= $idx ?>][jml_terlacak]" class="form-control form-control-sm text-end input-terlacak" value="<?= $existing ? $existing->jml_terlacak : 0 ?>"></td>
                            
                            <?php if($isD3): ?>
                                <td><input type="number" name="data[<?= $idx ?>][jml_dipesan]" class="form-control form-control-sm text-end" value="<?= $existing ? $existing->jml_dipesan : 0 ?>"></td>
                            <?php endif; ?>

                            <td><input type="number" name="data[<?= $idx ?>][wt_low]" class="form-control form-control-sm text-end input-val" value="<?= $existing ? $existing->wt_low : 0 ?>"></td>
                            <td><input type="number" name="data[<?= $idx ?>][wt_mid]" class="form-control form-control-sm text-end input-val" value="<?= $existing ? $existing->wt_mid : 0 ?>"></td>
                            <td><input type="number" name="data[<?= $idx ?>][wt_high]" class="form-control form-control-sm text-end input-val" value="<?= $existing ? $existing->wt_high : 0 ?>"></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td>Jumlah</td>
                            <td id="total-lulusan">0</td>
                            <td id="total-terlacak">0</td>
                            <?php if($isD3): ?> <td id="total-dipesan">0</td> <?php endif; ?>
                            <td id="total-low">0</td>
                            <td id="total-mid">0</td>
                            <td id="total-high">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light py-3 text-center">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-save2 me-2"></i>Simpan Seluruh Data Waktu Tunggu
            </button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        let cols = ['lulusan', 'terlacak', 'low', 'mid', 'high'];
        if (document.getElementById('total-dipesan')) cols.push('dipesan');

        cols.forEach(col => {
            let sum = 0;
            let inputs = document.querySelectorAll('.input-' + col);
            if (col == 'low' || col == 'mid' || col == 'high') inputs = document.querySelectorAll(`[name$="[wt_${col}]"]`);
            if (col == 'dipesan') inputs = document.querySelectorAll(`[name$="[jml_dipesan]"]`);

            inputs.forEach(i => sum += parseInt(i.value) || 0);
            document.getElementById('total-' + col).innerText = sum.toLocaleString('id-ID');
        });
    }

    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', calculate);
    });

    calculate();
});
</script>
