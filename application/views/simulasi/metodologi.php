<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $page_title ?></h1>
        <a href="<?= base_url('simulasi') ?>" class="btn btn-sm btn-secondary shadow-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Overview Section -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm bg-primary text-white overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="display-6 font-weight-bold mb-3">Bagaimana AKRE Menghitung Skor Anda?</h2>
                            <p class="lead mb-0">AKRE menggunakan mesin kalkulasi berlapis yang mengacu pada <strong>Standar IAPS 4.0 BAN-PT</strong>. Kami mengonversi data mentah dari borang Anda menjadi prediksi peringkat akreditasi secara real-time.</p>
                        </div>
                        <div class="col-md-4 text-center d-none d-md-block">
                            <i class="bi bi-calculator-fill" style="font-size: 8rem; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3 Steps Methodology -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-0 border-top-primary border-4">
                <div class="card-body">
                    <div class="icon-circle bg-light-primary text-primary mb-3">
                        <i class="bi bi-database-fill-down h4 mb-0"></i>
                    </div>
                    <h5 class="font-weight-bold">1. Ekstraksi Data Mentah</h5>
                    <p class="text-muted small">Sistem menyisir 28 tabel transaksi di dalam database AKRE (Grup C s/d G). Data ini meliputi:</p>
                    <ul class="small text-muted ps-3">
                        <li>Profil Dosen (Pendidikan, Jabatan, Sertifikasi)</li>
                        <li>Data Seleksi (Animo & Keketatan)</li>
                        <li>Capaian Tridharma (Publikasi, Penelitian, PkM)</li>
                        <li>Tracer Study (Waktu Tunggu & Kesesuaian Bidang)</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-0 border-top-success border-4">
                <div class="card-body">
                    <div class="icon-circle bg-light-success text-success mb-3">
                        <i class="bi bi-function h4 mb-0"></i>
                    </div>
                    <h5 class="font-weight-bold">2. Scoring Engine (0-4)</h5>
                    <p class="text-muted small">Setiap indikator dihitung menggunakan rumus matematis resmi. Contoh logika yang diterapkan:</p>
                    <div class="bg-light p-2 rounded mb-2">
                        <code class="small text-dark">NDTPS >= 12 ? Skor = 4 : Skor = (2*N+12)/9</code>
                    </div>
                    <p class="text-muted small">Sistem secara otomatis menangani ambang batas (threshold) yang berbeda antara jenjang <strong>D3 (Vokasi)</strong> dan <strong>S1 (Akademik)</strong>.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-0 border-top-warning border-4">
                <div class="card-body">
                    <div class="icon-circle bg-light-warning text-warning mb-3">
                        <i class="bi bi-award-fill h4 mb-0"></i>
                    </div>
                    <h5 class="font-weight-bold">3. Prediksi Peringkat</h5>
                    <p class="text-muted small">Nilai Akhir (NA) dihitung dengan menjumlahkan seluruh <strong>(Skor x Bobot)</strong>. Namun, total skor saja tidak cukup.</p>
                    <p class="text-muted small">Sistem mengevaluasi <strong>Syarat Perlu Akreditasi</strong>:</p>
                    <ul class="small text-muted ps-3">
                        <li>Jika elemen SDM < 1.0, status otomatis <strong>TIDAK TERAKREDITASI</strong>.</li>
                        <li>Jika Syarat Unggul terpenuhi + NA >= 361, maka peringkat <strong>UNGGUL</strong>.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Dual Perspective Section -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Perspektif Sistem (Data Driven)</h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted">Kalkulasi ini bersifat kaku dan objektif. Jika data di borang belum diisi, maka skor akan otomatis <strong>0.00</strong>. Ini memberikan gambaran riil kesiapan data program studi Anda saat ini.</p>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success-soft text-success p-2 me-2"><i class="bi bi-check-circle"></i></span>
                        <span class="small font-weight-bold">Otomatis & Real-time</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Perspektif Asesor (Adjustment)</h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted">Beberapa elemen penilaian bersifat kualitatif (misal: Visi Misi, Tata Pamong). Skor ini diambil dari input manual Anda di menu <strong>Kertas Kerja</strong> untuk mensimulasikan penilaian lapangan oleh asesor.</p>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-warning-soft text-warning p-2 me-2"><i class="bi bi-pencil-square"></i></span>
                        <span class="small font-weight-bold">Subjektif & Strategis</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mathematical Formula Sample -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="font-weight-bold mb-3"><i class="bi bi-box-seam"></i> Bedah Rumus: Kecukupan Dosen (NDTPS)</h5>
                    <p class="small text-muted">Sistem mendeteksi jenjang prodi Anda dan menerapkan rumus yang berbeda sesuai standar BAN-PT:</p>
                    
                    <div class="row">
                        <!-- S1 Column -->
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded bg-light border-start-primary">
                                <h6 class="font-weight-bold text-primary">Jenjang S1 (Akademik)</h6>
                                <code class="d-block mb-2 text-dark small">N < 12 ? Skor = (2*N+12)/9</code>
                                <table class="table table-sm table-bordered x-small mb-0 mt-2">
                                    <thead class="bg-white">
                                        <tr class="small text-center"><th>Dosen</th><th>Skor</th><th>Status</th></tr>
                                    </thead>
                                    <tbody class="small text-center">
                                        <tr><td>12</td><td>4.00</td><td class="text-success">Ideal</td></tr>
                                        <tr><td>9</td><td>3.33</td><td class="text-primary">Baik Sekali</td></tr>
                                        <tr><td>6</td><td>2.67</td><td class="text-warning">Minimum</td></tr>
                                        <tr class="bg-white"><td>< 6</td><td>0.00</td><td class="text-danger">Kritis</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- D3 Column -->
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded bg-light border-start-success">
                                <h6 class="font-weight-bold text-success">Jenjang D3 (Vokasi)</h6>
                                <code class="d-block mb-2 text-dark small">N < 12 ? Skor = (N-3)*(4/9)</code>
                                <table class="table table-sm table-bordered x-small mb-0 mt-2">
                                    <thead class="bg-white">
                                        <tr class="small text-center"><th>Dosen</th><th>Skor</th><th>Status</th></tr>
                                    </thead>
                                    <tbody class="small text-center">
                                        <tr><td>12</td><td>4.00</td><td class="text-success">Ideal</td></tr>
                                        <tr><td>9</td><td>2.67</td><td class="text-primary">Cukup</td></tr>
                                        <tr><td>6</td><td>1.33</td><td class="text-warning">Rendah</td></tr>
                                        <tr class="bg-white"><td>< 3</td><td>0.00</td><td class="text-danger">Kritis</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="font-weight-bold mb-3">Nilai Akhir (NA)</h5>
                    <p class="small text-muted">Dihitung dari rata-rata tertimbang seluruh elemen penilaian.</p>
                    <div class="text-center p-4 bg-light rounded-pill mb-3">
                        <h3 class="font-weight-bold text-primary">NA = &sum; (Skor<sub>i</sub> &times; Bobot<sub>i</sub>)</h3>
                    </div>
                    <div class="row text-center x-small text-muted">
                        <div class="col-4 px-1 border-end"><strong>< 200</strong><br>Tidak Terakreditasi</div>
                        <div class="col-4 px-1 border-end"><strong>200-360</strong><br>Baik</div>
                        <div class="col-4 px-1"><strong>&ge; 361</strong><br>Unggul</div>
                    </div>
                    <hr>
                    <p class="x-small fst-italic text-center mb-0">Total bobot standar IAPS 4.0 adalah 100.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FORMULA VAULT (High Transparency Section) -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="m-0 font-weight-bold"><i class="bi bi-shield-lock"></i> Formula Vault: Transparansi Perhitungan Sistem</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info border-info small mb-4">
                        <i class="bi bi-info-circle-fill me-1"></i>
                        <strong>Legal Reference:</strong> Seluruh rumus di bawah ini telah diverifikasi sesuai dengan <strong>Lampiran 6d PerBAN-PT No. 5 Tahun 2019</strong> tentang Instrumen Akreditasi Program Studi (IAPS 4.0) untuk Program Diploma Tiga.
                    </div>

                    <div class="accordion" id="accordionFormula">
                        
                        <!-- KRITERIA 2: TATA PAMONG -->
                        <div class="accordion-item border-0 mb-2 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseC2">
                                    Kriteria 2: Kerjasama Tridharma (C.2.4.c)
                                </button>
                            </h2>
                            <div id="collapseC2" class="accordion-collapse collapse" data-bs-parent="#accordionFormula">
                                <div class="accordion-body bg-light">
                                    <div class="row">
                                        <div class="col-md-6 border-end">
                                            <h6 class="font-weight-bold">Bobot & Poin (D3)</h6>
                                            <p class="x-small mb-1">Mengukur kuantitas dan kualitas kerjasama yang relevan dengan bidang keahlian program studi.</p>
                                            <ul class="x-small">
                                                <li>Internasional (a) = 3 Poin</li>
                                                <li>Nasional (b) = 2 Poin</li>
                                                <li>Lokal/Wilayah (c) = 1 Poin</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold">Matriks Penilaian D3</h6>
                                            <p class="x-small mb-1"><code>Poin = (3*a) + (2*b) + c</code></p>
                                            <div class="bg-white p-2 rounded border x-small">
                                                <strong>Skor = (Poin / 8) * 4</strong> (Maksimal 4.00)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KRITERIA 4: SDM -->
                        <div class="accordion-item border-0 mb-2 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseC4">
                                    Kriteria 4: Sumber Daya Manusia (C.4.4.a/d)
                                </button>
                            </h2>
                            <div id="collapseC4" class="accordion-collapse collapse" data-bs-parent="#accordionFormula">
                                <div class="accordion-body bg-light">
                                    <div class="row small">
                                        <div class="col-md-6 mb-3 border-end">
                                            <h6 class="font-weight-bold text-success">Kecukupan Dosen (NDTPS)</h6>
                                            <p class="x-small">NDTPS adalah jumlah dosen tetap yang bidang keahliannya sesuai dengan kompetensi inti PS.</p>
                                            <code>Skor = (NDTPS - 3) * (4 / 9)</code>
                                            <p class="x-small text-muted mt-2">Target minimal untuk skor 4 adalah 12 Dosen Tetap.</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class="font-weight-bold text-success">Sertifikat Industri (D3)</h6>
                                            <p class="x-small">Mengukur persentase dosen yang memiliki sertifikat kompetensi/profesi/industri.</p>
                                            <code>Skor = (P_Cert / 50%) * 4</code>
                                            <p class="x-small text-muted mt-2">Target 50% dosen bersertifikat untuk mendapatkan Skor 4.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KRITERIA 9: LUARAN -->
                        <div class="accordion-item border-0 mb-2 shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseC9">
                                    Kriteria 9: Luaran & Capaian (IPK, WT, MS, PBS)
                                </button>
                            </h2>
                            <div id="collapseC9" class="accordion-collapse collapse" data-bs-parent="#accordionFormula">
                                <div class="accordion-body bg-light">
                                    <p class="x-small mb-3">Kriteria ini memiliki bobot terbesar dalam IAPS 4.0. Berikut perbandingan target <strong>D3 (Diploma Tiga)</strong>:</p>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered x-small mb-0 bg-white">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Indikator</th>
                                                    <th>Target Skor 4 (D3)</th>
                                                    <th>Rumus Perhitungan Skor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>IPK Lulusan</strong></td>
                                                    <td>>= 3.00</td>
                                                    <td><code>Skor = (IPK - 2.00) * 4</code></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Masa Studi (MS)</strong></td>
                                                    <td><= 3.0 Tahun</td>
                                                    <td><code>Skor = 4 - (MS - 3) * 4</code> (Max MS = 4 Th)</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Waktu Tunggu (WT)</strong></td>
                                                    <td><= 3 Bulan</td>
                                                    <td><code>Skor = (P_WT / 20%) - 1</code> (P_WT = % Lulusan WT < 3bln)</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Bidang Kerja (PBS)</strong></td>
                                                    <td>>= 80%</td>
                                                    <td><code>Skor = (PBS / 20%) - 1</code> (PBS = % Kesesuaian Tinggi/Sedang)</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Kepuasan Pengguna</strong></td>
                                                    <td>>= 3.50</td>
                                                    <td><code>IKP = (4*sb + 3*b + 2*c + 1*k) / 100</code></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="x-small text-muted mt-2 mb-0">Note: <em>sb</em> (Sangat Baik), <em>b</em> (Baik), <em>c</em> (Cukup), <em>k</em> (Kurang).</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.accordion-button:not(.collapsed) {
    background-color: #f8f9fc;
    color: #4e73df;
}
.icon-circle {
    height: 3rem;
    width: 3rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.bg-light-primary { background-color: rgba(78, 115, 223, 0.1); }
.bg-light-success { background-color: rgba(28, 200, 138, 0.1); }
.bg-light-warning { background-color: rgba(246, 194, 62, 0.1); }
.bg-success-soft { background-color: #e1f5fe; }
.bg-warning-soft { background-color: #fff9c4; }
.border-top-primary { border-top: 4px solid #4e73df !important; }
.border-top-success { border-top: 4px solid #1cc88a !important; }
.border-top-warning { border-top: 4px solid #f6c23e !important; }
.border-start-primary { border-left: 4px solid #4e73df !important; }
.border-start-success { border-left: 4px solid #1cc88a !important; }
.font-weight-bold { font-weight: 700 !important; }
.x-small { font-size: 0.75rem; }
</style>
