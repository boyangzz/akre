<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $page_title ?></h1>
        <a href="<?= base_url('simulasi') ?>" class="btn btn-sm btn-secondary shadow-sm">
            <i class="bi bi-arrow-left fa-sm text-white-50"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Input Skor Manual (Asesor) - Jenjang <?= $current_jenjang ?></h6>
        </div>
        <div class="card-body">
            <!-- Fitur Tambahan: Peringatan Inkonsistensi -->
            <?php if (!empty($inconsistencies)): ?>
                <div class="alert alert-warning border-left-warning shadow-sm">
                    <h5 class="alert-heading text-warning"><i class="bi bi-exclamation-triangle-fill"></i> Peringatan Inkonsistensi Setup</h5>
                    <ul class="mb-2">
                        <?php foreach ($inconsistencies as $inc): ?>
                            <li><?= $inc ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <hr>
                    <small><strong>Note:</strong> Meskipun tabel di atas Anda ceklis di menu Setup, skor/datanya tidak akan dihitung dalam Total Nilai Akreditasi (NA) karena bobot resminya adalah 0 pada Matriks Standar BAN-PT. Jika ini adalah *human-error* saat mengatur setup borang, hubungi Admin.</small>
                </div>
            <?php endif; ?>

            <div class="alert alert-info">
                Isi skor antara <strong>0.00 hingga 4.00</strong> pada kolom <strong>Skor Asesor</strong>. Nilai (Skor x Bobot) akan dihitung otomatis saat Anda menyimpan.
            </div>

            <form action="<?= base_url('simulasi/kertas_kerja') ?>" method="POST">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="15%">Kode Elemen</th>
                                <th width="15%" class="text-center">Bobot</th>
                                <th width="20%" class="text-center">Skor Sistem</th>
                                <th width="20%" class="text-center">Skor Asesor</th>
                                <th width="30%">Catatan / Justifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($matriks)): ?>
                                <tr>
                                    <td colspan="5" class="text-center">Matriks penilaian untuk jenjang ini belum tersedia di database.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($matriks as $m): 
                                    $is_manual = (strpos($m->sumber_data, 'Input Manual') !== false || empty($m->sumber_data));
                                ?>
                                    <tr class="<?= $is_manual ? 'table-warning-light' : '' ?>">
                                        <td>
                                            <strong><?= $m->kode_elemen ?></strong>
                                            <?php if ($is_manual): ?>
                                                <i class="bi bi-person-fill text-warning" title="Elemen Subjektif (Manual)"></i>
                                            <?php else: ?>
                                                <i class="bi bi-cpu-fill text-success" title="Dihitung Otomatis"></i>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><?= $m->bobot ?></td>
                                        <td class="text-center bg-light">
                                            <?php if (!$is_manual): ?>
                                                <strong class="text-primary"><?= $m->skor_sistem ? number_format($m->skor_sistem, 2) : '0.00' ?></strong>
                                            <?php else: ?>
                                                <span class="text-muted small">N/A (Subjektif)</span>
                                            <?php endif; ?>

                                            <?php if ($m->rumus_kalkulasi): ?>
                                                <i class="bi bi-info-circle-fill text-primary ms-1" style="cursor:help;" 
                                                   data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" 
                                                   title="Sumber: <?= $m->sumber_data ?><hr class='my-1'><?= htmlspecialchars($m->rumus_kalkulasi) ?>">
                                                </i>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" min="0" max="4" 
                                                   class="form-control text-center" 
                                                   name="skor[<?= $m->id ?>]" 
                                                   value="<?= $m->skor_asesor ?>">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" 
                                                   name="catatan[<?= $m->id ?>]" 
                                                   value="<?= $m->catatan_asesor ?>"
                                                   placeholder="Catatan asesor...">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (!empty($matriks)): ?>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Kertas Kerja</button>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
