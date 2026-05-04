<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulasi_model extends CI_Model {

    public function check_matriks_availability($jenjang) {
        $this->db->where('jenjang', $jenjang);
        return $this->db->count_all_results('simulasi_matriks') > 0;
    }

    public function get_matriks($jenjang, $scenario_id = null) {
        if (!$scenario_id) {
            $scenario = $this->get_active_scenario($jenjang);
            $scenario_id = $scenario ? $scenario->id : 0;
        }

        $this->db->select('m.*, sa.skor as skor_asesor, sa.catatan as catatan_asesor, ss.skor as skor_sistem');
        $this->db->from('simulasi_matriks m');
        $this->db->join('simulasi_skor_asesor sa', "sa.matriks_id = m.id AND sa.scenario_id = $scenario_id", 'left');
        $this->db->join('simulasi_skor_sistem ss', "ss.matriks_id = m.id AND ss.scenario_id = $scenario_id", 'left');
        $this->db->where('m.jenjang', $jenjang);
        return $this->db->get()->result();
    }
    
    public function get_total_skor_sistem($jenjang, $scenario_id = null) {
        if (!$scenario_id) {
            $scenario = $this->get_active_scenario($jenjang);
            $scenario_id = $scenario ? $scenario->id : 0;
        }

        $this->db->select_sum('ss.nilai');
        $this->db->from('simulasi_matriks m');
        $this->db->join('simulasi_skor_sistem ss', "ss.matriks_id = m.id AND ss.scenario_id = $scenario_id", 'inner');
        $this->db->where('m.jenjang', $jenjang);
        $result = $this->db->get()->row();
        return $result->nilai ? $result->nilai : 0;
    }
    
    public function get_total_skor_asesor($jenjang, $scenario_id = null) {
        if (!$scenario_id) {
            $scenario = $this->get_active_scenario($jenjang);
            $scenario_id = $scenario ? $scenario->id : 0;
        }

        $this->db->select_sum('sa.nilai');
        $this->db->from('simulasi_matriks m');
        $this->db->join('simulasi_skor_asesor sa', "sa.matriks_id = m.id AND sa.scenario_id = $scenario_id", 'inner');
        $this->db->where('m.jenjang', $jenjang);
        $result = $this->db->get()->row();
        return $result->nilai ? $result->nilai : 0;
    }

    public function save_skor_asesor($skor_data, $catatan_data = [], $scenario_id = null) {
        if (empty($skor_data)) return;

        if (!$scenario_id) {
            // Find jenjang from the first matrix item
            $first_key = array_key_first($skor_data);
            $m = $this->db->where('id', $first_key)->get('simulasi_matriks')->row();
            $scenario = $this->get_active_scenario($m->jenjang);
            $scenario_id = $scenario ? $scenario->id : 0;
        }
        
        foreach ($skor_data as $matriks_id => $skor) {
            $matriks = $this->db->where('id', $matriks_id)->get('simulasi_matriks')->row();
            if (!$matriks) continue;
            
            $nilai = (float)$skor * (float)$matriks->bobot;
            
            $this->db->where('matriks_id', $matriks_id);
            $this->db->where('scenario_id', $scenario_id);
            $exist = $this->db->get('simulasi_skor_asesor')->row();
            $catatan = isset($catatan_data[$matriks_id]) ? $catatan_data[$matriks_id] : null;
            
            if ($exist) {
                $this->db->where('id', $exist->id)->update('simulasi_skor_asesor', [
                    'skor' => $skor,
                    'nilai' => $nilai,
                    'catatan' => $catatan
                ]);
            } else {
                $this->db->insert('simulasi_skor_asesor', [
                    'matriks_id' => $matriks_id,
                    'scenario_id' => $scenario_id,
                    'skor' => $skor,
                    'nilai' => $nilai,
                    'catatan' => $catatan
                ]);
            }
        }
    }

    /**
     * Fitur Peringatan: Deteksi jika setup borang tidak sesuai dengan standar matriks BAN-PT
     */
    public function get_inconsistencies($jenjang) {
        $inconsistencies = [];
        
        // Tabel yang dilarang/merah untuk D3 berdasarkan gambar matriks
        $not_allowed_for_d3 = ['2a', '2b', '3b4-1', '3b5', '6a', '6b', '8f1-1', '8f4-1', '8f4-2', '8f4-3', '8f4-4'];
        
        if ($jenjang == 'D3') {
            $this->db->where_in('kode_tabel', $not_allowed_for_d3);
            $invalid_tables = $this->db->get('setup_tabel_borang')->result();
            
            foreach ($invalid_tables as $table) {
                $filter = json_decode($table->jenjang_filter, true);
                if (is_array($filter) && in_array('D3', $filter)) {
                    $inconsistencies[] = "Tabel <strong>{$table->kode_tabel}</strong> ({$table->nama_tabel}) diaktifkan di Setup, namun menurut BAN-PT <strong>tidak dinilai</strong> untuk jenjang D3.";
                }
            }
        }
        
        return $inconsistencies;
    }

    public function recalculate_sistem($jenjang) {
        if ($jenjang == 'D3') {
            $this->_calc_kecukupan_dosen_d3();
            $this->_calc_keketatan_seleksi_d3();
            $this->_calc_ipk_lulusan_d3();
            $this->_calc_masa_studi_d3();
        } else if ($jenjang == 'S1') {
            $this->_calc_kecukupan_dosen_s1();
            $this->_calc_kualifikasi_dosen_s1();
            $this->_calc_jabatan_dosen_s1();
            $this->_calc_keketatan_seleksi_s1();
            $this->_calc_ipk_lulusan_s1();
            $this->_calc_masa_studi_s1();
            $this->_calc_waktu_tunggu_s1();
        }
        
        // Elemen kualitatif (input asesor) tidak dikalkulasi otomatis oleh sistem
    }
    
    private function _calc_keketatan_seleksi_d3() {
        // Ambil data terbaru dari trx_seleksi_mahasiswa
        $row = $this->db->order_by('tahun_akademik', 'DESC')->limit(1)->get('trx_seleksi_mahasiswa')->row();
        
        $skor = 0;
        if ($row && $row->lulus_seleksi > 0) {
            $rasio = $row->pendaftar / $row->lulus_seleksi;
            
            if ($rasio >= 5) {
                $skor = 4.00;
            } else if ($rasio > 1 && $rasio < 5) {
                $skor = ($rasio - 1) * 0.75 + 1;
            } else {
                $skor = 0.00;
            }
        }
        
        $this->_save_skor_sistem('C.3.4.a', 'D3', $skor);
    }

    private function _calc_ipk_lulusan_d3() {
        // Rata-rata IPK 3 tahun terakhir
        $this->db->select_avg('ipk_rata');
        $this->db->from('trx_ipk_lulusan');
        $row = $this->db->get()->row();
        
        $skor = 0;
        if ($row && $row->ipk_rata) {
            $ripk = $row->ipk_rata;
            if ($ripk >= 3.00) {
                $skor = 4.00;
            } else if ($ripk >= 2.00 && $ripk < 3.00) {
                $skor = ($ripk - 2.00) * 4;
            } else {
                $skor = 0.00;
            }
        }
        
        $this->_save_skor_sistem('C.9.4.a', 'D3', $skor);
    }

    private function _calc_masa_studi_d3() {
        // Rata-rata masa studi (asumsi dalam semester di DB, kita ubah ke tahun)
        $this->db->select_avg('rata_masa_studi');
        $row = $this->db->get('trx_masa_studi')->row();
        
        $skor = 0;
        if ($row && $row->rata_masa_studi) {
            $ms = $row->rata_masa_studi; // Misal 6 semester
            $ms_tahun = $ms / 2; // Ubah ke tahun
            
            if ($ms_tahun <= 3.0) {
                $skor = 4.00;
            } else if ($ms_tahun > 3.0 && $ms_tahun <= 4.0) {
                $skor = 4 - ($ms_tahun - 3.0) * 4;
            } else {
                $skor = 0.00;
            }
        }
        
        $this->_save_skor_sistem('C.9.4.c', 'D3', $skor);
    }

    private function _calc_kecukupan_dosen_d3() {
        $ndTPS = $this->db->where('kesesuaian_kompetensi', 1)
                          ->where('status_ikatan', 'tetap')
                          ->count_all_results('master_dosen');
                          
        $skor = 0;
        if ($ndTPS >= 12) {
            $skor = 4.00;
        } else if ($ndTPS >= 3 && $ndTPS < 12) {
            $skor = ($ndTPS - 3) * (4 / 9);
        } else {
            $skor = 0.00;
        }
        
        $this->_save_skor_sistem('C.4.4.a', 'D3', $skor);
    }

    /**
     * --- PERHITUNGAN JENJANG S1 ---
     */

    private function _calc_kecukupan_dosen_s1() {
        $ndTPS = $this->db->where('kesesuaian_kompetensi', 1)
                          ->where('status_ikatan', 'tetap')
                          ->count_all_results('master_dosen');
        
        $skor = 0;
        if ($ndTPS >= 12) {
            $skor = 4.00;
        } else if ($ndTPS >= 6 && $ndTPS < 12) {
            $skor = (2 * $ndTPS + 12) / 9;
        } else {
            $skor = 0.00;
        }
        
        $this->_save_skor_sistem('C.4.4.a', 'S1', $skor);
    }

    private function _calc_kualifikasi_dosen_s1() {
        $total_dosen = $this->db->where('status_ikatan', 'tetap')->count_all_results('master_dosen');
        $doktor = $this->db->where('status_ikatan', 'tetap')->where('pendidikan_pasca', 'S3')->count_all_results('master_dosen');
        
        $skor = 0;
        if ($total_dosen > 0) {
            $pds = ($doktor / $total_dosen) * 100;
            if ($pds >= 50) {
                $skor = 4.00;
            } else {
                $skor = 2 + (4 * ($pds/100));
            }
        }
        
        $this->_save_skor_sistem('C.4.4.b', 'S1', $skor);
    }

    private function _calc_jabatan_dosen_s1() {
        $total_dosen = $this->db->where('status_ikatan', 'tetap')->count_all_results('master_dosen');
        $lk_gb = $this->db->where('status_ikatan', 'tetap')
                          ->where_in('jabatan_akademik', ['Lektor Kepala', 'Guru Besar'])
                          ->count_all_results('master_dosen');
        
        $skor = 0;
        if ($total_dosen > 0) {
            $pjab = ($lk_gb / $total_dosen) * 100;
            if ($pjab >= 70) {
                $skor = 4.00;
            } else {
                $skor = 2 + ( (20/7) * ($pjab/100) * 10 ); // Disederhanakan dari rumus matriks
            }
        }
        
        $this->_save_skor_sistem('C.4.4.c', 'S1', $skor);
    }

    private function _calc_keketatan_seleksi_s1() {
        $row = $this->db->order_by('tahun_akademik', 'DESC')->limit(1)->get('trx_seleksi_mahasiswa')->row();
        $skor = 0;
        if ($row && $row->lulus_seleksi > 0) {
            $rasio = $row->pendaftar / $row->lulus_seleksi;
            if ($rasio >= 5) $skor = 4.00;
            else if ($rasio > 1) $skor = ($rasio - 1) * 0.75 + 1;
        }
        $this->_save_skor_sistem('C.3.4.a', 'S1', $skor);
    }

    private function _calc_ipk_lulusan_s1() {
        $this->db->select_avg('ipk_rata');
        $row = $this->db->get('trx_ipk_lulusan')->row();
        $skor = 0;
        if ($row && $row->ipk_rata) {
            $ripk = $row->ipk_rata;
            if ($ripk >= 3.25) $skor = 4.00;
            else if ($ripk >= 2.00) $skor = ($ripk - 2.00) / 1.25 * 4;
        }
        $this->_save_skor_sistem('C.9.4.a', 'S1', $skor);
    }

    private function _calc_masa_studi_s1() {
        $this->db->select_avg('rata_masa_studi');
        $row = $this->db->get('trx_masa_studi')->row();
        $skor = 0;
        if ($row && $row->rata_masa_studi) {
            $ms = $row->rata_masa_studi / 2; // ke tahun
            if ($ms <= 4.0) $skor = 4.00;
            else if ($ms <= 7.0) $skor = (7 - $ms) / 3 * 4;
        }
        $this->_save_skor_sistem('C.9.4.c', 'S1', $skor);
    }

    private function _calc_waktu_tunggu_s1() {
        $row = $this->db->order_by('tahun_lulus', 'DESC')->limit(1)->get('trx_waktu_tunggu')->row();
        $skor = 0;
        if ($row && $row->jml_terlacak > 0) {
            // Asumsi kita hitung rata-rata WT dari kategori
            // (Kurang 3bln = 1.5, 3-6bln = 4.5, >6bln = 9)
            $total_wt = ($row->wt_kurang_3bln * 1.5) + ($row->wt_3_sd_6bln * 4.5) + ($row->wt_lebih_6bln * 9);
            $avg_wt = $total_wt / $row->jml_terlacak;
            
            if ($avg_wt <= 6) $skor = 4.00;
            else if ($avg_wt <= 18) $skor = (18 - $avg_wt) / 12 * 4;
        }
        $this->_save_skor_sistem('C.9.4.d', 'S1', $skor);
    }

    /**
     * Data untuk Visualisasi Radar Chart (Skor 0-4 per Kriteria)
     */
    public function get_radar_data($jenjang) {
        $labels = ['C1: Visi Misi', 'C2: Tata Pamong', 'C3: Mahasiswa', 'C4: SDM', 'C5: Keuangan', 'C6: Pendidikan', 'C7: Penelitian', 'C8: PkM', 'C9: Luaran'];
        
        $sistem = array_fill(0, 9, 0);
        $asesor = array_fill(0, 9, 0);
        
        // Ambil rata-rata skor per kriteria (C1 s/d C9)
        $this->db->select("SUBSTRING_INDEX(m.kode_elemen, '.', 2) as kriteria, AVG(ss.skor) as avg_sistem, AVG(sa.skor) as avg_asesor");
        $this->db->from('simulasi_matriks m');
        $this->db->join('simulasi_skor_sistem ss', 'ss.matriks_id = m.id', 'left');
        $this->db->join('simulasi_skor_asesor sa', 'sa.matriks_id = m.id', 'left');
        $this->db->where('m.jenjang', $jenjang);
        $this->db->group_by("SUBSTRING_INDEX(m.kode_elemen, '.', 2)");
        $results = $this->db->get()->result();
        
        foreach ($results as $row) {
            $parts = explode('.', $row->kriteria);
            if (isset($parts[0]) && $parts[0] == 'C' && isset($parts[1])) {
                $idx = intval($parts[1]) - 1;
                if ($idx >= 0 && $idx < 9) {
                    $sistem[$idx] = round($row->avg_sistem, 2);
                    $asesor[$idx] = round($row->avg_asesor, 2);
                }
            }
        }
        
        return [
            'labels' => $labels,
            'sistem' => $sistem,
            'asesor' => $asesor
        ];
    }

    /**
     * Evaluasi Syarat Perlu Terakreditasi & Syarat Perlu Unggul
     */
    public function get_syarat_perlu($jenjang, $type = 'sistem', $scenario_id = null) {
        $results = [];
        
        if (!$scenario_id) {
            $scenario = $this->get_active_scenario($jenjang);
            $scenario_id = $scenario ? $scenario->id : 0;
        }

        $table = ($type == 'asesor') ? 'simulasi_skor_asesor' : 'simulasi_skor_sistem';
        $alias = ($type == 'asesor') ? 'sa' : 'ss';

        // Ambil skor aktual
        $skor_aktual = $this->db->select("m.kode_elemen, $alias.skor")
                                ->from('simulasi_matriks m')
                                ->join("$table $alias", "$alias.matriks_id = m.id AND $alias.scenario_id = $scenario_id", 'left')
                                ->where('m.jenjang', $jenjang)
                                ->get()->result();
        
        $scores = [];
        foreach($skor_aktual as $s) { $scores[$s->kode_elemen] = $s->skor; }

        if ($jenjang == 'D3') {
            // Syarat 1: Kecukupan Dosen Tetap (C.4.4.a)
            $skor_dosen = isset($scores['C.4.4.a']) ? $scores['C.4.4.a'] : 0;
            $results[] = [
                'nama' => 'Kecukupan Dosen Tetap (NDTPS >= 12)',
                'skor' => $skor_dosen,
                'syarat_unggul' => 3.5,
                'syarat_baik_sekali' => 3.0,
                'syarat_minimum' => 1.0,
                'status' => ($skor_dosen >= 3.5) ? 'Lolos' : (($skor_dosen >= 1.0) ? 'Warning' : 'Kritis')
            ];

            // Syarat 2: Jabatan Akademik (C.4.4.c)
            $skor_jabatan = isset($scores['C.4.4.c']) ? $scores['C.4.4.c'] : 0;
            $results[] = [
                'nama' => 'Jabatan Akademik (LK/GB >= 20%)',
                'skor' => $skor_jabatan,
                'syarat_unggul' => 3.0,
                'syarat_baik_sekali' => 2.5,
                'syarat_minimum' => 0.5,
                'status' => ($skor_jabatan >= 3.0) ? 'Lolos' : (($skor_jabatan >= 0.5) ? 'Warning' : 'Kritis')
            ];

            // Syarat 3: Kurikulum (C.6.4.a)
            $skor_kurikulum = isset($scores['C.6.4.a']) ? $scores['C.6.4.a'] : 0;
            $results[] = [
                'nama' => 'Kesesuaian Kurikulum & Magang Industri',
                'skor' => $skor_kurikulum,
                'syarat_unggul' => 3.0,
                'syarat_baik_sekali' => 2.0,
                'syarat_minimum' => 1.0,
                'status' => ($skor_kurikulum >= 3.0) ? 'Lolos' : (($skor_kurikulum >= 1.0) ? 'Warning' : 'Kritis')
            ];

            // Syarat 4: Waktu Tunggu (C.9.4.d)
            $skor_wt = isset($scores['C.9.4.d']) ? $scores['C.9.4.d'] : 0;
            $results[] = [
                'nama' => 'Waktu Tunggu Lulusan (WT <= 3 Bln)',
                'skor' => $skor_wt,
                'syarat_unggul' => 3.0,
                'syarat_baik_sekali' => 2.0,
                'syarat_minimum' => 0.5,
                'status' => ($skor_wt >= 3.0) ? 'Lolos' : (($skor_wt >= 0.5) ? 'Warning' : 'Kritis')
            ];

            // Syarat 5: Kesesuaian Bidang Kerja (C.9.4.e)
            $skor_pbs = isset($scores['C.9.4.e']) ? $scores['C.9.4.e'] : 0;
            $results[] = [
                'nama' => 'Kesesuaian Bidang Kerja (PBS >= 80%)',
                'skor' => $skor_pbs,
                'syarat_unggul' => 3.0,
                'syarat_baik_sekali' => 2.0,
                'syarat_minimum' => 0.5,
                'status' => ($skor_pbs >= 3.0) ? 'Lolos' : (($skor_pbs >= 0.5) ? 'Warning' : 'Kritis')
            ];

            // Syarat 6: SPMI (Penjaminan Mutu - C.2.4.c)
            $skor_spmi = isset($scores['C.2.4.c']) ? $scores['C.2.4.c'] : 0;
            $results[] = [
                'nama' => 'Sistem Penjaminan Mutu Internal',
                'skor' => $skor_spmi,
                'syarat_unggul' => 3.0,
                'syarat_baik_sekali' => 2.0,
                'syarat_minimum' => 1.0,
                'status' => ($skor_spmi >= 3.0) ? 'Lolos' : (($skor_spmi >= 1.0) ? 'Warning' : 'Kritis')
            ];
        }
 else if ($jenjang == 'S1') {
             // Syarat 1: Kecukupan Dosen Tetap (C.4.4.a)
             $skor_dosen = isset($scores['C.4.4.a']) ? $scores['C.4.4.a'] : 0;
             $results[] = [
                 'nama' => 'Kecukupan Dosen Tetap (NDTPS >= 12)',
                 'skor' => $skor_dosen,
                 'syarat_unggul' => 3.5,
                 'syarat_baik_sekali' => 3.0,
                 'syarat_minimum' => 1.0,
                 'status' => ($skor_dosen >= 3.5) ? 'Lolos' : (($skor_dosen >= 1.0) ? 'Warning' : 'Kritis')
             ];
 
             // Syarat 2: Kualifikasi Dosen (C.4.4.b)
             $skor_doktor = isset($scores['C.4.4.b']) ? $scores['C.4.4.b'] : 0;
             $results[] = [
                 'nama' => 'Kualifikasi Doktor (S3 >= 50%)',
                 'skor' => $skor_doktor,
                 'syarat_unggul' => 3.5,
                 'syarat_baik_sekali' => 2.5,
                 'syarat_minimum' => 1.0,
                 'status' => ($skor_doktor >= 3.5) ? 'Lolos' : (($skor_doktor >= 1.0) ? 'Warning' : 'Kritis')
             ];

             // Syarat 3: Jabatan Akademik (C.4.4.c)
             $skor_jabatan = isset($scores['C.4.4.c']) ? $scores['C.4.4.c'] : 0;
             $results[] = [
                 'nama' => 'Jabatan Akademik (LK/GB >= 70%)',
                 'skor' => $skor_jabatan,
                 'syarat_unggul' => 3.5,
                 'syarat_baik_sekali' => 2.5,
                 'syarat_minimum' => 1.0,
                 'status' => ($skor_jabatan >= 3.5) ? 'Lolos' : (($skor_jabatan >= 1.0) ? 'Warning' : 'Kritis')
             ];
        }

        return $results;
    }

    /**
     * Prediksi Peringkat Akreditasi berdasarkan Skor & Syarat Perlu
     */
    public function predict_peringkat($jenjang, $type = 'asesor', $scenario_id = null) {
        $total_skor = ($type == 'asesor') ? $this->get_total_skor_asesor($jenjang, $scenario_id) : $this->get_total_skor_sistem($jenjang, $scenario_id);
        $syarat_perlu = $this->get_syarat_perlu($jenjang, $type, $scenario_id);
        
        $is_min_met = true;
        $is_unggul_met = true;
        $is_baik_sekali_met = true;
        
        foreach ($syarat_perlu as $sp) {
            // Syarat Minimum Terakreditasi
            if ($sp['skor'] < $sp['syarat_minimum']) {
                $is_min_met = false;
            }
            // Syarat Unggul
            if ($sp['skor'] < $sp['syarat_unggul']) {
                $is_unggul_met = false;
            }
            // Syarat Baik Sekali
            if ($sp['skor'] < $sp['syarat_baik_sekali']) {
                $is_baik_sekali_met = false;
            }
        }
        
        if (!$is_min_met || $total_skor < 200) {
            return "Tidak Terakreditasi";
        }
        
        if ($total_skor >= 361 && $is_unggul_met) {
            return "Unggul";
        }
        
        if ($total_skor >= 301 && $is_baik_sekali_met) {
            return "Baik Sekali";
        }
        
        if ($total_skor >= 200) {
            return "Baik";
        }
        
        return "Tidak Terakreditasi";
    }
    
    private function _save_skor_sistem($kode_elemen, $jenjang, $skor) {
        $matriks = $this->db->where('kode_elemen', $kode_elemen)
                            ->where('jenjang', $jenjang)
                            ->get('simulasi_matriks')->row();
                            
        if ($matriks) {
            $scenario = $this->get_active_scenario($jenjang);
            $scenario_id = $scenario ? $scenario->id : 0;
            
            $nilai = (float)$skor * (float)$matriks->bobot;
            $this->db->where('matriks_id', $matriks->id);
            $this->db->where('scenario_id', $scenario_id);
            $exist = $this->db->get('simulasi_skor_sistem')->row();
            
            if ($exist) {
                $this->db->where('id', $exist->id)->update('simulasi_skor_sistem', [
                    'skor' => $skor,
                    'nilai' => $nilai
                ]);
            } else {
                $this->db->insert('simulasi_skor_sistem', [
                    'matriks_id' => $matriks->id,
                    'scenario_id' => $scenario_id,
                    'skor' => $skor,
                    'nilai' => $nilai
                ]);
            }
        }
    }

    /**
     * MULTI-SCENARIO MANAGEMENT
     */
    public function get_scenarios($jenjang) {
        return $this->db->where('jenjang', $jenjang)->order_by('created_at', 'DESC')->get('simulasi_scenarios')->result();
    }

    public function get_active_scenario($jenjang) {
        return $this->db->where('jenjang', $jenjang)->where('is_active', 1)->get('simulasi_scenarios')->row();
    }

    public function set_active_scenario($scenario_id, $jenjang) {
        $this->db->where('jenjang', $jenjang)->update('simulasi_scenarios', ['is_active' => 0]);
        $this->db->where('id', $scenario_id)->update('simulasi_scenarios', ['is_active' => 1]);
    }

    public function add_scenario($nama, $jenjang) {
        $this->db->insert('simulasi_scenarios', [
            'nama_skenario' => $nama,
            'jenjang' => $jenjang,
            'is_active' => 0
        ]);
        return $this->db->insert_id();
    }

    /**
     * FITUR UNGGULAN: Rekomendasi Strategis Otomatis
     * Memberikan saran perbaikan berdasarkan skor yang rendah
     */
    public function get_rekomendasi($jenjang) {
        $rekomendasi = [];
        
        // Ambil skor terbaru
        $skor_aktual = $this->db->select('m.kode_elemen, ss.skor')
                                ->from('simulasi_matriks m')
                                ->join('simulasi_skor_sistem ss', 'ss.matriks_id = m.id', 'left')
                                ->where('m.jenjang', $jenjang)
                                ->get()->result();
        
        $scores = [];
        foreach($skor_aktual as $s) { $scores[$s->kode_elemen] = $s->skor; }

        // Logic Rekomendasi D3
        if ($jenjang == 'D3') {
            if (isset($scores['C.4.4.a']) && $scores['C.4.4.a'] < 3.5) {
                $rekomendasi[] = [
                    'kategori' => 'SDM',
                    'pesan' => 'Jumlah Dosen Tetap (NDTPS) Anda di bawah standar Unggul. Rekomendasi: Lakukan rekrutmen dosen tetap baru agar jumlah mencapai minimal 12 orang.',
                    'urgensi' => 'Tinggi'
                ];
            }
            if (isset($scores['C.4.4.d']) && $scores['C.4.4.d'] < 3.0) {
                $rekomendasi[] = [
                    'kategori' => 'SDM',
                    'pesan' => 'Persentase dosen bersertifikat industri masih rendah. Rekomendasi: Daftarkan dosen untuk sertifikasi kompetensi/profesi yang relevan dengan prodi D3.',
                    'urgensi' => 'Sedang'
                ];
            }
            if (isset($scores['C.9.4.d']) && $scores['C.9.4.d'] < 3.0) {
                $rekomendasi[] = [
                    'kategori' => 'Luaran',
                    'pesan' => 'Waktu tunggu lulusan terlalu lama (> 3 bulan). Rekomendasi: Perkuat kerjasama dengan industri untuk penyaluran lulusan dan intensifkan program bursa kerja (Job Fair).',
                    'urgensi' => 'Tinggi'
                ];
            }
            if (isset($scores['C.9.4.e']) && $scores['C.9.4.e'] < 3.0) {
                $rekomendasi[] = [
                    'kategori' => 'Luaran',
                    'pesan' => 'Banyak lulusan bekerja tidak sesuai bidang. Rekomendasi: Tinjau ulang kurikulum agar lebih selaras (link & match) dengan kebutuhan industri saat ini.',
                    'urgensi' => 'Tinggi'
                ];
            }
        } 
        
        // Logic Rekomendasi S1
        else if ($jenjang == 'S1') {
            if (isset($scores['C.4.4.b']) && $scores['C.4.4.b'] < 3.5) {
                $rekomendasi[] = [
                    'kategori' => 'SDM',
                    'pesan' => 'Rasio dosen bergelar Doktor (S3) di bawah 50%. Rekomendasi: Berikan beasiswa atau tugas belajar bagi dosen S2 untuk segera melanjutkan studi S3.',
                    'urgensi' => 'Tinggi'
                ];
            }
            if (isset($scores['C.4.4.c']) && $scores['C.4.4.c'] < 3.5) {
                $rekomendasi[] = [
                    'kategori' => 'SDM',
                    'pesan' => 'Proporsi Lektor Kepala dan Guru Besar belum optimal. Rekomendasi: Percepat pengurusan kenaikan jabatan akademik bagi dosen yang sudah memenuhi syarat.',
                    'urgensi' => 'Tinggi'
                ];
            }
            if (isset($scores['C.9.4.a']) && $scores['C.9.4.a'] < 3.0) {
                $rekomendasi[] = [
                    'kategori' => 'Luaran',
                    'pesan' => 'Rata-rata IPK lulusan perlu ditingkatkan. Rekomendasi: Tingkatkan kualitas proses pembelajaran dan sistem pendampingan akademik (PA).',
                    'urgensi' => 'Sedang'
                ];
            }
        }

        return $rekomendasi;
    }
}
