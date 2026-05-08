<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Luaran_model extends CI_Model
{
    // Generic methods for Luaran tables (8a - 8f)
    public function get_data($table) {
        return $this->db->get($table)->result();
    }

    public function get_by_id($table, $id) {
        return $this->db->where('id', $id)->get($table)->row();
    }

    public function save($table, $id, $data)
    {
        if ($id) {
            return $this->db->where('id', $id)->update($table, $data);
        } else {
            return $this->db->insert($table, $data);
        }
    }

    public function delete($table, $id)
    {
        return $this->db->where('id', $id)->delete($table);
    }
}
