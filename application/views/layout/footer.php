</div><!-- /.content-wrapper -->

<footer class="footer-akre">
    AKRE v2.0 &copy; <?= date('Y') ?> — Sistem Akreditasi Program Studi BAN-PT
</footer>

<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dynamic_borang.js') ?>"></script>
<?php if (isset($page_scripts)): ?>
    <?= $page_scripts ?>
<?php endif; ?>
<script>
    // Initialize all tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
</body>
</html>
