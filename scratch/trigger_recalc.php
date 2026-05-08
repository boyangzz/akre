<?php
define('BASEPATH', 'index.php');
include 'index.php';
$ci =& get_instance();
$ci->load->model('Simulasi_model');
$ci->Simulasi_model->recalculate_sistem('D3');
echo "Simulasi D3 berhasil dikalkulasi ulang dengan data dummy baru.\n";
