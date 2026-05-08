<div class="page-header">
    <h4><i class="bi bi-star-fill me-2 text-warning"></i>Kepuasan Pengguna Lulusan (8.e.2)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Kepuasan Pengguna</li>
        </ol>
    </nav>
</div>

<form action="<?= base_url('luaran/kepuasan_save_bulk') ?>" method="POST">
    <!-- Tabel 1: Tabel Referensi Angka -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white fw-bold">
            <i class="bi bi-table me-2"></i>Tabel Referensi (Jumlah Lulusan & Tanggapan)
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0 text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="30%">Tahun Lulus</th>
                            <th width="35%">Jumlah Lulusan</th>
                            <th width="35%">Jumlah Tanggapan Kepuasan Pengguna yang Terlacak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tahuns = ['TS-4', 'TS-3', 'TS-2'];
                        foreach ($tahuns as $idx => $thn): 
                            $existing = null;
                            foreach ($ref_records as $r) {
                                if ($r->tahun_lulus == $thn) { $existing = $r; break; }
                            }
                        ?>
                        <tr>
                            <td class="fw-bold bg-light">
                                <?= $thn ?>
                                <input type="hidden" name="ref[<?= $idx ?>][tahun_lulus]" value="<?= $thn ?>">
                                <input type="hidden" name="ref[<?= $idx ?>][id]" value="<?= $existing ? $existing->id : '' ?>">
                            </td>
                            <td><input type="number" name="ref[<?= $idx ?>][jml_lulusan]" class="form-control form-control-sm text-end" value="<?= $existing ? $existing->jml_lulusan : 0 ?>"></td>
                            <td><input type="number" name="ref[<?= $idx ?>][jml_tanggapan]" class="form-control form-control-sm text-end" value="<?= $existing ? $existing->jml_tanggapan : 0 ?>"></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tabel 2: Tingkat Kepuasan (7 Kriteria) -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold">
            <i class="bi bi-graph-up-arrow me-2"></i>Tingkat Kepuasan Pengguna Berdasarkan Kriteria
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0 text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2" width="5%">No</th>
                            <th rowspan="2" width="25%">Jenis Kemampuan</th>
                            <th colspan="4">Tingkat Kepuasan Pengguna (%)</th>
                            <th rowspan="2" width="20%">Rencana Tindak Lanjut</th>
                        </tr>
                        <tr class="table-secondary text-dark">
                            <th width="10%">Sangat Baik</th>
                            <th width="10%">Baik</th>
                            <th width="10%">Cukup</th>
                            <th width="10%">Kurang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($records)): ?>
                            <tr><td colspan="7" class="py-4 text-muted">Data kriteria belum ada di database.</td></tr>
                        <?php else: foreach ($records as $idx => $r): ?>
                        <tr>
                            <td><?= $idx + 1 ?></td>
                            <td class="text-start ps-3 fw-bold">
                                <?= $r->jenis_kemampuan ?>
                                <input type="hidden" name="score[<?= $idx ?>][id]" value="<?= $r->id ?>">
                            </td>
                            <td><input type="number" step="0.01" name="score[<?= $idx ?>][persen_sangat_baik]" class="form-control form-control-sm text-end" value="<?= $r->persen_sangat_baik ?>"></td>
                            <td><input type="number" step="0.01" name="score[<?= $idx ?>][persen_baik]" class="form-control form-control-sm text-end" value="<?= $r->persen_baik ?>"></td>
                            <td><input type="number" step="0.01" name="score[<?= $idx ?>][persen_cukup]" class="form-control form-control-sm text-end" value="<?= $r->persen_cukup ?>"></td>
                            <td><input type="number" step="0.01" name="score[<?= $idx ?>][persen_kurang]" class="form-control form-control-sm text-end" value="<?= $r->persen_kurang ?>"></td>
                            <td><textarea name="score[<?= $idx ?>][rencana_tindak_lanjut]" class="form-control form-control-sm" rows="2"><?= $r->rencana_tindak_lanjut ?></textarea></td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td colspan="2">Jumlah</td>
                            <td id="total-score-sb">0</td>
                            <td id="total-score-b">0</td>
                            <td id="total-score-c">0</td>
                            <td id="total-score-k">0</td>
                            <td class="bg-secondary-subtle"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light py-3 text-center">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-save2 me-2"></i>Simpan Seluruh Data Kepuasan Pengguna
            </button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculateScore() {
        const table = document.querySelector('table:nth-of-type(2)');
        const cols = ['persen_sangat_baik', 'persen_baik', 'persen_cukup', 'persen_kurang'];
        const footIds = ['total-score-sb', 'total-score-b', 'total-score-c', 'total-score-k'];

        cols.forEach((col, idx) => {
            let sum = 0;
            document.querySelectorAll(`input[name$="[${col}]"]`).forEach(i => sum += parseFloat(i.value) || 0);
            document.getElementById(footIds[idx]).innerText = sum.toFixed(2);
        });
    }

    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', calculateScore);
    });

    calculateScore();
});
</script>
