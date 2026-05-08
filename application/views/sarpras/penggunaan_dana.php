<div class="page-header">
    <h4><i class="bi bi-cash-stack me-2"></i><?= $page_title ?></h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Keuangan</li>
        </ol>
    </nav>
</div>

<div class="alert alert-info border-info shadow-sm d-flex align-items-center">
    <i class="bi bi-info-circle-fill fs-4 me-3"></i>
    <div>
        <strong>Panduan:</strong> Masukkan nominal dalam <strong>Rupiah (Rp)</strong>. 
        Baris <strong>Jumlah</strong> dan <strong>Rata-rata</strong> akan dihitung secara otomatis.
    </div>
</div>

<form action="<?= base_url('sarpras/save') ?>" method="POST">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm align-middle mb-0 text-center" style="font-size: 0.8rem;">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="3" width="25%">Jenis Penggunaan</th>
                            <th colspan="4">Unit Pengelola Program Studi (Rupiah)</th>
                            <th colspan="4">Program Studi (Rupiah)</th>
                        </tr>
                        <tr>
                            <th>TS-2</th>
                            <th>TS-1</th>
                            <th>TS</th>
                            <th class="bg-secondary">Rata-rata</th>
                            <th>TS-2</th>
                            <th>TS-1</th>
                            <th>TS</th>
                            <th class="bg-secondary">Rata-rata</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $groups = [
                            'ops' => [
                                ['label' => '1. Biaya Operasional Pendidikan', 'is_header' => true],
                                ['label' => 'a. Biaya Dosen (Gaji, Honor)', 'key' => 'dosen', 'is_sub' => true],
                                ['label' => 'b. Biaya Tenaga Kependidikan', 'key' => 'tendik', 'is_sub' => true],
                                ['label' => 'c. Biaya Operasional Pembelajaran', 'key' => 'operasional_belajar', 'is_sub' => true],
                                ['label' => 'd. Biaya Operasional Tidak Langsung', 'key' => 'operasional_indirect', 'is_sub' => true],
                                ['label' => '2. Biaya Operasional Kemahasiswaan', 'key' => 'mhs'],
                            ],
                            'litabmas' => [
                                ['label' => '3. Biaya Penelitian', 'key' => 'penelitian'],
                                ['label' => '4. Biaya PkM', 'key' => 'pkm'],
                            ],
                            'invest' => [
                                ['label' => '5. Biaya Investasi SDM', 'key' => 'invest_sdm'],
                                ['label' => '6. Biaya Investasi Sarana', 'key' => 'invest_sarana'],
                                ['label' => '6. Biaya Investasi Prasarana', 'key' => 'invest_prasarana'],
                            ]
                        ];

                        $global_idx = 0;
                        foreach ($groups as $group_key => $items): 
                            foreach ($items as $cat):
                                if (isset($cat['is_header'])):
                        ?>
                            <tr class="table-light fw-bold">
                                <td colspan="10" class="text-start ps-3"><?= $cat['label'] ?></td>
                            </tr>
                        <?php 
                                continue; 
                                endif;

                                $global_idx++;
                                $existing = null;
                                foreach ($records as $r) {
                                    if ($r->jenis_penggunaan == $cat['label']) { $existing = $r; break; }
                                }
                        ?>
                        <tr class="row-calc" data-group="<?= $group_key ?>">
                            <td class="text-start <?= isset($cat['is_sub']) ? 'ps-5 fst-italic' : 'ps-3 fw-bold' ?>">
                                <?= $cat['label'] ?>
                                <input type="hidden" name="data[<?= $global_idx ?>][jenis_penggunaan]" value="<?= $cat['label'] ?>">
                                <input type="hidden" name="data[<?= $global_idx ?>][id]" value="<?= $existing ? $existing->id : '' ?>">
                            </td>
                            <td><input type="number" name="data[<?= $global_idx ?>][nominal_upps_ts2]" class="form-control form-control-sm text-end input-calc" data-col="u2" value="<?= $existing ? $existing->nominal_upps_ts2 : 0 ?>"></td>
                            <td><input type="number" name="data[<?= $global_idx ?>][nominal_upps_ts1]" class="form-control form-control-sm text-end input-calc" data-col="u1" value="<?= $existing ? $existing->nominal_upps_ts1 : 0 ?>"></td>
                            <td><input type="number" name="data[<?= $global_idx ?>][nominal_upps_ts]" class="form-control form-control-sm text-end input-calc" data-col="u0" value="<?= $existing ? $existing->nominal_upps_ts : 0 ?>"></td>
                            <td class="bg-light fw-bold text-end px-2 avg-u">0</td>
                            
                            <td><input type="number" name="data[<?= $global_idx ?>][nominal_ps_ts2]" class="form-control form-control-sm text-end border-primary input-calc" data-col="p2" value="<?= $existing ? $existing->nominal_ps_ts2 : 0 ?>"></td>
                            <td><input type="number" name="data[<?= $global_idx ?>][nominal_ps_ts1]" class="form-control form-control-sm text-end border-primary input-calc" data-col="p1" value="<?= $existing ? $existing->nominal_ps_ts1 : 0 ?>"></td>
                            <td><input type="number" name="data[<?= $global_idx ?>][nominal_ps_ts]" class="form-control form-control-sm text-end border-primary input-calc" data-col="p0" value="<?= $existing ? $existing->nominal_ps_ts : 0 ?>"></td>
                            <td class="bg-light fw-bold text-end px-2 avg-p">0</td>
                        </tr>
                        <?php endforeach; ?>
                        <!-- Sub-Total Row -->
                        <tr class="table-warning fw-bold">
                            <td class="text-center">Jumlah</td>
                            <td class="text-end px-2" id="sum-<?= $group_key ?>-u2">0</td>
                            <td class="text-end px-2" id="sum-<?= $group_key ?>-u1">0</td>
                            <td class="text-end px-2" id="sum-<?= $group_key ?>-u0">0</td>
                            <td class="bg-secondary text-white text-end px-2" id="sum-<?= $group_key ?>-uavg">0</td>
                            
                            <td class="text-end px-2" id="sum-<?= $group_key ?>-p2">0</td>
                            <td class="text-end px-2" id="sum-<?= $group_key ?>-p1">0</td>
                            <td class="text-end px-2" id="sum-<?= $group_key ?>-p0">0</td>
                            <td class="bg-secondary text-white text-end px-2" id="sum-<?= $group_key ?>-pavg">0</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light py-3 text-center">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-save2 me-2"></i>Simpan Seluruh Data Keuangan
            </button>
        </div>
    </div>
</form>

<script>
window.addEventListener('DOMContentLoaded', (event) => {
    const formatIDR = (val) => new Intl.NumberFormat('id-ID').format(Math.round(val));

    function calculateEverything() {
        // 1. Calculate row averages
        document.querySelectorAll('.row-calc').forEach(row => {
            let u2 = parseFloat(row.querySelector('[data-col="u2"]').value) || 0;
            let u1 = parseFloat(row.querySelector('[data-col="u1"]').value) || 0;
            let u0 = parseFloat(row.querySelector('[data-col="u0"]').value) || 0;
            row.querySelector('.avg-u').innerText = formatIDR((u2 + u1 + u0) / 3);

            let p2 = parseFloat(row.querySelector('[data-col="p2"]').value) || 0;
            let p1 = parseFloat(row.querySelector('[data-col="p1"]').value) || 0;
            let p0 = parseFloat(row.querySelector('[data-col="p0"]').value) || 0;
            row.querySelector('.avg-p').innerText = formatIDR((p2 + p1 + p0) / 3);
        });

        // 2. Calculate group sums
        ['ops', 'litabmas', 'invest'].forEach(group => {
            ['u2', 'u1', 'u0', 'p2', 'p1', 'p0'].forEach(col => {
                let sum = 0;
                document.querySelectorAll(`.row-calc[data-group="${group}"] [data-col="${col}"]`).forEach(input => {
                    sum += parseFloat(input.value) || 0;
                });
                document.getElementById(`sum-${group}-${col}`).innerText = formatIDR(sum);
            });
            
            // Calc group average sums
            let total_u_avg = 0;
            document.querySelectorAll(`.row-calc[data-group="${group}"]`).forEach(row => {
                let u2 = parseFloat(row.querySelector('[data-col="u2"]').value) || 0;
                let u1 = parseFloat(row.querySelector('[data-col="u1"]').value) || 0;
                let u0 = parseFloat(row.querySelector('[data-col="u0"]').value) || 0;
                total_u_avg += (u2 + u1 + u0) / 3;
            });
            document.getElementById(`sum-${group}-uavg`).innerText = formatIDR(total_u_avg);

            let total_p_avg = 0;
            document.querySelectorAll(`.row-calc[data-group="${group}"]`).forEach(row => {
                let p2 = parseFloat(row.querySelector('[data-col="p2"]').value) || 0;
                let p1 = parseFloat(row.querySelector('[data-col="p1"]').value) || 0;
                let p0 = parseFloat(row.querySelector('[data-col="p0"]').value) || 0;
                total_p_avg += (p2 + p1 + p0) / 3;
            });
            document.getElementById(`sum-${group}-pavg`).innerText = formatIDR(total_p_avg);
        });
    }

    document.querySelectorAll('.input-calc').forEach(input => {
        input.addEventListener('input', calculateEverything);
    });

    calculateEverything();
});
</script>
