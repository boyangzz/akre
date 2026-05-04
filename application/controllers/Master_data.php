<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_data extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Master_model');
    }

    // ========== DOSEN ==========
    public function dosen()
    {
        $data = [
            'page_title' => 'Data Dosen',
            'records'    => $this->Master_model->get_all_dosen(),
        ];
        $this->render('master/dosen_list', $data);
    }

    public function dosen_form($id = null)
    {
        $data = [
            'page_title' => $id ? 'Edit Dosen' : 'Tambah Dosen',
            'record'     => $id ? $this->Master_model->get_dosen($id) : null,
        ];
        $this->render('master/dosen_form', $data);
    }

    public function dosen_save($id = null)
    {
        $input = [
            'nidn'                  => $this->input->post('nidn', true),
            'nama'                  => $this->input->post('nama', true),
            'pendidikan_pasca'      => $this->input->post('pendidikan_pasca', true),
            'bidang_keahlian'       => $this->input->post('bidang_keahlian', true),
            'kesesuaian_kompetensi' => $this->input->post('kesesuaian_kompetensi') ? 1 : 0,
            'jabatan_akademik'      => $this->input->post('jabatan_akademik', true),
            'sertifikat_pendidik'   => $this->input->post('sertifikat_pendidik') ? 1 : 0,
            'sertifikat_kompetensi' => $this->input->post('sertifikat_kompetensi', true),
            'status_ikatan'         => $this->input->post('status_ikatan', true),
            'status_aktif'          => $this->input->post('status_aktif') ? 1 : 0,
            'prodi_id'              => 1,
        ];

        if ($id) {
            $this->Master_model->update_dosen($id, $input);
            $this->session->set_flashdata('success', 'Data dosen berhasil diperbarui.');
        } else {
            $this->Master_model->insert_dosen($input);
            $this->session->set_flashdata('success', 'Data dosen berhasil ditambahkan.');
        }
        redirect('master_data/dosen');
    }

    public function dosen_delete($id)
    {
        $this->Master_model->delete_dosen($id);
        $this->session->set_flashdata('success', 'Data dosen berhasil dihapus.');
        redirect('master_data/dosen');
    }

    // ========== MAHASISWA ==========
    public function mahasiswa()
    {
        $data = [
            'page_title' => 'Data Mahasiswa',
            'records'    => $this->Master_model->get_all_mahasiswa(),
        ];
        $this->render('master/mahasiswa_list', $data);
    }

    public function mahasiswa_form($id = null)
    {
        $data = [
            'page_title' => $id ? 'Edit Mahasiswa' : 'Tambah Mahasiswa',
            'record'     => $id ? $this->Master_model->get_mahasiswa($id) : null,
        ];
        $this->render('master/mahasiswa_form', $data);
    }

    public function mahasiswa_save($id = null)
    {
        $input = [
            'nim'      => $this->input->post('nim', true),
            'nama'     => $this->input->post('nama', true),
            'angkatan' => $this->input->post('angkatan', true),
            'status'   => $this->input->post('status', true) ?: 'aktif',
            'jenis'    => $this->input->post('jenis', true) ?: 'reguler',
            'prodi_id' => 1,
        ];

        if ($id) {
            $this->Master_model->update_mahasiswa($id, $input);
            $this->session->set_flashdata('success', 'Data mahasiswa berhasil diperbarui.');
        } else {
            $this->Master_model->insert_mahasiswa($input);
            $this->session->set_flashdata('success', 'Data mahasiswa berhasil ditambahkan.');
        }
        redirect('master_data/mahasiswa');
    }

    public function mahasiswa_delete($id)
    {
        $this->Master_model->delete_mahasiswa($id);
        $this->session->set_flashdata('success', 'Data mahasiswa berhasil dihapus.');
        redirect('master_data/mahasiswa');
    }

    // ========== MATA KULIAH ==========
    public function matakuliah()
    {
        $data = [
            'page_title' => 'Data Mata Kuliah',
            'records'    => $this->Master_model->get_all_matakuliah(),
        ];
        $this->render('master/matakuliah_list', $data);
    }

    public function matakuliah_form($id = null)
    {
        $data = [
            'page_title' => $id ? 'Edit Mata Kuliah' : 'Tambah Mata Kuliah',
            'record'     => $id ? $this->Master_model->get_matakuliah($id) : null,
        ];
        $this->render('master/matakuliah_form', $data);
    }

    public function matakuliah_save($id = null)
    {
        $input = [
            'kode_mk'    => $this->input->post('kode_mk', true),
            'nama_mk'    => $this->input->post('nama_mk', true),
            'sks_teori'  => $this->input->post('sks_teori', true),
            'sks_praktek'=> $this->input->post('sks_praktek', true),
            'semester'   => $this->input->post('semester', true),
            'jenis_mk'   => $this->input->post('jenis_mk', true),
            'prodi_id'   => 1,
        ];

        if ($id) {
            $this->Master_model->update_matakuliah($id, $input);
            $this->session->set_flashdata('success', 'Data mata kuliah berhasil diperbarui.');
        } else {
            $this->Master_model->insert_matakuliah($input);
            $this->session->set_flashdata('success', 'Data mata kuliah berhasil ditambahkan.');
        }
        redirect('master_data/matakuliah');
    }

    public function matakuliah_delete($id)
    {
        $this->Master_model->delete_matakuliah($id);
        $this->session->set_flashdata('success', 'Data mata kuliah berhasil dihapus.');
        redirect('master_data/matakuliah');
    }
}
