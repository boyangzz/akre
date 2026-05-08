<?php
define('BASEPATH', 'index.php');
include 'index.php';
$ci =& get_instance();
$ci->load->database();

$tables = ['trx_masa_studi', 'trx_waktu_tunggu', 'trx_seleksi_mahasiswa', 'master_dosen', 'trx_kesesuaian_bidang'];
foreach ($tables as $t) {
    echo "$t: " . $ci->db->count_all($t) . "\n";
}
