<?php
$mysqli = new mysqli("localhost", "root", "", "aps");

// 1. Bersihkan Dosen Dummy lama jika ada
$mysqli->query("DELETE FROM master_dosen WHERE nama LIKE 'Dosen Dummy%'");

// 1b. Tambahkan Dosen agar mencapai 12
for ($i = 1; $i <= 12; $i++) {
    $mysqli->query("INSERT INTO master_dosen (nama, nidn, status_ikatan, kesesuaian_kompetensi, pendidikan_pasca, prodi_id) 
                    VALUES ('Dosen Dummy $i', 'DUMMY$i', 'tetap', 1, 'S2', 1)");
}

// 2. Isi IPK Lulusan (Ideal)
$mysqli->query("DELETE FROM trx_ipk_lulusan");
$mysqli->query("INSERT INTO trx_ipk_lulusan (tahun_lulus, jml_lulusan, ipk_min, ipk_rata, ipk_max, prodi_id) VALUES (2022, 50, 2.75, 3.25, 3.90, 1)");
$mysqli->query("INSERT INTO trx_ipk_lulusan (tahun_lulus, jml_lulusan, ipk_min, ipk_rata, ipk_max, prodi_id) VALUES (2023, 55, 2.80, 3.30, 3.95, 1)");
$mysqli->query("INSERT INTO trx_ipk_lulusan (tahun_lulus, jml_lulusan, ipk_min, ipk_rata, ipk_max, prodi_id) VALUES (2024, 60, 2.85, 3.35, 4.00, 1)");

// 3. Isi Masa Studi (Ideal: 3 Tahun / 6 Semester untuk D3)
$mysqli->query("DELETE FROM trx_masa_studi");
$mysqli->query("INSERT INTO trx_masa_studi (tahun_masuk, jml_mhs_diterima, rata_masa_studi, prodi_id) VALUES (2021, 50, 6.0, 1)");
$mysqli->query("INSERT INTO trx_masa_studi (tahun_masuk, jml_mhs_diterima, rata_masa_studi, prodi_id) VALUES (2020, 55, 6.1, 1)");
$mysqli->query("INSERT INTO trx_masa_studi (tahun_masuk, jml_mhs_diterima, rata_masa_studi, prodi_id) VALUES (2019, 60, 6.0, 1)");

// 4. Isi Waktu Tunggu (Ideal: > 80% < 3 bulan)
$mysqli->query("DELETE FROM trx_waktu_tunggu");
$mysqli->query("INSERT INTO trx_waktu_tunggu (tahun_lulus, jml_lulusan, jml_terlacak, wt_kurang_3bln, wt_3_sd_6bln, wt_lebih_6bln, prodi_id) 
                VALUES (2022, 50, 45, 40, 4, 1, 1)");
$mysqli->query("INSERT INTO trx_waktu_tunggu (tahun_lulus, jml_lulusan, jml_terlacak, wt_kurang_3bln, wt_3_sd_6bln, wt_lebih_6bln, prodi_id) 
                VALUES (2023, 55, 50, 45, 4, 1, 1)");
$mysqli->query("INSERT INTO trx_waktu_tunggu (tahun_lulus, jml_lulusan, jml_terlacak, wt_kurang_3bln, wt_3_sd_6bln, wt_lebih_6bln, prodi_id) 
                VALUES (2024, 60, 55, 50, 4, 1, 1)");

// 5. Isi Kesesuaian Bidang (Ideal: > 80% Tinggi/Sedang)
$mysqli->query("DELETE FROM trx_kesesuaian_bidang");
$mysqli->query("INSERT INTO trx_kesesuaian_bidang (tahun_lulus, jml_lulusan, jml_terlacak, kesesuaian_tinggi, kesesuaian_sedang, kesesuaian_rendah, prodi_id) 
                VALUES (2022, 50, 45, 35, 8, 2, 1)");
$mysqli->query("INSERT INTO trx_kesesuaian_bidang (tahun_lulus, jml_lulusan, jml_terlacak, kesesuaian_tinggi, kesesuaian_sedang, kesesuaian_rendah, prodi_id) 
                VALUES (2023, 55, 50, 40, 8, 2, 1)");
$mysqli->query("INSERT INTO trx_kesesuaian_bidang (tahun_lulus, jml_lulusan, jml_terlacak, kesesuaian_tinggi, kesesuaian_sedang, kesesuaian_rendah, prodi_id) 
                VALUES (2024, 60, 55, 45, 8, 2, 1)");

// 6. Isi Seleksi Mahasiswa (Ideal: Rasio 5:1)
$mysqli->query("DELETE FROM trx_seleksi_mahasiswa");
$mysqli->query("INSERT INTO trx_seleksi_mahasiswa (tahun_akademik, daya_tampung, pendaftar, lulus_seleksi, maba_reguler, prodi_id) 
                VALUES ('2024', 100, 550, 110, 100, 1)");

echo "Data Dummy Ideal BERHASIL disuntikkan.\n";
