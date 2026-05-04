<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Borang_setup_model — Rule Engine (Layer 2: Backend)
 * Single source of truth untuk visibility tabel per jenjang
 */
class Borang_setup_model extends CI_Model
{
    protected $table = 'setup_tabel_borang';

    /**
     * Cek apakah tabel berlaku untuk jenjang tertentu
     */
    public function is_allowed($kode_tabel, $jenjang)
    {
        if (empty($jenjang)) return true; // Jika belum set jenjang, tampilkan semua

        $row = $this->db->where('kode_tabel', $kode_tabel)->get($this->table)->row();
        if (!$row) return false;

        $filter = json_decode($row->jenjang_filter, true);
        return is_array($filter) && in_array($jenjang, $filter);
    }

    /**
     * Ambil semua tabel yang berlaku untuk jenjang (untuk menu dinamis)
     */
    public function get_menu_by_jenjang($jenjang)
    {
        $rows = $this->db->order_by('urutan', 'ASC')->get($this->table)->result();
        $menu = [];

        foreach ($rows as $row) {
            if (empty($jenjang)) {
                $menu[] = $row;
                continue;
            }
            $filter = json_decode($row->jenjang_filter, true);
            if (is_array($filter) && in_array($jenjang, $filter)) {
                $menu[] = $row;
            }
        }

        return $menu;
    }

    /**
     * Get all setup data
     */
    public function get_all()
    {
        return $this->db->order_by('urutan', 'ASC')->get($this->table)->result();
    }

    /**
     * Get by ID
     */
    public function get_by_id($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    /**
     * Solusi Jangka Panjang: Reset Standar Khusus D3 (Sesuai Gambar Referensi)
     */
    public function reset_d3_standard()
    {
        $all_tables = $this->db->get($this->table)->result();
        // Tabel yang dilarang/merah untuk D3 berdasarkan matriks
        $not_allowed_for_d3 = ['2a', '2b', '3b4-1', '3b5', '6a', '6b', '8f1-1', '8f4-1', '8f4-2', '8f4-3', '8f4-4'];
        
        foreach ($all_tables as $table) {
            $filter = json_decode($table->jenjang_filter, true);
            if (!is_array($filter)) $filter = [];
            
            if (in_array($table->kode_tabel, $not_allowed_for_d3)) {
                // Hapus D3 dari filter jika ada
                $filter = array_diff($filter, ['D3']);
            } else {
                // Pastikan D3 ada di filter
                if (!in_array('D3', $filter)) {
                    $filter[] = 'D3';
                }
            }
            
            $this->db->where('id', $table->id)->update($this->table, ['jenjang_filter' => json_encode(array_values($filter))]);
        }
    }
}
