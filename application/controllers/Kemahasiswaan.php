<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kemahasiswaan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kemahasiswaan_model');
    }

    // ========== SELEKSI (2a) ==========
    public function seleksi()
    {
        $this->guard_jenjang('2a');
        $data = [
            'page_title' => 'Seleksi Mahasiswa Baru (2.a)',
            'records'    => $this->Kemahasiswaan_model->get_seleksi(),
        ];
        $this->render('kemahasiswaan/seleksi', $data);
    }

    public function seleksi_save()
    {
        $this->guard_jenjang('2a');
        $id = $this->input->post('id');
        $data = [
            'tahun_akademik' => $this->input->post('tahun_akademik', true),
            'daya_tampung'   => $this->input->post('daya_tampung', true),
            'pendaftar'      => $this->input->post('pendaftar', true),
            'lulus_seleksi'  => $this->input->post('lulus_seleksi', true),
            'maba_reguler'   => $this->input->post('maba_reguler', true),
            'maba_transfer'  => $this->input->post('maba_transfer', true),
            'mhs_aktif_reguler' => $this->input->post('mhs_aktif_reguler', true),
            'mhs_aktif_transfer' => $this->input->post('mhs_aktif_transfer', true),
            'prodi_id'       => 1,
        ];
        $this->Kemahasiswaan_model->save_seleksi($id, $data);
        $this->session->set_flashdata('success', 'Data seleksi berhasil disimpan.');
        redirect('kemahasiswaan/seleksi');
    }

    public function seleksi_delete($id)
    {
        $this->guard_jenjang('2a');
        $this->db->where('id', $id)->delete('trx_seleksi_mahasiswa');
        $this->session->set_flashdata('success', 'Data seleksi berhasil dihapus.');
        redirect('kemahasiswaan/seleksi');
    }

    // ========== MAHASISWA ASING (2b) ==========
    public function mhs_asing()
    {
        $this->guard_jenjang('2b');
        $data = [
            'page_title' => 'Mahasiswa Asing (2.b)',
            'records'    => $this->Kemahasiswaan_model->get_mhs_asing(),
        ];
        $this->render('kemahasiswaan/mhs_asing', $data);
    }

    public function mhs_asing_save()
    {
        $this->guard_jenjang('2b');
        $id = $this->input->post('id');
        $data = [
            'tahun_akademik' => $this->input->post('tahun_akademik', true),
            'jml_fulltime'   => $this->input->post('jml_fulltime', true),
            'jml_parttime'   => $this->input->post('jml_parttime', true),
            'prodi_id'       => 1,
        ];
        $this->Kemahasiswaan_model->save_mhs_asing($id, $data);
        $this->session->set_flashdata('success', 'Data mahasiswa asing berhasil disimpan.');
        redirect('kemahasiswaan/mhs_asing');
    }

    public function mhs_asing_delete($id)
    {
        $this->guard_jenjang('2b');
        $this->db->where('id', $id)->delete('trx_mahasiswa_asing');
        $this->session->set_flashdata('success', 'Data mahasiswa asing berhasil dihapus.');
        redirect('kemahasiswaan/mhs_asing');
    }
}
