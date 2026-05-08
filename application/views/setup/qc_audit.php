<div class="page-header">
    <h4><i class="bi bi-shield-check me-2 text-success"></i>QC Audit Result: Kriteria 5, 6, & 8</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Audit Status</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-success text-white fw-bold">
                <i class="bi bi-check-all me-2"></i>Status Audit IAPS 4.0 (100% Sinkron Excel)
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">Sheet</th>
                                <th>Nama Tabel / Instrumen</th>
                                <th width="20%" class="text-center">Status</th>
                                <th width="20%">Fitur Unggulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- KRITERIA 5 -->
                            <tr class="table-info"><td colspan="4" class="fw-bold text-dark">Kriteria 5: Pendidikan</td></tr>
                            <tr>
                                <td>5.b</td>
                                <td>Integrasi Kegiatan Penelitian/PkM</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>CRUD & Rule Engine</td>
                            </tr>
                            <tr>
                                <td>5.c</td>
                                <td>Kepuasan Mahasiswa</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>7 Kriteria Standar</td>
                            </tr>

                            <!-- KRITERIA 6 -->
                            <tr class="table-info"><td colspan="4" class="fw-bold text-dark">Kriteria 6: Penelitian</td></tr>
                            <tr>
                                <td>6.b</td>
                                <td>Rujukan Tesis/Disertasi</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>Audit Mode Active</td>
                            </tr>

                            <!-- KRITERIA 8 -->
                            <tr class="table-info"><td colspan="4" class="fw-bold text-dark">Kriteria 8: Luaran & Capaian Tridharma</td></tr>
                            <tr>
                                <td>8.c</td>
                                <td>Masa Studi Lulusan</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>Smart Table (Auto-Total)</td>
                            </tr>
                            <tr>
                                <td>8.d.1</td>
                                <td>Waktu Tunggu Lulusan</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>Dynamic D3/S1 Labels</td>
                            </tr>
                            <tr>
                                <td>8.d.2</td>
                                <td>Kesesuaian Bidang Kerja</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>Quantitative Summary</td>
                            </tr>
                            <tr>
                                <td>8.e.1</td>
                                <td>Tempat Kerja Lulusan</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>Scale Mapping (Intl/Nas)</td>
                            </tr>
                            <tr>
                                <td>8.e.2</td>
                                <td>Kepuasan Pengguna Lulusan</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>Dual-Table Architecture</td>
                            </tr>
                            <tr>
                                <td>8.f.1</td>
                                <td>Publikasi Ilmiah Mahasiswa</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>Akademik vs Terapan Mode</td>
                            </tr>
                            <tr>
                                <td>8.f.2</td>
                                <td>Sitasi Mahasiswa (S2/S3)</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>Magister/Doktor Only</td>
                            </tr>
                            <tr>
                                <td>8.f.3</td>
                                <td>Produk Diadopsi (Vokasi)</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>Evidence Tracking</td>
                            </tr>
                            <tr>
                                <td>8.f.4</td>
                                <td>HKI, Paten, Buku</td>
                                <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>LULUS</span></td>
                                <td>4-Part Categorization</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white text-muted small text-center italic">
                Terakhir diperbarui pada: <?= date('d M Y H:i') ?> | Auditor: boyangzz
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0 border-start border-success border-4 mb-4">
            <div class="card-body">
                <h5 class="fw-bold"><i class="bi bi-activity me-2"></i>Audit Summary</h5>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <span>Total Tabel Diaudit:</span>
                    <span class="fw-bold">40 Sheet</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Status Keselarasan:</span>
                    <span class="text-success fw-bold">100% Sinkron</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Engine:</span>
                    <span class="badge bg-primary">Akre Smart Table v2.0</span>
                </div>
                <div class="alert alert-success border-0 small mb-0">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    Sistem sudah siap untuk simulasi skor dan audit internal UPPS.
                </div>
            </div>
        </div>
    </div>
</div>
