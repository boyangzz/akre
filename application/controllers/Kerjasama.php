<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kerjasama extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kerjasama_model');
        $this->guard_jenjang('1-1'); // Default guard for this module
    }

    public function index()
    {
        $data = [
            'page_title' => 'Kerjasama Tridharma',
            'records'    => $this->Kerjasama_model->get_all(),
        ];
        $this->render('kerjasama/list', $data);
    }

    public function form($id = null)
    {
        $data = [
            'page_title' => $id ? 'Edit Kerjasama' : 'Tambah Kerjasama',
            'record'     => $id ? $this->Kerjasama_model->get_by_id($id) : null,
        ];
        $this->render('kerjasama/form', $data);
    }

    public function save($id = null)
    {
        $data = $this->input->post(null, true);
        $data['prodi_id'] = 1; // Temporary fix
        
        if ($id) {
            $this->Kerjasama_model->update($id, $data);
        } else {
            $this->Kerjasama_model->insert($data);
        }
        
        $this->session->set_flashdata('success', 'Data kerjasama berhasil disimpan.');
        redirect('kerjasama');
    }

    public function delete($id)
    {
        $this->Kerjasama_model->delete($id);
        $this->session->set_flashdata('success', 'Data kerjasama berhasil dihapus.');
        redirect('kerjasama');
    }
}
