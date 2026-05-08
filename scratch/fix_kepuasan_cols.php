<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// Cek kolom di trx_kepuasan_pengguna
$res = $mysqli->query("DESC trx_kepuasan_pengguna");
$cols = [];
while($row = $res->fetch_assoc()) $cols[] = $row['Field'];

// Jika kolom 'aspek' tidak ada tapi ada 'jenis_kemampuan', kita pakai itu
$col_name = 'aspek';
if (!in_array('aspek', $cols)) {
    if (in_array('jenis_kemampuan', $cols)) $col_name = 'jenis_kemampuan';
    else if (in_array('kriteria', $cols)) $col_name = 'kriteria';
}

// Pastikan 7 kriteria ada
$kriterias = [
    'Etika',
    'Keahlian pada bidang ilmu (kompetensi utama)',
    'Kemampuan berbahasa asing',
    'Penggunaan teknologi informasi',
    'Kemampuan berkomunikasi',
    'Kerjasama',
    'Pengembangan diri'
];

foreach ($kriterias as $k) {
    $check = $mysqli->query("SELECT id FROM trx_kepuasan_pengguna WHERE $col_name = '$k'");
    if ($check->num_rows == 0) {
        $mysqli->query("INSERT INTO trx_kepuasan_pengguna ($col_name, prodi_id) VALUES ('$k', 1)");
    }
}

echo "Column identified: $col_name. Criteria seeded.\n";
