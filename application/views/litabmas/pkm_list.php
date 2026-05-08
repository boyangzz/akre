<div class="page-header">
    <h4><i class="bi bi-people me-2"></i><?= $page_title ?></h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Litabmas</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card shadow-sm border-success">
            <div class="card-header bg-success text-white">Input PkM Mhs (Tabel 7)</div>
            <div class="card-body">
                <form action="<?= base_url('litabmas/save_pkm') ?>" method="POST">
                    <input type="hidden" name="id" id="field-id">
                    <div class="mb-3">
                        <label class="form-label">Nama Dosen</label>
                        <select name="dosen_id" id="field-dosen" class="form-select select2" required>
                            <option value="">-- Pilih Dosen --</option>
                            <?php foreach($list_dosen as $d): ?>
                                <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tema PkM (Roadmap)</label>
                        <input type="text" name="tema_roadmap" id="field-tema" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Mahasiswa</label>
                        <select name="mahasiswa_id" id="field-mhs" class="form-select select2" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            <?php foreach($list_mhs as $m): ?>
                                <option value="<?= $m->id ?>"><?= $m->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul Kegiatan</label>
                        <textarea name="judul_kegiatan" id="field-judul" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun (YYYY)</label>
                        <input type="number" name="tahun" id="field-tahun" class="form-control" value="<?= date('Y') ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Simpan Data PkM</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>Tema Roadmap</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Kegiatan</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($records)): ?>
                                <tr><td colspan="7" class="text-center py-4 text-muted italic">Belum ada data PkM yang melibatkan mahasiswa.</td></tr>
                            <?php endif; ?>
                            <?php foreach($records as $idx => $r): ?>
                                <tr>
                                    <td><?= $idx + 1 ?></td>
                                    <td><?= $r->nama_dosen ?></td>
                                    <td><?= $r->tema_roadmap ?></td>
                                    <td><?= $r->nama_mahasiswa ?></td>
                                    <td><?= $r->judul_kegiatan ?></td>
                                    <td><?= $r->tahun ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-success me-1" onclick="edit('<?= $r->id ?>','<?= $r->dosen_id ?>','<?= $r->tema_roadmap ?>','<?= $r->mahasiswa_id ?>','<?= htmlspecialchars($r->judul_kegiatan) ?>','<?= $r->tahun ?>')">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <a href="<?= base_url('litabmas/pkm_delete/'.$r->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data ini?')">
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
    </div>
</div>

<script>
function edit(id, dosen, tema, mhs, judul, tahun) {
    $('#field-id').val(id);
    $('#field-dosen').val(dosen).trigger('change');
    $('#field-tema').val(tema);
    $('#field-mhs').val(mhs).trigger('change');
    $('#field-judul').val(judul);
    $('#field-tahun').val(tahun);
    window.scrollTo(0,0);
}
</script>
