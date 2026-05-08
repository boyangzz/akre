<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Identitas extends MY_Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Identitas Pengusul',
            'record'     => $this->db->get('identitas_pengusul')->row(),
        ];
        $this->render('identitas/index', $data);
    }

    public function update()
    {
        $input = [
            'nama_pt'              => $this->input->post('nama_pt', true),
            'nama_fakultas'        => $this->input->post('nama_fakultas', true),
            'nama_prodi'           => $this->input->post('nama_prodi', true),
            'jenjang'              => $this->input->post('jenjang', true),
            'alamat'               => $this->input->post('alamat', true),
            'telepon'              => $this->input->post('telepon', true),
            'email'                => $this->input->post('email', true),
            'website'              => $this->input->post('website', true),
            'no_sk_banpt'          => $this->input->post('no_sk_banpt', true),
            'peringkat_akreditasi' => $this->input->post('peringkat_akreditasi', true),
            'tanggal_kadaluarsa'   => $this->input->post('tanggal_kadaluarsa'),
            'kaprodi_nama'         => $this->input->post('kaprodi_nama', true),
            'kaprodi_nidn'         => $this->input->post('kaprodi_nidn', true),
        ];

        $existing = $this->db->get('identitas_pengusul')->row();
        if ($existing) {
            $this->db->where('id', $existing->id)->update('identitas_pengusul', $input);
        } else {
            $this->db->insert('identitas_pengusul', $input);
        }

        $this->session->set_userdata('jenjang', $input['jenjang']);
        $this->session->set_flashdata('success', 'Identitas pengusul berhasil disimpan.');
        redirect('identitas');
    }

    public function prodi_upps()
    {
        $data = [
            'page_title' => 'Daftar Program Studi di UPPS',
            'records'    => $this->db->get('identitas_prodi_upps')->result(),
        ];
        $this->render('identitas/prodi_upps', $data);
    }

    public function prodi_upps_save()
    {
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');

        if ($id) {
            $this->db->where('id', $id)->update('identitas_prodi_upps', $data);
        } else {
            $this->db->insert('identitas_prodi_upps', $data);
        }

        $this->session->set_flashdata('success', 'Data program studi berhasil disimpan.');
        redirect('identitas/prodi_upps');
    }

    public function prodi_upps_delete($id)
    {
        $this->db->where('id', $id)->delete('identitas_prodi_upps');
        $this->session->set_flashdata('success', 'Data program studi berhasil dihapus.');
        redirect('identitas/prodi_upps');
    }
}
