<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function get_stats()
    {
        return [
            'dosen'      => $this->db->count_all('master_dosen'),
            'mahasiswa'  => $this->db->count_all('master_mahasiswa'),
            'kerjasama'  => $this->db->count_all('trx_kerjasama'),
            'penelitian' => $this->db->count_all('trx_penelitian_dtps'),
            'pkm'        => $this->db->count_all('trx_pkm_dtps'),
            'publikasi'  => $this->db->count_all('trx_publikasi_dtps'),
        ];
    }
}
