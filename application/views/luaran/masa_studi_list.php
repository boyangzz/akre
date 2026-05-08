<div class="page-header">
    <h4><i class="bi bi-clock-history me-2"></i>Masa Studi Lulusan (8.c)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Masa Studi</li>
        </ol>
    </nav>
</div>

<?php 
$jenjang = $this->session->userdata('jenjang') ?: 'S1'; // Default to S1 if not set
$config = [
    'D3' => ['start' => 4, 'end' => 2, 'cols' => ['TS-4','TS-3','TS-2','TS-1','TS']],
    'S1' => ['start' => 6, 'end' => 3, 'cols' => ['TS-6','TS-5','TS-4','TS-3','TS-2','TS-1','TS']],
    'S2' => ['start' => 3, 'end' => 1, 'cols' => ['TS-3','TS-2','TS-1','TS']],
    'S3' => ['start' => 6, 'end' => 2, 'cols' => ['TS-6','TS-5','TS-4','TS-3','TS-2','TS-1','TS']],
];

$c = $config[$jenjang] ?? $config['S1'];
$col_count = count($c['cols']);
?>

<div class="alert alert-warning border-warning shadow-sm mb-4">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    Format tabel di bawah otomatis menyesuaikan jenjang <strong><?= $jenjang ?></strong>. 
    Kolom <strong>Jumlah s.d. Akhir TS</strong> akan dihitung otomatis.
</div>

<form action="<?= base_url('luaran/masa_studi_save_bulk') ?>" method="POST">
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0 text-center align-middle" style="font-size: 0.8rem;">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2" width="10%">Tahun Masuk</th>
                            <th rowspan="2" width="10%">Jumlah Mhs Diterima</th>
                            <th colspan="<?= $col_count ?>">Jumlah Mahasiswa yang lulus pada</th>
                            <th rowspan="2" width="10%" class="bg-primary">Jumlah Lulusan s.d. Akhir TS</th>
                            <th rowspan="2" width="10%">Rata-rata Masa Studi</th>
                        </tr>
                        <tr class="table-secondary text-dark">
                            <?php foreach($c['cols'] as $col): ?>
                                <th>Akhir <?= $col ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        for ($i = $c['start']; $i >= $c['end']; $i--): 
                            $thn_label = "TS-$i";
                            $existing = null;
                            foreach ($records as $r) {
                                if ($r->tahun_masuk == $thn_label) { $existing = $r; break; }
                            }
                        ?>
                        <tr class="row-studi">
                            <td class="fw-bold bg-light">
                                <?= $thn_label ?>
                                <input type="hidden" name="data[<?= $i ?>][tahun_masuk]" value="<?= $thn_label ?>">
                                <input type="hidden" name="data[<?= $i ?>][id]" value="<?= $existing ? $existing->id : '' ?>">
                            </td>
                            <td><input type="number" name="data[<?= $i ?>][jml_mhs_diterima]" class="form-control form-control-sm text-end input-mhs" value="<?= $existing ? $existing->jml_mhs_diterima : 0 ?>"></td>
                            
                            <?php foreach($c['cols'] as $idx => $col): 
                                $col_key = "jml_lulus_ts" . str_replace('TS-', '', $col);
                                if ($col == 'TS') $col_key = "jml_lulus_ts0";
                                
                                // Disable inputs that are logically impossible (e.g., entering TS-4 for TS-2 cohort)
                                $col_val = (int)str_replace('TS-', '', $col);
                                if ($col == 'TS') $col_val = 0;
                                $isDisabled = ($col_val > $i) ? 'disabled bg-light' : '';
                            ?>
                                <td>
                                    <input type="number" 
                                           name="data[<?= $i ?>][<?= $col_key ?>]" 
                                           class="form-control form-control-sm text-end input-lulus" 
                                           value="<?= ($existing && !$isDisabled) ? $existing->$col_key : 0 ?>"
                                           <?= $isDisabled ?>>
                                </td>
                            <?php endforeach; ?>

                            <td class="bg-primary-subtle fw-bold text-end px-2 total-lulus">0</td>
                            <td><input type="number" step="0.01" name="data[<?= $i ?>][rata_masa_studi]" class="form-control form-control-sm text-end" value="<?= $existing ? $existing->rata_masa_studi : 0 ?>"></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light py-3 text-center">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-save2 me-2"></i>Simpan Seluruh Data Masa Studi
            </button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const formatNum = (n) => new Intl.NumberFormat('id-ID').format(n);

    function calculate() {
        document.querySelectorAll('.row-studi').forEach(row => {
            let total = 0;
            row.querySelectorAll('.input-lulus:not([disabled])').forEach(input => {
                total += parseInt(input.value) || 0;
            });
            row.querySelector('.total-lulus').innerText = formatNum(total);
        });
    }

    document.querySelectorAll('.input-lulus').forEach(input => {
        input.addEventListener('input', calculate);
    });

    calculate(); // Initial run
});
</script>
