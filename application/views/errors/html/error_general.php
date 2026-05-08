<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Terjadi Kendala Sistem - AKRE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fc; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .error-card { border: none; border-radius: 1rem; max-width: 500px; width: 100%; text-align: center; }
        .error-icon { font-size: 5rem; color: #4e73df; }
        .debug-info { text-align: left; background: #2d3436; color: #fab1a0; padding: 1rem; border-radius: 0.5rem; font-family: monospace; font-size: 0.8rem; margin-top: 1rem; }
    </style>
</head>
<body>
    <div class="card error-card shadow-lg p-4">
        <div class="card-body">
            <div class="error-icon mb-3">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <h3 class="fw-bold text-dark mb-2">Terjadi Kendala Teknis</h3>
            <p class="text-muted mb-4">Sistem mengalami gangguan saat memproses modul ini. Silakan coba beberapa saat lagi atau muat ulang halaman.</p>
            
            <a href="<?= base_url('dashboard') ?>" class="btn btn-primary px-4 py-2 shadow-sm">
                <i class="bi bi-house me-2"></i>Ke Dashboard
            </a>
            
            <?php if (defined('ENVIRONMENT') && ENVIRONMENT !== 'production'): ?>
                <div class="debug-info">
                    <p class="mb-1"><strong>Exception Detail (Dev Only):</strong></p>
                    <p class="mb-0"><?php echo $heading; ?></p>
                    <div class="mt-2 text-warning"><?php echo $message; ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>