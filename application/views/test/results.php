<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title><?= $page_title ?> - AKRE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fc; }
        .test-header { background: #4e73df; color: white; padding: 2rem 0; margin-bottom: 2rem; }
        .status-badge { font-size: 0.8rem; padding: 0.4rem 0.8rem; border-radius: 2rem; font-weight: bold; }
        .bg-pass { background-color: #1cc88a; color: white; }
        .bg-fail { background-color: #e74a3b; color: white; }
        .card { border: none; border-radius: 0.75rem; }
        .table { margin-bottom: 0; }
    </style>
</head>
<body>
    <div class="test-header shadow-sm">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-1"><i class="bi bi-shield-check me-2"></i>Unit Test Result</h2>
                    <p class="mb-0 opacity-75">Sistem Pengujian Otomatis Akurasi Skor IAPS 4.0</p>
                </div>
                <div class="text-end">
                    <a href="<?= base_url('test_validation') ?>" class="btn btn-outline-light btn-sm rounded-pill px-3 me-2">
                        <i class="bi bi-grid me-1"></i> QC Dashboard
                    </a>
                    <span class="badge bg-white text-primary fs-6"><?= date('d M Y H:i') ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Ringkasan Validasi Skor</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Nama Pengujian</th>
                                <th>Rumus Dasar</th>
                                <th class="text-center">Ekspektasi</th>
                                <th class="text-center">Aktual Sistem</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $res): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold"><?= $res['name'] ?></div>
                                </td>
                                <td><code><?= $res['formula'] ?></code></td>
                                <td class="text-center fw-bold text-primary"><?= number_format($res['expected'], 2) ?></td>
                                <td class="text-center fw-bold text-dark"><?= number_format($res['actual'], 2) ?></td>
                                <td class="text-center">
                                    <span class="status-badge <?= $res['status'] == 'PASS' ? 'bg-pass' : 'bg-fail' ?>">
                                        <?= $res['status'] ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="alert alert-light border shadow-sm small">
            <i class="bi bi-info-circle me-1"></i> <strong>Catatan:</strong> Pengujian ini dijalankan secara otomatis dengan melakukan <em>injection</em> data dummy ke dalam database sementara, kemudian memicu <strong>Scoring Engine</strong> untuk menghitung ulang skor berdasarkan jenjang prodi yang dideteksi.
        </div>
        
        <div class="text-center mb-5">
            <a href="<?= base_url('simulasi') ?>" class="btn btn-secondary px-4 shadow-sm">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Simulasi
            </a>
        </div>
    </div>
</body>
</html>
