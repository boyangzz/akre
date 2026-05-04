<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kerjasama_model extends CI_Model
{
    public function get_all() {
        return $this->db->order_by('id', 'DESC')->get('trx_kerjasama')->result();
    }

    public function get_by_id($id) {
        return $this->db->where('id', $id)->get('trx_kerjasama')->row();
    }

    public function insert($data) {
        return $this->db->insert('trx_kerjasama', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('trx_kerjasama', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('trx_kerjasama');
    }
}
