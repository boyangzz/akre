<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kemahasiswaan_model extends CI_Model
{
    // Seleksi Mahasiswa (2a)
    public function get_seleksi() {
        return $this->db->order_by('tahun_akademik', 'DESC')->get('trx_seleksi_mahasiswa')->result();
    }
    public function save_seleksi($id, $data) {
        if ($id) return $this->db->where('id', $id)->update('trx_seleksi_mahasiswa', $data);
        return $this->db->insert('trx_seleksi_mahasiswa', $data);
    }

    // Mahasiswa Asing (2b)
    public function get_mhs_asing() {
        return $this->db->order_by('tahun_akademik', 'DESC')->get('trx_mahasiswa_asing')->result();
    }
    public function save_mhs_asing($id, $data) {
        if ($id) return $this->db->where('id', $id)->update('trx_mahasiswa_asing', $data);
        return $this->db->insert('trx_mahasiswa_asing', $data);
    }
}
