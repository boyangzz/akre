<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sumber_daya_model extends CI_Model
{
    // Generic methods for SDM tables (3a, 3b)
    public function get_data($table) {
        return $this->db->get($table)->result();
    }

    public function get_by_id($table, $id) {
        return $this->db->where('id', $id)->get($table)->row();
    }

    public function save($table, $id, $data) {
        if ($id) return $this->db->where('id', $id)->update($table, $data);
        return $this->db->insert($table, $data);
    }

    public function delete($table, $id) {
        return $this->db->where('id', $id)->delete($table);
    }
}
