<div class="page-header">
    <h4><i class="bi bi-journal-text me-2"></i>Publikasi Ilmiah Mahasiswa (8.f.1)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Publikasi Mahasiswa</li>
        </ol>
    </nav>
</div>

<div class="alert alert-info border-info shadow-sm mb-4">
    <i class="bi bi-info-circle-fill me-2"></i>
    Masukkan jumlah judul publikasi mahasiswa pada setiap kategori. Baris <strong>Jumlah</strong> akan dihitung otomatis.
</div>

<form action="<?= base_url('luaran/publikasi_mhs_save_bulk') ?>" method="POST">
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0 text-center align-middle" style="font-size: 0.85rem;">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="45%">Jenis Publikasi</th>
                            <th width="10%">TS-2</th>
                            <th width="10%">TS-1</th>
                            <th width="10%">TS</th>
                            <th width="20%" class="bg-primary">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $idx => $r): ?>
                        <tr class="row-pub">
                            <td><?= $idx + 1 ?></td>
                            <td class="text-start ps-3 fw-bold">
                                <?= $r->jenis_publikasi ?>
                                <input type="hidden" name="data[<?= $idx ?>][id]" value="<?= $r->id ?>">
                            </td>
                            <td><input type="number" name="data[<?= $idx ?>][jml_ts2]" class="form-control form-control-sm text-end input-val" value="<?= $r->jml_ts2 ?>"></td>
                            <td><input type="number" name="data[<?= $idx ?>][jml_ts1]" class="form-control form-control-sm text-end input-val" value="<?= $r->jml_ts1 ?>"></td>
                            <td><input type="number" name="data[<?= $idx ?>][jml_ts0]" class="form-control form-control-sm text-end input-val" value="<?= $r->jml_ts0 ?>"></td>
                            <td class="bg-primary-subtle fw-bold text-end px-3 row-total">0</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td colspan="2">Jumlah</td>
                            <td id="foot-ts2">0</td>
                            <td id="foot-ts1">0</td>
                            <td id="foot-ts0">0</td>
                            <td id="foot-total" class="bg-primary text-white">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light py-3 text-center">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-save2 me-2"></i>Simpan Seluruh Data Publikasi
            </button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function calculate() {
        let grandTotal = 0;
        let colTotals = [0, 0, 0]; // ts2, ts1, ts0

        document.querySelectorAll('.row-pub').forEach(row => {
            let rowSum = 0;
            const inputs = row.querySelectorAll('.input-val');
            inputs.forEach((input, idx) => {
                const val = parseInt(input.value) || 0;
                rowSum += val;
                colTotals[idx] += val;
            });
            row.querySelector('.row-total').innerText = rowSum.toLocaleString('id-ID');
            grandTotal += rowSum;
        });

        document.getElementById('foot-ts2').innerText = colTotals[0].toLocaleString('id-ID');
        document.getElementById('foot-ts1').innerText = colTotals[1].toLocaleString('id-ID');
        document.getElementById('foot-ts0').innerText = colTotals[2].toLocaleString('id-ID');
        document.getElementById('foot-total').innerText = grandTotal.toLocaleString('id-ID');
    }

    document.querySelectorAll('.input-val').forEach(input => {
        input.addEventListener('input', calculate);
    });

    calculate();
});
</script>
