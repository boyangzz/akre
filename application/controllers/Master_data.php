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
            'sertifikat_pendidik'   => $this->input->post('sertifikat_pendidik', true),
            'sertifikat_kompetensi' => $this->input->post('sertifikat_kompetensi', true),
            'nama_perusahaan'       => $this->input->post('nama_perusahaan', true),
            'bobot_sks_praktisi'    => $this->input->post('bobot_sks_praktisi', true) ?: 0,
            'status_ikatan'         => $this->input->post('status_ikatan', true),
            'status_aktif'          => $this->input->post('status_aktif') ? 1 : 0,
            'prodi_id'              => 1,
        ];
        
        // Cek Duplikasi NIDN
        $this->db->where('nidn', $input['nidn']);
        if ($id) $this->db->where('id !=', $id);
        if ($this->db->get('master_dosen')->num_rows() > 0) {
            $this->session->set_flashdata('error', 'NIDN ' . $input['nidn'] . ' sudah terdaftar dalam sistem.');
            redirect($id ? 'master_data/dosen_form/'.$id : 'master_data/dosen_form');
        }

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

    public function dosen_import()
    {
        $file = $_FILES['csv_file']['tmp_name'];
        if (!$file) {
            $this->session->set_flashdata('error', 'Silakan pilih file CSV.');
            redirect('master_data/dosen');
        }

        $handle = fopen($file, "r");
        $header = fgetcsv($handle, 1000, ","); // Skip header
        
        $success = 0;
        $skipped = 0;

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (count($data) < 2) continue;

            $nidn = trim($data[0]);
            $nama = trim($data[1]);

            // Cek Duplikasi
            $exists = $this->db->where('nidn', $nidn)->get('master_dosen')->num_rows();
            if ($exists > 0) {
                $skipped++;
                continue;
            }

            $input = [
                'nidn'             => $nidn,
                'nama'             => $nama,
                'pendidikan_pasca' => $data[2] ?? 'S2',
                'jabatan_akademik' => $data[3] ?? 'Asisten Ahli',
                'status_ikatan'    => $data[4] ?? 'tetap',
                'prodi_id'         => 1,
            ];

            $this->Master_model->insert_dosen($input);
            $success++;
        }
        fclose($handle);

        $msg = "Impor selesai. Sukses: $success, Dilewati (Sudah ada): $skipped.";
        $this->session->set_flashdata($success > 0 ? 'success' : 'warning', $msg);
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

        // Cek Duplikasi NIM
        $this->db->where('nim', $input['nim']);
        if ($id) $this->db->where('id !=', $id);
        if ($this->db->get('master_mahasiswa')->num_rows() > 0) {
            $this->session->set_flashdata('error', 'NIM ' . $input['nim'] . ' sudah terdaftar dalam sistem.');
            redirect($id ? 'master_data/mahasiswa_form/'.$id : 'master_data/mahasiswa_form');
        }

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

    public function mahasiswa_import()
    {
        $file = $_FILES['csv_file']['tmp_name'];
        if (!$file) {
            $this->session->set_flashdata('error', 'Silakan pilih file CSV.');
            redirect('master_data/mahasiswa');
        }

        $handle = fopen($file, "r");
        $header = fgetcsv($handle, 1000, ","); // Skip header
        
        $success = 0;
        $skipped = 0;

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (count($data) < 3) continue;

            $nim = trim($data[0]);
            $nama = trim($data[1]);
            $angkatan = trim($data[2]);

            // Cek Duplikasi NIM
            $exists = $this->db->where('nim', $nim)->get('master_mahasiswa')->num_rows();
            if ($exists > 0) {
                $skipped++;
                continue;
            }

            $input = [
                'nim'      => $nim,
                'nama'     => $nama,
                'angkatan' => $angkatan,
                'status'   => $data[3] ?? 'aktif',
                'jenis'    => $data[4] ?? 'reguler',
                'prodi_id' => 1,
            ];

            $this->Master_model->insert_mahasiswa($input);
            $success++;
        }
        fclose($handle);

        $msg = "Impor mahasiswa selesai. Sukses: $success, Dilewati (NIM Ganda): $skipped.";
        $this->session->set_flashdata($success > 0 ? 'success' : 'warning', $msg);
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
            'kode_mk'           => $this->input->post('kode_mk', true),
            'nama_mk'           => $this->input->post('nama_mk', true),
            'semester'          => $this->input->post('semester', true),
            'is_kompetensi'     => $this->input->post('is_kompetensi') ? 1 : 0,
            'sks_kuliah'        => $this->input->post('sks_kuliah', true) ?: 0,
            'sks_seminar'       => $this->input->post('sks_seminar', true) ?: 0,
            'sks_praktikum'     => $this->input->post('sks_praktikum', true) ?: 0,
            'konversi_jam'      => $this->input->post('konversi_jam', true) ?: 0,
            'cpl_sikap'         => $this->input->post('cpl_sikap') ? 1 : 0,
            'cpl_pengetahuan'   => $this->input->post('cpl_pengetahuan') ? 1 : 0,
            'cpl_ku'            => $this->input->post('cpl_ku') ? 1 : 0,
            'cpl_kk'            => $this->input->post('cpl_kk') ? 1 : 0,
            'rps_link'          => $this->input->post('rps_link', true),
            'unit_penyelenggara'=> $this->input->post('unit_penyelenggara', true),
            'prodi_id'          => 1,
        ];

        // Cek Duplikasi Kode MK
        $this->db->where('kode_mk', $input['kode_mk']);
        if ($id) $this->db->where('id !=', $id);
        if ($this->db->get('master_mata_kuliah')->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Kode MK ' . $input['kode_mk'] . ' sudah terdaftar dalam sistem.');
            redirect($id ? 'master_data/matakuliah_form/'.$id : 'master_data/matakuliah_form');
        }

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
