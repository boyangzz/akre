<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_validation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Simulasi_model');
        // Bypass security for testing
        $this->db->query("SET FOREIGN_KEY_CHECKS = 0;");
    }

    public function index() {
        $data = [
            'page_title' => 'QC Testing Suite - AKRE',
            'suites' => [
                ['id' => 'sdm', 'name' => 'SDM & Dosen', 'icon' => 'bi-person-badge', 'desc' => 'Uji akurasi NDTPS, Jabatan, dan Kualifikasi.'],
                ['id' => 'luaran', 'name' => 'Mahasiswa & Luaran', 'icon' => 'bi-mortarboard', 'desc' => 'Uji Rasio Seleksi, IPK, dan Masa Studi.'],
                ['id' => 'governance', 'name' => 'Tata Kelola', 'icon' => 'bi-diagram-3', 'desc' => 'Uji Kerjasama dan Standar Pengelolaan.'],
            ]
        ];
        $this->load->view('test/dashboard', $data);
    }

    public function suite($type) {
        $results = [];
        $this->db->truncate('simulasi_skor_sistem');

        if ($type == 'sdm') {
            $results[] = $this->_test_s1_ndtps();
            $results[] = $this->_test_d3_ndtps();
            $results[] = $this->_test_s1_doktor();
        } else if ($type == 'luaran') {
            $results[] = $this->_test_seleksi_mhs();
            $results[] = $this->_test_ipk_lulusan();
        } else if ($type == 'governance') {
            $results[] = $this->_test_kerjasama_s1();
        }

        $data = [
            'page_title' => 'Hasil Pengujian: ' . strtoupper($type),
            'results'    => $results,
            'current_suite' => $type
        ];
        $this->load->view('test/results', $data);
    }

    // --- SDM TESTS ---
    private function _test_s1_ndtps() {
        $this->db->truncate('master_dosen');
        $this->db->update('identitas_pengusul', ['jenjang' => 'S1'], ['id >' => 0]);
        for ($i=1; $i<=6; $i++) {
            $this->db->insert('master_dosen', ['nidn'=>'01'.$i, 'nama'=>'D'.$i, 'status_ikatan'=>'tetap', 'kesesuaian_kompetensi'=>1, 'status_aktif'=>1, 'prodi_id'=>1]);
        }
        $this->Simulasi_model->recalculate_sistem('S1');
        $row = $this->db->select('ss.skor')->from('simulasi_skor_sistem ss')->join('simulasi_matriks m', 'm.id = ss.matriks_id')->where('m.kode_elemen', 'C.4.4.a')->where('m.jenjang', 'S1')->get()->row();
        $actual = $row ? $row->skor : 0;
        return ['name'=>'NDTPS S1 (6 Dosen)', 'formula'=>'(2*6+12)/9', 'expected'=>2.67, 'actual'=>(float)$actual, 'status'=>abs($actual-2.67)<0.05?'PASS':'FAIL'];
    }

    private function _test_d3_ndtps() {
        $this->db->truncate('master_dosen');
        $this->db->update('identitas_pengusul', ['jenjang' => 'D3'], ['id >' => 0]);
        for ($i=1; $i<=6; $i++) {
            $this->db->insert('master_dosen', ['nidn'=>'02'.$i, 'nama'=>'D'.$i, 'status_ikatan'=>'tetap', 'kesesuaian_kompetensi'=>1, 'status_aktif'=>1, 'prodi_id'=>1]);
        }
        $this->Simulasi_model->recalculate_sistem('D3');
        $row = $this->db->select('ss.skor')->from('simulasi_skor_sistem ss')->join('simulasi_matriks m', 'm.id = ss.matriks_id')->where('m.kode_elemen', 'C.4.4.a')->where('m.jenjang', 'D3')->get()->row();
        $actual = $row ? $row->skor : 0;
        return ['name'=>'NDTPS D3 (6 Dosen)', 'formula'=>'(6-3)*(4/9)', 'expected'=>1.33, 'actual'=>(float)$actual, 'status'=>abs($actual-1.33)<0.05?'PASS':'FAIL'];
    }

    private function _test_s1_doktor() {
        $this->db->truncate('master_dosen');
        for ($i=1; $i<=6; $i++) {
            $this->db->insert('master_dosen', ['nidn'=>'03'.$i, 'nama'=>'D'.$i, 'status_ikatan'=>'tetap', 'pendidikan_pasca'=>($i<=3?'S3':'S2'), 'kesesuaian_kompetensi'=>1, 'status_aktif'=>1, 'prodi_id'=>1]);
        }
        $this->Simulasi_model->recalculate_sistem('S1');
        $row = $this->db->select('ss.skor')->from('simulasi_skor_sistem ss')->join('simulasi_matriks m', 'm.id = ss.matriks_id')->where('m.kode_elemen', 'C.4.4.b')->where('m.jenjang', 'S1')->get()->row();
        $actual = $row ? $row->skor : 0;
        return ['name'=>'Kualifikasi Doktor (50%)', 'formula'=>'PDS >= 50% ? 4', 'expected'=>4.00, 'actual'=>(float)$actual, 'status'=>(float)$actual==4.00?'PASS':'FAIL'];
    }

    // --- LUARAN TESTS ---
    private function _test_seleksi_mhs() {
        $this->db->truncate('trx_seleksi_mahasiswa');
        $this->db->insert('trx_seleksi_mahasiswa', [
            'tahun_akademik' => '2023', 
            'daya_tampung'   => 20, 
            'pendaftar'      => 100, 
            'lulus_seleksi'  => 20, 
            'maba_reguler'   => 20, 
            'prodi_id'       => 1
        ]);
        $this->Simulasi_model->recalculate_sistem('S1');
        $row = $this->db->select('ss.skor')->from('simulasi_skor_sistem ss')->join('simulasi_matriks m', 'm.id = ss.matriks_id')->where('m.kode_elemen', 'C.3.4.a')->where('m.jenjang', 'S1')->get()->row();
        $actual = $row ? $row->skor : 0;
        return ['name'=>'Rasio Seleksi (1:5)', 'formula'=>'Rasio >= 5 ? 4', 'expected'=>4.00, 'actual'=>(float)$actual, 'status'=>(float)$actual==4.00?'PASS':'FAIL'];
    }

    private function _test_ipk_lulusan() {
        $this->db->truncate('trx_ipk_lulusan');
        $this->db->insert('trx_ipk_lulusan', ['tahun_lulus'=>'2023', 'jml_lulusan'=>10, 'ipk_min'=>3.0, 'ipk_rata'=>3.5, 'ipk_max'=>4.0, 'prodi_id'=>1]);
        $this->Simulasi_model->recalculate_sistem('S1');
        $row = $this->db->select('ss.skor')->from('simulasi_skor_sistem ss')->join('simulasi_matriks m', 'm.id = ss.matriks_id')->where('m.kode_elemen', 'C.9.4.a')->where('m.jenjang', 'S1')->get()->row();
        $actual = $row ? $row->skor : 0;
        return ['name'=>'IPK Lulusan (3.50)', 'formula'=>'IPK >= 3.25 ? 4', 'expected'=>4.00, 'actual'=>(float)$actual, 'status'=>(float)$actual==4.00?'PASS':'FAIL'];
    }

    // --- GOVERNANCE TESTS ---
    private function _test_kerjasama_s1() {
        $this->db->truncate('trx_kerjasama');
        // Insert 4 Internasional (4 * 3 = 12 poin, target >= 10 poin for Score 4)
        for ($i=1; $i<=4; $i++) {
            $this->db->insert('trx_kerjasama', [
                'lembaga_mitra' => 'University ' . $i,
                'tingkat' => 'internasional',
                'judul_kegiatan' => 'Joint Research ' . $i,
                'prodi_id' => 1
            ]);
        }
        $this->Simulasi_model->recalculate_sistem('S1');
        $row = $this->db->select('ss.skor')->from('simulasi_skor_sistem ss')->join('simulasi_matriks m', 'm.id = ss.matriks_id')->where('m.kode_elemen', 'C.2.4.a')->where('m.jenjang', 'S1')->get()->row();
        $actual = $row ? $row->skor : 0;
        return ['name'=>'Kerjasama S1 (4 Internasional)', 'formula'=>'Poin >= 10 ? 4', 'expected'=>4.00, 'actual'=>(float)$actual, 'status'=>(float)$actual==4.00?'PASS':'FAIL'];
    }
}
