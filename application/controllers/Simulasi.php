<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulasi extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Simulasi_model');
    }

    public function index() {
        $data['page_title'] = 'Simulasi Akreditasi';
        
        // Cek apakah data matriks untuk jenjang ini tersedia
        $data['matriks_available'] = $this->Simulasi_model->check_matriks_availability($this->current_jenjang);
        
        // Ambil ringkasan skor jika tersedia
        $data['skor_sistem'] = 0;
        $data['skor_asesor'] = 0;
        if ($data['matriks_available']) {
            $data['skor_sistem'] = $this->Simulasi_model->get_total_skor_sistem($this->current_jenjang);
            $data['skor_asesor'] = $this->Simulasi_model->get_total_skor_asesor($this->current_jenjang);
            $data['radar_data'] = $this->Simulasi_model->get_radar_data($this->current_jenjang);
            $data['syarat_perlu'] = $this->Simulasi_model->get_syarat_perlu($this->current_jenjang);
            $data['rekomendasi'] = $this->Simulasi_model->get_rekomendasi($this->current_jenjang);
            $data['scenarios'] = $this->Simulasi_model->get_scenarios($this->current_jenjang);
            $data['active_scenario'] = $this->Simulasi_model->get_active_scenario($this->current_jenjang);
            
            // Prediksi Peringkat
            $data['prediksi_asesor'] = $this->Simulasi_model->predict_peringkat($this->current_jenjang, 'asesor');
            $data['prediksi_sistem'] = $this->Simulasi_model->predict_peringkat($this->current_jenjang, 'sistem');
        }
        
        $this->render('simulasi/index', $data);
    }
    
    public function kertas_kerja() {
        $data['page_title'] = 'Kertas Kerja Asesor';
        $data['matriks'] = $this->Simulasi_model->get_matriks($this->current_jenjang);
        $data['inconsistencies'] = $this->Simulasi_model->get_inconsistencies($this->current_jenjang);
        $data['scenarios'] = $this->Simulasi_model->get_scenarios($this->current_jenjang);
        $data['active_scenario'] = $this->Simulasi_model->get_active_scenario($this->current_jenjang);
        
        // Jika form di-submit
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->Simulasi_model->save_skor_asesor($this->input->post('skor'), $this->input->post('catatan'));
            $this->session->set_flashdata('success', 'Skor & Catatan simulasi asesor berhasil disimpan.');
            redirect('simulasi/kertas_kerja');
        }
        
        $this->render('simulasi/kertas_kerja', $data);
    }
    
    public function recalculate() {
        $this->Simulasi_model->recalculate_sistem($this->current_jenjang);
        $this->session->set_flashdata('success', 'Skor Sistem berhasil dikalkulasi ulang berdasarkan data terbaru.');
        redirect('simulasi');
    }
    
    public function kamus() {
        $data['page_title'] = 'Kamus Matriks & Transparansi Rumus';
        $data['matriks'] = $this->Simulasi_model->get_matriks($this->current_jenjang);
        $this->render('simulasi/kamus', $data);
    }

    public function metodologi() {
        $data['page_title'] = 'Metodologi & Transparansi Skor';
        $this->render('simulasi/metodologi', $data);
    }

    public function laporan() {
        $data['page_title'] = 'Laporan Hasil Simulasi Akreditasi';
        $data['matriks_available'] = $this->Simulasi_model->check_matriks_availability($this->current_jenjang);
        
        if (!$data['matriks_available']) {
            $this->session->set_flashdata('error', 'Matriks untuk jenjang ini belum tersedia.');
            redirect('simulasi');
        }

        $data['matriks'] = $this->Simulasi_model->get_matriks($this->current_jenjang);
        $data['skor_sistem'] = $this->Simulasi_model->get_total_skor_sistem($this->current_jenjang);
        $data['skor_asesor'] = $this->Simulasi_model->get_total_skor_asesor($this->current_jenjang);
        $data['radar_data'] = $this->Simulasi_model->get_radar_data($this->current_jenjang);
        $data['syarat_perlu'] = $this->Simulasi_model->get_syarat_perlu($this->current_jenjang);
        $data['rekomendasi'] = $this->Simulasi_model->get_rekomendasi($this->current_jenjang);
        $data['active_scenario'] = $this->Simulasi_model->get_active_scenario($this->current_jenjang);
        
        // Prediksi Peringkat
        $data['prediksi_asesor'] = $this->Simulasi_model->predict_peringkat($this->current_jenjang, 'asesor');
        $data['prediksi_sistem'] = $this->Simulasi_model->predict_peringkat($this->current_jenjang, 'sistem');
        
        $this->render('simulasi/laporan', $data);
    }
    public function switch_scenario($id) {
        $this->Simulasi_model->set_active_scenario($id, $this->current_jenjang);
        $this->session->set_flashdata('success', 'Skenario berhasil diganti.');
        redirect('simulasi');
    }

    public function add_scenario() {
        $nama = $this->input->post('nama_skenario');
        if ($nama) {
            $this->Simulasi_model->add_scenario($nama, $this->current_jenjang);
            $this->session->set_flashdata('success', 'Skenario baru berhasil dibuat.');
        }
        redirect('simulasi');
    }
}
