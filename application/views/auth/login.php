<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — AKRE Sistem Akreditasi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-icons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom_admin.css') ?>">
    <style>body { padding-top: 0; }</style>
</head>
<body>
    <div class="login-wrapper">
        <div class="card login-card">
            <div class="card-body">
                <div class="login-brand">
                    <h3><i class="bi bi-mortarboard-fill"></i> AKRE</h3>
                    <small>Sistem Akreditasi Program Studi — BAN-PT</small>
                    <div class="text-muted mt-1" style="font-size:0.7rem;"><?= isset($identitas->nama_pt) ? $identitas->nama_pt : 'Universitas' ?></div>
                </div>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= base_url('auth/login') ?>">
                    <div class="mb-3">
                        <label class="form-label" for="username">
                            <i class="bi bi-person me-1"></i>Username
                        </label>
                        <input type="text" class="form-control" id="username" name="username" 
                               placeholder="Masukkan username" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">
                            <i class="bi bi-lock me-1"></i>Password
                        </label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2" id="btn-login">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                    </button>
                </form>

                <div class="text-center mt-3">
                    <small class="text-muted">AKRE v2.0 &copy; <?= date('Y') ?></small>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
