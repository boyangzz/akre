    <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $page_title ?></h1>
        <a href="<?= base_url('simulasi') ?>" class="btn btn-sm btn-secondary shadow-sm">
            <i class="bi bi-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kamus Matriks Standar BAN-PT (Jenjang <?= $current_jenjang ?>)</h6>
        </div>
        <div class="card-body">
            <div class="alert alert-light border shadow-sm">
                <i class="bi bi-info-circle text-primary"></i> <strong>Transparansi Data:</strong> Halaman ini menjelaskan darimana nilai Skor Sistem berasal. Anda dapat melihat kriteria, rumus baku dari matriks resmi BAN-PT, dan dari form mana data tersebut ditarik.
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="10%">Elemen</th>
                            <th width="30%">Indikator / Deskripsi</th>
                            <th width="35%">Rumus Kalkulasi (Rubrik)</th>
                            <th width="25%">Sumber Data (Menu)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($matriks)): ?>
                            <tr>
                                <td colspan="4" class="text-center">Kamus matriks belum tersedia untuk jenjang ini.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($matriks as $m): 
                                $is_manual = (strpos($m->sumber_data, 'Input Manual') !== false || empty($m->sumber_data));
                            ?>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge bg-<?= $is_manual ? 'warning text-dark' : 'success' ?> mb-1" style="font-size: 0.6rem;">
                                            <?= $is_manual ? 'SUBJEKTIF' : 'OTOMATIS' ?>
                                        </span>
                                        <br>
                                        <strong><?= $m->kode_elemen ?></strong>
                                        <br>
                                        <small class="text-muted">Bobot: <?= $m->bobot ?></small>
                                    </td>
                                    <td>
                                        <?= $m->deskripsi_indikator ? $m->deskripsi_indikator : '<span class="text-warning"><i class="bi bi-hourglass-split"></i> Sedang dalam proses pemetaan indikator.</span>' ?>
                                        
                                        <?php if ($is_manual): ?>
                                            <div class="mt-2 small text-muted fst-italic">
                                                <i class="bi bi-info-square me-1"></i> <strong>Note:</strong> Elemen ini bersifat kualitatif. Penilaian dilakukan oleh Asesor berdasarkan bukti narasi (LED) dan observasi lapangan karena memerlukan pertimbangan profesional (*professional judgment*) yang tidak dapat dikuantifikasi secara otomatis oleh sistem.
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="bg-light small">
                                        <?= $m->rumus_kalkulasi ? $m->rumus_kalkulasi : '<span class="text-muted small"><i class="bi bi-tools"></i> Rumus matematis sedang dikembangkan.</span>' ?>
                                    </td>
                                    <td>
                                        <?php if (!$is_manual): ?>
                                            <span class="text-info font-weight-bold"><i class="bi bi-cpu me-1"></i> <?= $m->sumber_data ?></span>
                                        <?php else: ?>
                                            <span class="text-muted"><i class="bi bi-person-fill me-1"></i> Asesor (Input Manual)</span>
                                        <?php endif; ?>
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
