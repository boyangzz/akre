<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Luaran extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Luaran_model');
    }

    public function ipk_lulusan()
    {
        $this->guard_jenjang('8a');
        $data = [
            'page_title' => 'IPK Lulusan (8.a)',
            'records'    => $this->Luaran_model->get_data('trx_ipk_lulusan'),
        ];
        $this->render('luaran/ipk_list', $data);
    }

    public function ipk_save()
    {
        $this->guard_jenjang('8a');
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Luaran_model->save('trx_ipk_lulusan', $id, $data);
        $this->session->set_flashdata('success', 'Data IPK lulusan berhasil disimpan.');
        redirect('luaran/ipk_lulusan');
    }

    public function masa_studi()
    {
        $this->guard_jenjang('8c');
        $data = [
            'page_title' => 'Masa Studi Lulusan (8.c)',
            'records'    => $this->Luaran_model->get_data('trx_masa_studi'),
        ];
        $this->render('luaran/masa_studi_list', $data);
    }

    public function masa_studi_save()
    {
        $this->guard_jenjang('8c');
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Luaran_model->save('trx_masa_studi', $id, $data);
        $this->session->set_flashdata('success', 'Data masa studi berhasil disimpan.');
        redirect('luaran/masa_studi');
    }

    public function waktu_tunggu()
    {
        $this->guard_jenjang('8d1');
        $data = [
            'page_title' => 'Waktu Tunggu Lulusan (8.d.1)',
            'records'    => $this->Luaran_model->get_data('trx_waktu_tunggu'),
        ];
        $this->render('luaran/waktu_tunggu_list', $data);
    }

    public function waktu_tunggu_save()
    {
        $this->guard_jenjang('8d1');
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Luaran_model->save('trx_waktu_tunggu', $id, $data);
        $this->session->set_flashdata('success', 'Data waktu tunggu berhasil disimpan.');
        redirect('luaran/waktu_tunggu');
    }

    public function kepuasan_pengguna()
    {
        $this->guard_jenjang('8e2');
        $data = [
            'page_title' => 'Kepuasan Pengguna Lulusan (8.e.2)',
            'records'    => $this->Luaran_model->get_data('trx_kepuasan_pengguna'),
        ];
        $this->render('luaran/kepuasan_list', $data);
    }

    public function kepuasan_save()
    {
        $this->guard_jenjang('8e2');
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Luaran_model->save('trx_kepuasan_pengguna', $id, $data);
        $this->session->set_flashdata('success', 'Data kepuasan pengguna berhasil disimpan.');
        redirect('luaran/kepuasan_pengguna');
    }

    public function prestasi_akademik()
    {
        $this->guard_jenjang('8b1');
        $data = [
            'page_title'   => 'Prestasi Akademik Mahasiswa (8.b.1)',
            'jenis'        => 'akademik',
            'records'      => $this->db->where('jenis_prestasi', 'akademik')
                                       ->where('prodi_id', 1)
                                       ->order_by('tahun', 'DESC')
                                       ->get('trx_prestasi_mhs')->result(),
            'list_mhs'     => $this->db->get('master_mahasiswa')->result(),
        ];
        $this->render('luaran/prestasi_list', $data);
    }

    public function prestasi_nonakademik()
    {
        $this->guard_jenjang('8b2');
        $data = [
            'page_title'   => 'Prestasi Non-Akademik Mahasiswa (8.b.2)',
            'jenis'        => 'non_akademik',
            'records'      => $this->db->where('jenis_prestasi', 'non_akademik')
                                       ->where('prodi_id', 1)
                                       ->order_by('tahun', 'DESC')
                                       ->get('trx_prestasi_mhs')->result(),
            'list_mhs'     => $this->db->get('master_mahasiswa')->result(),
        ];
        $this->render('luaran/prestasi_list', $data);
    }

    public function prestasi_save()
    {
        $jenis = $this->input->post('jenis_prestasi') == 'akademik' ? '8b1' : '8b2';
        $this->guard_jenjang($jenis);
        $data = $this->input->post(null, true);
        $id   = $this->input->post('id');
        $data['prodi_id'] = 1;
        if ($id) {
            $this->db->where('id', $id)->update('trx_prestasi_mhs', $data);
        } else {
            $this->db->insert('trx_prestasi_mhs', $data);
        }
        $this->session->set_flashdata('success', 'Data prestasi berhasil disimpan.');
        $redirect = $data['jenis_prestasi'] == 'akademik' ? 'luaran/8b1' : 'luaran/8b2';
        redirect($redirect);
    }

    public function kesesuaian_bidang()
    {
        $this->guard_jenjang('8d2');
        $data = [
            'page_title' => 'Kesesuaian Bidang Kerja Lulusan (8.d.2)',
            'records'    => $this->db->where('prodi_id', 1)
                                     ->order_by('tahun_lulus', 'DESC')
                                     ->get('trx_tempat_kerja')->result(),
        ];
        $this->render('luaran/tempat_kerja_list', $data);
    }

    public function tempat_kerja()
    {
        $this->guard_jenjang('8e1');
        $data = [
            'page_title' => 'Tempat Kerja Lulusan (8.e.1)',
            'records'    => $this->db->where('prodi_id', 1)
                                     ->order_by('tahun_lulus', 'DESC')
                                     ->get('trx_tempat_kerja')->result(),
        ];
        $this->render('luaran/tempat_kerja_list', $data);
    }

    public function tempat_kerja_save()
    {
        $kode = $this->input->post('kode_asal') == '8d2' ? '8d2' : '8e1';
        $this->guard_jenjang($kode);
        $data = $this->input->post(null, true);
        $id   = $this->input->post('id');
        $data['prodi_id'] = 1;
        unset($data['kode_asal']);
        if ($id) {
            $this->db->where('id', $id)->update('trx_tempat_kerja', $data);
        } else {
            $this->db->insert('trx_tempat_kerja', $data);
        }
        $this->session->set_flashdata('success', 'Data berhasil disimpan.');
        redirect('luaran/' . $kode);
    }

    public function publikasi_mahasiswa()
    {
        $this->guard_jenjang('8f1');
        $data = [
            'page_title' => 'Publikasi Ilmiah Mahasiswa (8.f.1)',
            'records'    => $this->db->where('jenis', 'Publikasi')
                                     ->where('prodi_id', 1)
                                     ->order_by('tahun', 'DESC')
                                     ->get('trx_luaran_mhs')->result(),
            'list_mhs'   => $this->db->get('master_mahasiswa')->result(),
        ];
        $this->render('luaran/luaran_mhs_list', $data);
    }

    public function sitasi_mahasiswa()
    {
        $this->guard_jenjang('8f2');
        $data = [
            'page_title' => 'Karya Ilmiah Mahasiswa yang Disitasi (8.f.2)',
            'records'    => $this->db->where('jenis', 'Sitasi')
                                     ->where('prodi_id', 1)
                                     ->order_by('tahun', 'DESC')
                                     ->get('trx_luaran_mhs')->result(),
            'list_mhs'   => $this->db->get('master_mahasiswa')->result(),
        ];
        $this->render('luaran/luaran_mhs_list', $data);
    }

    public function produk_mahasiswa()
    {
        $this->guard_jenjang('8f3');
        $data = [
            'page_title' => 'Produk/Jasa Mahasiswa yang Diadopsi (8.f.3)',
            'records'    => $this->db->where('jenis', 'Produk')
                                     ->where('prodi_id', 1)
                                     ->order_by('tahun', 'DESC')
                                     ->get('trx_luaran_mhs')->result(),
            'list_mhs'   => $this->db->get('master_mahasiswa')->result(),
        ];
        $this->render('luaran/luaran_mhs_list', $data);
    }

    public function hki_mahasiswa()
    {
        $this->guard_jenjang('8f4');
        $data = [
            'page_title' => 'Luaran Penelitian Mahasiswa - HKI (8.f.4)',
            'records'    => $this->db->where('jenis', 'HKI')
                                     ->where('prodi_id', 1)
                                     ->order_by('tahun', 'DESC')
                                     ->get('trx_luaran_mhs')->result(),
            'list_mhs'   => $this->db->get('master_mahasiswa')->result(),
        ];
        $this->render('luaran/luaran_mhs_list', $data);
    }

    public function luaran_mhs_save()
    {
        $kode = $this->input->post('kode_asal', true);
        $this->guard_jenjang($kode ?: '8f1');
        $data = $this->input->post(null, true);
        $id   = $this->input->post('id');
        $data['prodi_id'] = 1;
        unset($data['kode_asal']);
        if ($id) {
            $this->db->where('id', $id)->update('trx_luaran_mhs', $data);
        } else {
            $this->db->insert('trx_luaran_mhs', $data);
        }
        $this->session->set_flashdata('success', 'Data luaran mahasiswa berhasil disimpan.');
        redirect('luaran/' . ($kode ?: '8f1'));
    }

    public function __call($name, $arguments)
    {
        // Map kode_tabel (URL segment) to specific methods if they exist
        $map = [
            '8a'  => 'ipk_lulusan',
            '8c'  => 'masa_studi',
            '8d1' => 'waktu_tunggu',
            '8e2' => 'kepuasan_pengguna',
        ];

        if (isset($map[$name])) {
            return call_user_func_array([$this, $map[$name]], $arguments);
        }

        $kode = str_replace('_', '.', $name);
        $data = [
            'page_title' => 'Data ' . strtoupper($kode),
            'records'    => [],
        ];
        $this->render('luaran/generic', $data);
    }
}
