<div class="page-header">
    <h4><i class="bi bi-briefcase me-2"></i>Kesesuaian Bidang Kerja Lulusan (8.d.2)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Kesesuaian Bidang</li>
        </ol>
    </nav>
</div>

<div class="alert alert-info border-info shadow-sm mb-4">
    <i class="bi bi-info-circle-fill me-2"></i>
    Masukkan jumlah lulusan yang bekerja sesuai bidangnya (Rendah, Sedang, Tinggi).
</div>

<form action="<?= base_url('luaran/kesesuaian_save_bulk') ?>" method="POST">
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0 text-center align-middle" style="font-size: 0.8rem;">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2" width="15%">Tahun Lulus</th>
                            <th rowspan="2" width="15%">Jumlah Lulusan</th>
                            <th rowspan="2" width="15%">Jumlah Lulusan Terlacak</th>
                            <th colspan="3">Jumlah Lulusan Terlacak dengan Tingkat Kesesuaian Bidang Kerja</th>
                        </tr>
                        <tr class="table-secondary text-dark">
                            <th>Rendah</th>
                            <th>Sedang</th>
                            <th>Tinggi</th>
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
                        <tr class="row-kb">
                            <td class="fw-bold bg-light">
                                <?= $thn ?>
                                <input type="hidden" name="data[<?= $idx ?>][tahun_lulus]" value="<?= $thn ?>">
                                <input type="hidden" name="data[<?= $idx ?>][id]" value="<?= $existing ? $existing->id : '' ?>">
                            </td>
                            <td><input type="number" name="data[<?= $idx ?>][jml_lulusan]" class="form-control form-control-sm text-end input-val" value="<?= $existing ? $existing->jml_lulusan : 0 ?>"></td>
                            <td><input type="number" name="data[<?= $idx ?>][jml_terlacak]" class="form-control form-control-sm text-end input-val" value="<?= $existing ? $existing->jml_terlacak : 0 ?>"></td>
                            <td><input type="number" name="data[<?= $idx ?>][kesesuaian_rendah]" class="form-control form-control-sm text-end input-val" value="<?= $existing ? $existing->kesesuaian_rendah : 0 ?>"></td>
                            <td><input type="number" name="data[<?= $idx ?>][kesesuaian_sedang]" class="form-control form-control-sm text-end input-val" value="<?= $existing ? $existing->kesesuaian_sedang : 0 ?>"></td>
                            <td><input type="number" name="data[<?= $idx ?>][kesesuaian_tinggi]" class="form-control form-control-sm text-end input-val" value="<?= $existing ? $existing->kesesuaian_tinggi : 0 ?>"></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td>Jumlah</td>
                            <td class="total-col">0</td>
                            <td class="total-col">0</td>
                            <td class="total-col">0</td>
                            <td class="total-col">0</td>
                            <td class="total-col">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light py-3 text-center">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-save2 me-2"></i>Simpan Seluruh Data Kesesuaian
            </button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        const table = document.querySelector('table');
        const rows = table.querySelectorAll('tbody tr');
        const footerCells = table.querySelectorAll('tfoot td.total-col');

        footerCells.forEach((cell, colIdx) => {
            let sum = 0;
            rows.forEach(row => {
                const input = row.querySelectorAll('input[type="number"]')[colIdx];
                sum += parseInt(input.value) || 0;
            });
            cell.innerText = sum.toLocaleString('id-ID');
        });
    }

    document.querySelectorAll('.input-val').forEach(input => {
        input.addEventListener('input', calculate);
    });

    calculate();
});
</script>
