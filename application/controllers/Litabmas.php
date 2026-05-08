<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Litabmas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sumber_daya_model');
    }

    public function penelitian()
    {
        $this->guard_jenjang('6a');
        $data = [
            'page_title' => 'Penelitian DTPS yang melibatkan Mahasiswa (6.a)',
            'records'    => $this->db->select('t.*, d.nama as nama_dosen, m.nama as nama_mahasiswa')
                                     ->from('trx_penelitian_dtps t')
                                     ->join('master_dosen d', 'd.id = t.dosen_id', 'left')
                                     ->join('master_mahasiswa m', 'm.id = t.mahasiswa_id', 'left')
                                     ->where('t.melibatkan_mahasiswa', 1)
                                     ->get()->result(),
            'list_dosen' => $this->db->get('master_dosen')->result(),
            'list_mhs'   => $this->db->get('master_mahasiswa')->result(),
        ];
        $this->render('litabmas/penelitian_list', $data);
    }

    public function penelitian_6b()
    {
        $this->guard_jenjang('6b');
        $data = [
            'page_title' => 'Penelitian DTPS Rujukan Tesis/Disertasi (6.b)',
            'records'    => $this->db->select('t.*, d.nama as nama_dosen, m.nama as nama_mahasiswa')
                                     ->from('trx_penelitian_dtps t')
                                     ->join('master_dosen d', 'd.id = t.dosen_id', 'left')
                                     ->join('master_mahasiswa m', 'm.id = t.mahasiswa_id', 'left')
                                     ->get()->result(),
            'list_dosen' => $this->db->get('master_dosen')->result(),
            'list_mhs'   => $this->db->get('master_mahasiswa')->result(),
        ];
        $this->render('litabmas/penelitian_list', $data);
    }

    public function pkms()
    {
        $this->guard_jenjang('7');
        $data = [
            'page_title' => 'PkM DTPS yang melibatkan Mahasiswa (Tabel 7)',
            'records'    => $this->db->select('t.*, d.nama as nama_dosen, m.nama as nama_mahasiswa')
                                     ->from('trx_pkm_dtps t')
                                     ->join('master_dosen d', 'd.id = t.dosen_id', 'left')
                                     ->join('master_mahasiswa m', 'm.id = t.mahasiswa_id', 'left')
                                     ->where('t.melibatkan_mahasiswa', 1)
                                     ->get()->result(),
            'list_dosen' => $this->db->get('master_dosen')->result(),
            'list_mhs'   => $this->db->get('master_mahasiswa')->result(),
        ];
        $this->render('litabmas/pkm_list', $data);
    }

    public function save_penelitian()
    {
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $data['melibatkan_mahasiswa'] = 1;

        if ($id) {
            $this->db->where('id', $id)->update('trx_penelitian_dtps', $data);
        } else {
            $this->db->insert('trx_penelitian_dtps', $data);
        }
        $this->session->set_flashdata('success', 'Data penelitian berhasil disimpan.');
        redirect('litabmas/penelitian');
    }

    public function penelitian_delete($id)
    {
        $this->guard_jenjang('6a');
        $this->db->where('id', $id)->delete('trx_penelitian_dtps');
        $this->session->set_flashdata('success', 'Data penelitian berhasil dihapus.');
        redirect('litabmas/penelitian');
    }

    public function save_pkm()
    {
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $data['melibatkan_mahasiswa'] = 1;

        if ($id) {
            $this->db->where('id', $id)->update('trx_pkm_dtps', $data);
        } else {
            $this->db->insert('trx_pkm_dtps', $data);
        }
        $this->session->set_flashdata('success', 'Data PkM berhasil disimpan.');
        redirect('litabmas/pkms');
    }

    public function pkm_delete($id)
    {
        $this->guard_jenjang('7');
        $this->db->where('id', $id)->delete('trx_pkm_dtps');
        $this->session->set_flashdata('success', 'Data PkM berhasil dihapus.');
        redirect('litabmas/pkms');
    }

    public function integrasi()
    {
        $this->guard_jenjang('5b');
        $data = [
            'page_title' => 'Integrasi Penelitian/PkM dalam Pembelajaran (5.b)',
            'records'    => $this->db->select('t.*, d.nama as nama_dosen, m.nama_mk')
                                     ->from('trx_integrasi_pembelajaran t')
                                     ->join('master_dosen d', 'd.id = t.dosen_id', 'left')
                                     ->join('master_mata_kuliah m', 'm.id = t.matakuliah_id', 'left')
                                     ->get()->result(),
            'list_dosen' => $this->db->get('master_dosen')->result(),
            'list_mk'    => $this->db->get('master_mata_kuliah')->result(),
        ];
        $this->render('litabmas/integrasi_list', $data);
    }

    public function integrasi_save()
    {
        $this->guard_jenjang('5b');
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        if ($id) {
            $this->db->where('id', $id)->update('trx_integrasi_pembelajaran', $data);
        } else {
            $this->db->insert('trx_integrasi_pembelajaran', $data);
        }
        $this->session->set_flashdata('success', 'Data integrasi berhasil disimpan.');
        redirect('litabmas/integrasi');
    }

    public function integrasi_delete($id)
    {
        $this->guard_jenjang('5b');
        $this->db->where('id', $id)->delete('trx_integrasi_pembelajaran');
        $this->session->set_flashdata('success', 'Data integrasi berhasil dihapus.');
        redirect('litabmas/integrasi');
    }

    public function kepuasan()
    {
        $this->guard_jenjang('5c');
        $data = [
            'page_title' => 'Kepuasan Mahasiswa (5.c)',
            'records'    => $this->db->where('prodi_id', 1)->get('trx_kepuasan_mhs')->result(),
        ];
        $this->render('litabmas/kepuasan_list', $data);
    }

    public function kepuasan_save()
    {
        $this->guard_jenjang('5c');
        $posts = $this->input->post('data', true);
        if ($posts) {
            foreach ($posts as $d) {
                $id = $d['id'];
                unset($d['id']);
                $this->db->where('id', $id)->update('trx_kepuasan_mhs', $d);
            }
        }
        $this->session->set_flashdata('success', 'Data kepuasan mahasiswa berhasil diperbarui.');
        redirect('litabmas/kepuasan');
    }
}
