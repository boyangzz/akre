<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model
{
    // ========== DOSEN ==========
    public function get_all_dosen() {
        return $this->db->order_by('nama', 'ASC')->get('master_dosen')->result();
    }
    public function get_dosen($id) {
        return $this->db->where('id', $id)->get('master_dosen')->row();
    }
    public function insert_dosen($data) {
        return $this->db->insert('master_dosen', $data);
    }
    public function update_dosen($id, $data) {
        return $this->db->where('id', $id)->update('master_dosen', $data);
    }
    public function delete_dosen($id) {
        return $this->db->where('id', $id)->delete('master_dosen');
    }

    // ========== MAHASISWA ==========
    public function get_all_mahasiswa() {
        return $this->db->order_by('nama', 'ASC')->get('master_mahasiswa')->result();
    }
    public function get_mahasiswa($id) {
        return $this->db->where('id', $id)->get('master_mahasiswa')->row();
    }
    public function insert_mahasiswa($data) {
        return $this->db->insert('master_mahasiswa', $data);
    }
    public function update_mahasiswa($id, $data) {
        return $this->db->where('id', $id)->update('master_mahasiswa', $data);
    }
    public function delete_mahasiswa($id) {
        return $this->db->where('id', $id)->delete('master_mahasiswa');
    }

    // ========== MATA KULIAH ==========
    public function get_all_matakuliah() {
        return $this->db->order_by('kode_mk', 'ASC')->get('master_mata_kuliah')->result();
    }
    public function get_matakuliah($id) {
        return $this->db->where('id', $id)->get('master_mata_kuliah')->row();
    }
    public function insert_matakuliah($data) {
        return $this->db->insert('master_mata_kuliah', $data);
    }
    public function update_matakuliah($id, $data) {
        return $this->db->where('id', $id)->update('master_mata_kuliah', $data);
    }
    public function delete_matakuliah($id) {
        return $this->db->where('id', $id)->delete('master_mata_kuliah');
    }
}
