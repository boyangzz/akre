<div class="page-header">
    <h4><i class="bi bi-search me-2"></i>Penelitian DTPS (3.b.2)</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Penelitian DTPS</li>
        </ol>
    </nav>
</div>

<div class="row g-3">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header">Input Data</div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('sumber_daya/penelitian_save') ?>">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label">Sumber Pembiayaan</label>
                        <select class="form-select" name="sumber" id="field-sumber" required>
                            <option value="pt_mandiri">PT / Mandiri</option>
                            <option value="dalam_negeri">Lembaga Dalam Negeri (Luar PT)</option>
                            <option value="luar_negeri">Lembaga Luar Negeri</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun Akademik</label>
                        <input type="text" class="form-control" name="tahun_akademik" id="field-tahun" placeholder="TS / TS-1 / TS-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Judul</label>
                        <input type="number" class="form-control" name="jumlah_judul" id="field-judul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Dana (Rp)</label>
                        <input type="number" class="form-control" name="dana" id="field-dana" placeholder="0" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                    <button type="reset" class="btn btn-link btn-sm w-100 mt-2" onclick="$('#field-id').val('')">Reset Form</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm mb-0 text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Sumber Pembiayaan</th>
                                <th>TS-2</th>
                                <th>TS-1</th>
                                <th>TS</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sumbers = [
                                'pt_mandiri' => 'A. PT Mandiri',
                                'dalam_negeri' => 'B. Lembaga Dalam Negeri',
                                'luar_negeri' => 'C. Lembaga Luar Negeri'
                            ];
                            foreach ($sumbers as $key => $label): 
                                $ts2 = 0; $ts1 = 0; $ts = 0;
                                foreach ($records as $r) {
                                    if ($r->sumber == $key) {
                                        if ($r->tahun_akademik == 'TS-2') $ts2 = $r->jumlah_judul;
                                        if ($r->tahun_akademik == 'TS-1') $ts1 = $r->jumlah_judul;
                                        if ($r->tahun_akademik == 'TS') $ts = $r->jumlah_judul;
                                    }
                                }
                            ?>
                            <tr>
                                <td class="text-start px-2"><?= $label ?></td>
                                <td><?= $ts2 ?></td>
                                <td><?= $ts1 ?></td>
                                <td><?= $ts ?></td>
                                <td class="fw-bold"><?= $ts2 + $ts1 + $ts ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">Log Data</div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Sumber</th>
                            <th>Tahun</th>
                            <th>Judul</th>
                            <th>Dana</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $r): ?>
                        <tr>
                            <td><?= $r->sumber ?></td>
                            <td><?= $r->tahun_akademik ?></td>
                            <td><?= $r->jumlah_judul ?></td>
                            <td>Rp <?= number_format($r->dana, 0, ',', '.') ?></td>
                            <td>
                                <button class="btn btn-sm btn-link p-0 me-2" onclick="editData('<?= $r->id ?>', '<?= $r->sumber ?>', '<?= $r->tahun_akademik ?>', '<?= $r->jumlah_judul ?>', '<?= $r->dana ?>')"><i class="bi bi-pencil"></i></button>
                                <a href="<?= base_url('sumber_daya/penelitian_delete/'.$r->id) ?>" class="btn btn-sm btn-link p-0 text-danger" onclick="return confirm('Hapus data ini?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function editData(id, sumber, tahun, judul, dana) {
    $('#field-id').val(id);
    $('#field-sumber').val(sumber);
    $('#field-tahun').val(tahun);
    $('#field-judul').val(judul);
    $('#field-dana').val(dana);
    window.scrollTo(0,0);
}
</script>
