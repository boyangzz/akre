<div class="page-header">
    <h4><i class="bi bi-person-check me-2"></i><?= $page_title ?></h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Pembimbing TA</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-primary text-white">Input Data Pembimbingan (Multi-Tahun)</div>
    <div class="card-body">
        <form method="POST" action="<?= base_url('sumber_daya/pembimbing_save') ?>">
            <input type="hidden" name="id" id="field-id">
            <div class="row g-3">
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Nama Dosen Tetap</label>
                    <select class="form-select select2" name="dosen_id" id="field-dosen" required>
                        <option value="">-- Pilih Dosen --</option>
                        <?php foreach ($list_dosen as $d): ?>
                            <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6">
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <label class="form-label fw-bold text-primary">Pada PS yang Diakreditasi</label>
                            <div class="row g-2">
                                <div class="col-4">
                                    <small>TS-2</small>
                                    <input type="number" class="form-control" name="ps_sendiri_ts2" id="field-ps-ts2" value="0">
                                </div>
                                <div class="col-4">
                                    <small>TS-1</small>
                                    <input type="number" class="form-control" name="ps_sendiri_ts1" id="field-ps-ts1" value="0">
                                </div>
                                <div class="col-4">
                                    <small>TS</small>
                                    <input type="number" class="form-control" name="ps_sendiri_ts" id="field-ps-ts" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <label class="form-label fw-bold text-success">Pada PS Lain di PT</label>
                            <div class="row g-2">
                                <div class="col-4">
                                    <small>TS-2</small>
                                    <input type="number" class="form-control" name="ps_lain_ts2" id="field-pl-ts2" value="0">
                                </div>
                                <div class="col-4">
                                    <small>TS-1</small>
                                    <input type="number" class="form-control" name="ps_lain_ts1" id="field-pl-ts1" value="0">
                                </div>
                                <div class="col-4">
                                    <small>TS</small>
                                    <input type="number" class="form-control" name="ps_lain_ts" id="field-pl-ts" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary px-5">Simpan Data Pembimbingan</button>
                    <button type="reset" class="btn btn-link text-muted" onclick="$('#field-id').val('')">Reset Form</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-sm text-center align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th rowspan="3">No</th>
                        <th rowspan="3">Nama Dosen</th>
                        <th colspan="8">Jumlah Mahasiswa yang Dibimbing</th>
                        <th rowspan="3">Rata-rata</th>
                        <th rowspan="3">Aksi</th>
                    </tr>
                    <tr>
                        <th colspan="4">Pada PS yang Diakreditasi</th>
                        <th colspan="4">Pada PS Lain di PT</th>
                    </tr>
                    <tr>
                        <th>TS-2</th>
                        <th>TS-1</th>
                        <th>TS</th>
                        <th class="bg-secondary">Rata2</th>
                        <th>TS-2</th>
                        <th>TS-1</th>
                        <th>TS</th>
                        <th class="bg-secondary">Rata2</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr><td colspan="13" class="py-4 text-muted italic">Belum ada data bimbingan.</td></tr>
                    <?php endif; ?>
                    <?php foreach ($records as $idx => $r): 
                        $avg_ps = ($r->ps_sendiri_ts2 + $r->ps_sendiri_ts1 + $r->ps_sendiri_ts) / 3;
                        $avg_pl = ($r->ps_lain_ts2 + $r->ps_lain_ts1 + $r->ps_lain_ts) / 3;
                        $total_avg = $avg_ps + $avg_pl;
                    ?>
                    <tr>
                        <td><?= $idx + 1 ?></td>
                        <td class="text-start"><?= $r->nama_dosen ?></td>
                        <td><?= $r->ps_sendiri_ts2 ?></td>
                        <td><?= $r->ps_sendiri_ts1 ?></td>
                        <td><?= $r->ps_sendiri_ts ?></td>
                        <td class="bg-light"><?= number_format($avg_ps, 2) ?></td>
                        <td><?= $r->ps_lain_ts2 ?></td>
                        <td><?= $r->ps_lain_ts1 ?></td>
                        <td><?= $r->ps_lain_ts ?></td>
                        <td class="bg-light"><?= number_format($avg_pl, 2) ?></td>
                        <td class="fw-bold bg-warning text-dark"><?= number_format($total_avg, 2) ?></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" onclick="editRow('<?= $r->id ?>','<?= $r->dosen_id ?>','<?= $r->ps_sendiri_ts2 ?>','<?= $r->ps_sendiri_ts1 ?>','<?= $r->ps_sendiri_ts ?>','<?= $r->ps_lain_ts2 ?>','<?= $r->ps_lain_ts1 ?>','<?= $r->ps_lain_ts ?>')">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <a href="<?= base_url('sumber_daya/pembimbing_delete/'.$r->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data bimbingan ini?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function editRow(id, dosen, ps2, ps1, ps, pl2, pl1, pl) {
    $('#field-id').val(id);
    $('#field-dosen').val(dosen).trigger('change');
    $('#field-ps-ts2').val(ps2);
    $('#field-ps-ts1').val(ps1);
    $('#field-ps-ts').val(ps);
    $('#field-pl-ts2').val(pl2);
    $('#field-pl-ts1').val(pl1);
    $('#field-pl-ts').val(pl);
    window.scrollTo(0,0);
}
</script>
