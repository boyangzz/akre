<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sarpras extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cek apakah tabel 4 diperbolehkan untuk jenjang ini
        $this->guard_jenjang('4');
    }

    public function index()
    {
        $data = [
            'page_title' => 'Penggunaan Dana (Tabel 4)',
            'records'    => $this->db->where('prodi_id', 1)->get('trx_penggunaan_dana')->result(),
        ];
        $this->render('sarpras/penggunaan_dana', $data);
    }

    public function save()
    {
        $posts = $this->input->post('data', true);
        
        if ($posts) {
            foreach ($posts as $data) {
                $id = $data['id'];
                unset($data['id']);
                $data['prodi_id'] = 1;

                if ($id) {
                    $this->db->where('id', $id)->update('trx_penggunaan_dana', $data);
                } else {
                    $this->db->insert('trx_penggunaan_dana', $data);
                }
            }
        }

        $this->session->set_flashdata('success', 'Seluruh data penggunaan dana berhasil disimpan.');
        redirect('sarpras');
    }
}
