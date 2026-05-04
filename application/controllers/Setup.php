<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Borang_setup_model');
    }

    public function borang()
    {
        $data = [
            'page_title' => 'Pengaturan Borang',
            'records'    => $this->Borang_setup_model->get_all(),
        ];
        $this->render('setup/borang_list', $data);
    }

    public function borang_form($id)
    {
        $data = [
            'page_title' => 'Edit Aturan Borang',
            'record'     => $this->Borang_setup_model->get_by_id($id),
        ];
        $this->render('setup/borang_form', $data);
    }

    public function borang_save($id)
    {
        $jenjang = $this->input->post('jenjang_filter');
        $data = [
            'nama_tabel'     => $this->input->post('nama_tabel', true),
            'jenjang_filter' => json_encode($jenjang),
            'is_wajib'       => $this->input->post('is_wajib') ? 1 : 0,
            'urutan'         => $this->input->post('urutan', true),
        ];

        $this->db->where('id', $id)->update('setup_tabel_borang', $data);
        $this->session->set_flashdata('success', 'Aturan borang berhasil diperbarui.');
        redirect('setup/borang');
    }

    public function reset_standard()
    {
        $this->Borang_setup_model->reset_d3_standard();
        $this->session->set_flashdata('success', 'Solusi Jangka Panjang: Setup Borang untuk jenjang D3 berhasil direstorasi dan divalidasi dengan Standar Matriks BAN-PT (Sesuai Gambar Acuan).');
        redirect('setup/borang');
    }
}
