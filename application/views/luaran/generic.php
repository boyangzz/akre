<div class="page-header">
    <h4><i class="bi bi-graph-up me-2"></i><?= $page_title ?></h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Luaran</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-cone-striped display-1 text-muted"></i>
        <h5 class="mt-3">Modul Sedang Dikembangkan</h5>
        <p class="text-muted">Halaman untuk <strong><?= $page_title ?></strong> sedang dalam tahap scaffolding skeleton.</p>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-primary">Kembali ke Dashboard</a>
    </div>
</div>
