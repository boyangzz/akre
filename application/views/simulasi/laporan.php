<div class="container-fluid">
    <div class="row mb-4 no-print">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800"><?= $page_title ?></h1>
                <p class="text-muted">Hasil akhir simulasi akreditasi jenjang <?= $current_jenjang ?></p>
            </div>
            <div>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="bi bi-printer"></i> Cetak Laporan
                </button>
                <a href="<?= base_url('simulasi') ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Header Laporan (Hanya muncul saat print) -->
    <div class="d-none d-print-block text-center mb-5">
        <h4>LAPORAN HASIL SIMULASI AKREDITASI BAN-PT</h4>
        <h5>PROGRAM STUDI JENJANG <?= $current_jenjang ?></h5>
        <p>Dicetak pada: <?= date('d/m/Y H:i') ?></p>
        <hr>
    </div>

    <?php 
    $total_sistem = $skor_sistem;
    $total_asesor = $skor_asesor;
    
    $color_sistem = ($prediksi_sistem == 'Unggul') ? 'success' : (($prediksi_sistem == 'Baik Sekali') ? 'primary' : (($prediksi_sistem == 'Baik') ? 'info' : 'danger'));
    $color_asesor = ($prediksi_asesor == 'Unggul') ? 'success' : (($prediksi_asesor == 'Baik Sekali') ? 'primary' : (($prediksi_asesor == 'Baik') ? 'info' : 'danger'));
    
    // Status Syarat Perlu Lolos (General)
    $syarat_lolos = true;
    foreach($syarat_perlu as $sp) {
        if($sp['status'] == 'Kritis') $syarat_lolos = false;
    }
    ?>

    <div class="row">
        <!-- Ringkasan Eksekutif -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-left-<?= $color_sistem ?>">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-<?= $color_sistem ?> text-uppercase mb-1">Prediksi Peringkat (Sistem)</div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800"><?= strtoupper($prediksi_sistem) ?></div>
                    <div class="mt-2 h5">Skor: <?= number_format($total_sistem, 2) ?></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-left-<?= $color_asesor ?>">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-<?= $color_asesor ?> text-uppercase mb-1">Prediksi Peringkat (Asesor)</div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800"><?= strtoupper($prediksi_asesor) ?></div>
                    <div class="mt-2 h5">Skor: <?= number_format($total_asesor, 2) ?></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card shadow h-100 py-2 border-left-info">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Status Syarat Perlu Unggul</div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800">
                        <?= $syarat_lolos ? '<span class="text-success">LOLOS</span>' : '<span class="text-danger">TIDAK LOLOS</span>' ?>
                    </div>
                    <p class="small text-muted mt-2 mb-0">Berdasarkan elemen SDM dan SPMI.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Radar Chart Visualisasi -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Capaian per Kriteria</h6>
                </div>
                <div class="card-body">
                    <div style="height: 350px;">
                        <canvas id="radarLaporan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Syarat Perlu -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Evaluasi Syarat Perlu</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Indikator Syarat Perlu</th>
                                <th class="text-center">Skor Aktual</th>
                                <th class="text-center">Min. Unggul</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($syarat_perlu as $sp): ?>
                            <tr>
                                <td><?= $sp['nama'] ?></td>
                                <td class="text-center font-weight-bold"><?= number_format($sp['skor'], 2) ?></td>
                                <td class="text-center"><?= number_format($sp['syarat_unggul'], 2) ?></td>
                                <td class="text-center">
                                    <span class="badge bg-<?= ($sp['status'] == 'Lolos') ? 'success' : 'danger' ?>">
                                        <?= $sp['status'] ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- REKOMENDASI STRATEGIS (NEW) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-left-warning">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning"><i class="bi bi-lightbulb"></i> Rekomendasi Strategis Perbaikan</h6>
                </div>
                <div class="card-body">
                    <?php if (empty($rekomendasi)): ?>
                        <p class="text-success mb-0"><i class="bi bi-check-circle-fill"></i> Semua indikator utama sudah memenuhi standar Unggul. Pertahankan kualitas!</p>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach($rekomendasi as $rek): ?>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded bg-light h-100">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="badge bg-secondary"><?= $rek['kategori'] ?></span>
                                        <span class="badge bg-<?= $rek['urgensi'] == 'Tinggi' ? 'danger' : 'warning text-dark' ?>">Urgensi: <?= $rek['urgensi'] ?></span>
                                    </div>
                                    <p class="mb-0 small text-gray-800"><?= $rek['pesan'] ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Rincian per Elemen -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rincian Skor per Butir Matriks</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead class="bg-primary text-white text-center">
                                <tr>
                                    <th rowspan="2" style="width: 10%;">Elemen</th>
                                    <th rowspan="2">Indikator Penilaian</th>
                                    <th rowspan="2" style="width: 8%;">Bobot</th>
                                    <th colspan="2">Skor (0-4)</th>
                                    <th colspan="2">Nilai (Bobot x Skor)</th>
                                </tr>
                                <tr>
                                    <th style="width: 8%;">Sistem</th>
                                    <th style="width: 8%;">Asesor</th>
                                    <th style="width: 8%;">Sistem</th>
                                    <th style="width: 8%;">Asesor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $current_kriteria = "";
                                foreach($matriks as $m): 
                                    $kriteria = explode('.', $m->kode_elemen)[0] . '.' . explode('.', $m->kode_elemen)[1];
                                    if($kriteria != $current_kriteria):
                                        $current_kriteria = $kriteria;
                                        $nama_kriteria = [
                                            'C.1' => 'Visi, Misi, Tujuan dan Strategi',
                                            'C.2' => 'Tata Pamong, Tata Kelola dan Kerjasama',
                                            'C.3' => 'Mahasiswa',
                                            'C.4' => 'Sumber Daya Manusia',
                                            'C.5' => 'Keuangan, Sarana dan Prasarana',
                                            'C.6' => 'Pendidikan',
                                            'C.7' => 'Penelitian',
                                            'C.8' => 'Pengabdian kepada Masyarakat',
                                            'C.9' => 'Luaran dan Capaian Tridharma'
                                        ];
                                ?>
                                <tr class="bg-light font-weight-bold">
                                    <td colspan="7" class="text-primary"><?= $kriteria ?> - <?= isset($nama_kriteria[$kriteria]) ? $nama_kriteria[$kriteria] : '' ?></td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td class="text-center"><?= $m->kode_elemen ?></td>
                                    <td class="small text-muted"><?= $m->deskripsi_indikator ?></td>
                                    <td class="text-center"><?= number_format($m->bobot, 2) ?></td>
                                    <td class="text-center font-weight-bold"><?= number_format($m->skor_sistem, 2) ?></td>
                                    <td class="text-center font-weight-bold text-warning"><?= number_format($m->skor_asesor, 2) ?></td>
                                    <td class="text-center"><?= number_format($m->skor_sistem * $m->bobot, 2) ?></td>
                                    <td class="text-center"><?= number_format($m->skor_asesor * $m->bobot, 2) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="bg-dark text-white font-weight-bold text-center">
                                <tr>
                                    <td colspan="5">TOTAL SKOR AKHIR (NA)</td>
                                    <td><?= number_format($total_sistem, 2) ?></td>
                                    <td><?= number_format($total_asesor, 2) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('radarLaporan');
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: <?= json_encode($radar_data['labels']) ?>,
                datasets: [{
                    label: 'Skor Sistem',
                    data: <?= json_encode($radar_data['sistem']) ?>,
                    backgroundColor: 'rgba(78, 115, 223, 0.2)',
                    borderColor: 'rgb(78, 115, 223)',
                    pointBackgroundColor: 'rgb(78, 115, 223)'
                }, {
                    label: 'Skor Asesor',
                    data: <?= json_encode($radar_data['asesor']) ?>,
                    backgroundColor: 'rgba(246, 194, 62, 0.2)',
                    borderColor: 'rgb(246, 194, 62)',
                    pointBackgroundColor: 'rgb(246, 194, 62)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        suggestedMin: 0,
                        suggestedMax: 4
                    }
                }
            }
        });
    });
</script>

<style>
@media print {
    .no-print { display: none !important; }
    .card { border: 1px solid #ddd !important; box-shadow: none !important; }
    .bg-primary { background-color: #4e73df !important; color: white !important; }
    .bg-light { background-color: #f8f9fc !important; }
    .table-bordered th, .table-bordered td { border: 1px solid #333 !important; }
    body { font-size: 12px; }
}
</style>
