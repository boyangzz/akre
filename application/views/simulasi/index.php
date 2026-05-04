<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800"><?= $page_title ?></h1>
            <p class="text-muted">Bandingkan skor hasil kalkulasi sistem dengan skor estimasi asesor.</p>
        </div>
    </div>

    <?php if (!$matriks_available): ?>
        <div class="alert alert-warning">
            <h4 class="alert-heading"><i class="bi bi-exclamation-triangle"></i> Matriks Penilaian Belum Tersedia</h4>
            <p>Sistem belum memiliki referensi bobot dan matriks penilaian untuk jenjang <strong><?= $current_jenjang ?></strong>.</p>
            <hr>
            <p class="mb-0">Saat ini, matriks yang tersedia di database adalah untuk program <strong>D3</strong> dan <strong>S1</strong> sesuai standar IAPS 4.0 BAN-PT.</p>
        </div>
    <?php else: ?>
    <div class="card shadow mb-4 border-left-primary" style="z-index: 10; overflow: visible !important;">
        <div class="card-body" style="overflow: visible !important;">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h5 class="mb-1 font-weight-bold text-primary"><i class="bi bi-layers"></i> Skenario Simulasi</h5>
                    <p class="text-muted small mb-0">Skenario Aktif: <strong><?= $active_scenario ? $active_scenario->nama_skenario : 'Default' ?></strong></p>
                </div>
                <div class="col-md-5 text-end">
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle shadow-sm" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-arrow-left-right me-1"></i> Ganti Skenario
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="z-index: 1060; min-width: 250px;">
                            <?php foreach($scenarios as $s): ?>
                            <li>
                                <a class="dropdown-item d-flex justify-content-between align-items-center <?= $s->is_active ? 'active' : '' ?>" 
                                   href="<?= base_url('simulasi/switch_scenario/'.$s->id) ?>">
                                    <?= $s->nama_skenario ?>
                                    <?php if($s->is_active): ?><i class="bi bi-check-circle-fill"></i><?php endif; ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-primary" href="#" data-bs-toggle="modal" data-bs-target="#modalAddScenario">
                                    <i class="bi bi-plus-circle me-1"></i> Buat Skenario Baru
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Scenario -->
    <div class="modal fade" id="modalAddScenario" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <form action="<?= base_url('simulasi/add_scenario') ?>" method="POST">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Buat Skenario Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Skenario</label>
                            <input type="text" name="nama_skenario" class="form-control" placeholder="Contoh: Skenario Optimis 2024" required>
                            <small class="text-muted">Gunakan skenario berbeda untuk menguji variasi data kualitatif.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Skenario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Card Skor Sistem -->
        <div class="col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Skor By Sistem (Otomatis)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= number_format($skor_sistem, 2) ?> / 400
                                </div>
                                <div class="mt-2 text-muted small">
                                    Dihitung otomatis berdasarkan data di 28 tabel transaksi.
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cpu fs-1 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Skor Asesor -->
            <div class="col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Skor By Asesor (Manual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= number_format($skor_asesor, 2) ?> / 400
                                </div>
                                <div class="mt-2 text-muted small">
                                    Diinput manual oleh pengguna melalui Kertas Kerja.
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-person-check fs-1 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Radar Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Radar Penilaian (Gap Analysis)</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area" style="height: 400px;">
                            <canvas id="radarSimulasi"></canvas>
                        </div>
                        <hr>
                        <div class="mt-2 text-center small">
                            <span class="mr-2">
                                <i class="bi bi-circle-fill text-primary"></i> Skor Sistem
                            </span>
                            <span class="mr-2 ms-3">
                                <i class="bi bi-circle-fill text-warning"></i> Skor Asesor
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Peringkat -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Prediksi Peringkat</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center py-4">
                            <?php 
                            $color_asesor = ($prediksi_asesor == 'Unggul') ? 'success' : (($prediksi_asesor == 'Baik Sekali') ? 'primary' : (($prediksi_asesor == 'Baik') ? 'info' : 'danger'));
                            $color_sistem = ($prediksi_sistem == 'Unggul') ? 'success' : (($prediksi_sistem == 'Baik Sekali') ? 'primary' : (($prediksi_sistem == 'Baik') ? 'info' : 'danger'));
                            ?>
                            <h2 class="display-4 font-weight-bold text-<?= $color_asesor ?> mb-0"><?= strtoupper($prediksi_asesor) ?></h2>
                            <p class="text-muted mb-3">Prediksi Berdasarkan <strong>Skor Asesor</strong></p>
                            
                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <div class="px-3 py-2 rounded bg-light border">
                                    <div class="small text-muted">Skor Asesor</div>
                                    <div class="font-weight-bold"><?= number_format($skor_asesor, 2) ?></div>
                                </div>
                                <div class="px-3 py-2 rounded bg-light border">
                                    <div class="small text-muted">Skor Sistem</div>
                                    <div class="font-weight-bold"><?= number_format($skor_sistem, 2) ?></div>
                                </div>
                            </div>

                            <div class="alert <?= ($prediksi_asesor == $prediksi_sistem) ? 'alert-success' : 'alert-warning' ?> py-2 small mb-0">
                                <i class="bi <?= ($prediksi_asesor == $prediksi_sistem) ? 'bi-check-circle' : 'bi-exclamation-circle' ?>"></i>
                                Prediksi Sistem: <strong><?= $prediksi_sistem ?></strong>
                            </div>
                        </div>
                        <hr>
                        <div class="small">
                            <strong>Note:</strong> Prediksi ini hanya berdasarkan total nilai (NA). Peringkat akhir juga ditentukan oleh "Syarat Perlu Unggul" pada butir-butir tertentu.
                        </div>
                    </div>
                </div>

                <!-- STATUS SYARAT PERLU (PHASE 2) -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Status Syarat Perlu</h6>
                        <?php 
                        $status_global = 'success';
                        $label_global = 'AMAN';
                        foreach($syarat_perlu as $sp) {
                            if($sp['status'] == 'Kritis') { $status_global = 'danger'; $label_global = 'KRITIS'; break; }
                            if($sp['status'] == 'Warning') { $status_global = 'warning'; $label_global = 'WARNING'; }
                        }
                        ?>
                        <span class="badge bg-<?= $status_global ?> text-white"><?= $label_global ?></span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead class="table-light">
                                    <tr class="small">
                                        <th>Indikator</th>
                                        <th class="text-center">Skor</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($syarat_perlu as $sp): 
                                        $badge_color = 'success';
                                        if($sp['status'] == 'Warning') $badge_color = 'warning text-dark';
                                        if($sp['status'] == 'Kritis') $badge_color = 'danger';
                                    ?>
                                    <tr>
                                        <td class="small" style="font-size: 0.75rem;"><?= $sp['nama'] ?></td>
                                        <td class="text-center small"><strong><?= number_format($sp['skor'], 2) ?></strong></td>
                                        <td class="text-center">
                                            <span class="badge bg-<?= $badge_color ?> px-2" style="font-size: 0.65rem;">
                                                <?= $sp['status'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($status_global == 'danger'): ?>
                            <div class="p-2 bg-danger text-white small text-center">
                                <i class="bi bi-exclamation-octagon"></i> <strong>Peringatan!</strong> Anda terancam Tidak Terakreditasi.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                    </div>
                    <div class="card-body">
                        <a href="<?= base_url('simulasi/laporan') ?>" class="btn btn-info text-white w-100 mb-2">
                            <i class="bi bi-file-earmark-bar-graph"></i> Lihat Laporan Detail
                        </a>
                        <a href="<?= base_url('simulasi/kertas_kerja') ?>" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-pencil-square"></i> Isi Kertas Kerja Asesor
                        </a>
                        <a href="<?= base_url('simulasi/recalculate') ?>" class="btn btn-outline-success w-100">
                            <i class="bi bi-arrow-clockwise"></i> Update Skor Sistem
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <!-- REKOMENDASI STRATEGIS (NEW) -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4 border-left-warning">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-warning"><i class="bi bi-lightbulb"></i> Rekomendasi Strategis Perbaikan</h6>
                    <a href="<?= base_url('simulasi/laporan') ?>" class="btn btn-sm btn-outline-warning">Detail Laporan</a>
                </div>
                <div class="card-body">
                    <?php if (empty($rekomendasi)): ?>
                        <div class="text-center py-3">
                            <div class="h5 text-success"><i class="bi bi-check-circle-fill"></i> Semua Indikator Utama Aman!</div>
                            <p class="text-muted mb-0">Pertahankan kualitas data dan dokumen pendukung Anda.</p>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach($rekomendasi as $index => $rek): if($index >= 3) break; // Tampilkan 3 saja di dashboard ?>
                            <div class="col-md-4 mb-3">
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
</div>

<!-- Load Chart.js locally or via CDN (For now CDN for speed, user can localize it) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('radarSimulasi');
        
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: <?= json_encode($radar_data['labels']) ?>,
                datasets: [{
                    label: 'Skor Sistem',
                    data: <?= json_encode($radar_data['sistem']) ?>,
                    fill: true,
                    backgroundColor: 'rgba(78, 115, 223, 0.2)',
                    borderColor: 'rgb(78, 115, 223)',
                    pointBackgroundColor: 'rgb(78, 115, 223)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(78, 115, 223)'
                }, {
                    label: 'Skor Asesor',
                    data: <?= json_encode($radar_data['asesor']) ?>,
                    fill: true,
                    backgroundColor: 'rgba(246, 194, 62, 0.2)',
                    borderColor: 'rgb(246, 194, 62)',
                    pointBackgroundColor: 'rgb(246, 194, 62)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(246, 194, 62)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: { display: true },
                        suggestedMin: 0,
                        suggestedMax: 4
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
