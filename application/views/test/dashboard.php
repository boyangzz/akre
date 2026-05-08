<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title><?= $page_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Inter', sans-serif; }
        .hero-section { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; padding: 60px 0; border-radius: 0 0 2rem 2rem; margin-bottom: 3rem; }
        .card-suite { border: none; border-radius: 1rem; transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer; height: 100%; }
        .card-suite:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .icon-box { width: 60px; height: 60px; background: #eef2ff; color: #4e73df; border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.5rem; }
    </style>
</head>
<body>
    <div class="hero-section shadow">
        <div class="container text-center">
            <h1 class="fw-bold display-5 mb-2">QC Testing Suite</h1>
            <p class="lead opacity-75">Modul Validasi Otomatis untuk Mesin Akreditasi IAPS 4.0</p>
        </div>
    </div>

    <div class="container">
        <div class="row g-4">
            <?php foreach ($suites as $s): ?>
            <div class="col-md-4">
                <div class="card card-suite shadow-sm p-4" onclick="location.href='<?= base_url('test_validation/suite/' . $s['id']) ?>'">
                    <div class="icon-box">
                        <i class="bi <?= $s['icon'] ?>"></i>
                    </div>
                    <h4 class="fw-bold text-dark"><?= $s['name'] ?></h4>
                    <p class="text-muted small mb-4"><?= $s['desc'] ?></p>
                    <div class="mt-auto">
                        <span class="btn btn-outline-primary btn-sm w-100 rounded-pill">Jalankan Pengujian</span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-5 pt-5 border-top text-center text-muted small">
            <p><strong>Peringatan:</strong> Menjalankan pengujian ini akan menghapus data dummy lama dan menggantinya dengan skenario baru untuk keperluan audit akurasi rumus.</p>
            <a href="<?= base_url('simulasi') ?>" class="text-decoration-none"><i class="bi bi-arrow-left"></i> Kembali ke Dashboard Utama</a>
        </div>
    </div>
</body>
</html>
