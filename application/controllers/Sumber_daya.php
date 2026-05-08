<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sumber_daya extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sumber_daya_model');
    }

    public function ewmp()
    {
        $this->guard_jenjang('3a3');
        $data = [
            'page_title' => 'Ekuivalen Waktu Mengajar Penuh (EWMP)',
            'records'    => $this->db->select('t.*, d.nama as nama_dosen')
                                     ->from('trx_ewmp t')
                                     ->join('master_dosen d', 'd.id = t.dosen_id')
                                     ->get()->result(),
        ];
        $this->render('sumber_daya/ewmp_list', $data);
    }

    public function ewmp_form($id = null)
    {
        $this->guard_jenjang('3a3');
        $data = [
            'page_title' => ($id ? 'Edit' : 'Tambah') . ' Data EWMP',
            'record'     => $id ? $this->Sumber_daya_model->get_by_id('trx_ewmp', $id) : null,
            'list_dosen' => $this->db->get('master_dosen')->result(),
        ];
        $this->render('sumber_daya/ewmp_form', $data);
    }

    public function ewmp_save($id = null)
    {
        $this->guard_jenjang('3a3');
        $data = $this->input->post(null, true);
        $data['prodi_id'] = 1;

        if ($id) {
            $this->Sumber_daya_model->save('trx_ewmp', $id, $data);
            $this->session->set_flashdata('success', 'Data EWMP berhasil diperbarui.');
        } else {
            $this->Sumber_daya_model->save('trx_ewmp', null, $data);
            $this->session->set_flashdata('success', 'Data EWMP berhasil ditambahkan.');
        }
        redirect('sumber_daya/ewmp');
    }

    public function ewmp_delete($id)
    {
        $this->guard_jenjang('3a3');
        $this->Sumber_daya_model->delete('trx_ewmp', $id);
        $this->session->set_flashdata('success', 'Data EWMP berhasil dihapus.');
        redirect('sumber_daya/ewmp');
    }

    public function rekognisi()
    {
        $this->guard_jenjang('3b1');
        $data = [
            'page_title' => 'Rekognisi / Pengakuan DTPS (3.b.1)',
            'records'    => $this->db->select('t.*, d.nama as nama_dosen')
                                     ->from('trx_rekognisi_dosen t')
                                     ->join('master_dosen d', 'd.id = t.dosen_id')
                                     ->get()->result(),
        ];
        $this->render('sumber_daya/rekognisi_list', $data);
    }

    public function rekognisi_form($id = null)
    {
        $this->guard_jenjang('3b1');
        $data = [
            'page_title' => ($id ? 'Edit' : 'Tambah') . ' Data Rekognisi',
            'record'     => $id ? $this->Sumber_daya_model->get_by_id('trx_rekognisi_dosen', $id) : null,
            'list_dosen' => $this->db->get('master_dosen')->result(),
        ];
        $this->render('sumber_daya/rekognisi_form', $data);
    }

    public function rekognisi_save($id = null)
    {
        $this->guard_jenjang('3b1');
        $data = $this->input->post(null, true);
        $data['prodi_id'] = 1;

        if ($id) {
            $this->Sumber_daya_model->save('trx_rekognisi_dosen', $id, $data);
        } else {
            $this->Sumber_daya_model->save('trx_rekognisi_dosen', null, $data);
        }
        $this->session->set_flashdata('success', 'Data rekognisi berhasil disimpan.');
        redirect('sumber_daya/rekognisi');
    }

    public function rekognisi_delete($id)
    {
        $this->guard_jenjang('3b1');
        $this->Sumber_daya_model->delete('trx_rekognisi_dosen', $id);
        $this->session->set_flashdata('success', 'Data rekognisi berhasil dihapus.');
        redirect('sumber_daya/rekognisi');
    }

    public function penelitian()
    {
        $this->guard_jenjang('3b2');
        $data = [
            'page_title' => 'Penelitian DTPS (3.b.2)',
            'records'    => $this->Sumber_daya_model->get_data('trx_penelitian_dtps'),
        ];
        $this->render('sumber_daya/penelitian_list', $data);
    }

    public function penelitian_save()
    {
        $this->guard_jenjang('3b2');
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Sumber_daya_model->save('trx_penelitian_dtps', $id, $data);
        $this->session->set_flashdata('success', 'Data penelitian berhasil disimpan.');
        redirect('sumber_daya/penelitian');
    }

    public function pkm()
    {
        $this->guard_jenjang('3b3');
        $data = [
            'page_title' => 'PkM DTPS (3.b.3)',
            'records'    => $this->Sumber_daya_model->get_data('trx_pkm_dtps'),
        ];
        $this->render('sumber_daya/pkm_list', $data);
    }

    public function pkm_save()
    {
        $this->guard_jenjang('3b3');
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Sumber_daya_model->save('trx_pkm_dtps', $id, $data);
        $this->session->set_flashdata('success', 'Data PkM berhasil disimpan.');
        redirect('sumber_daya/pkm');
    }

    public function publikasi()
    {
        $this->guard_jenjang('3b4');
        $data = [
            'page_title' => 'Publikasi Ilmiah DTPS (3.b.4)',
            'records'    => $this->Sumber_daya_model->get_data('trx_publikasi_dtps'),
        ];
        $this->render('sumber_daya/publikasi_list', $data);
    }

    public function publikasi_save()
    {
        $this->guard_jenjang('3b4');
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Sumber_daya_model->save('trx_publikasi_dtps', $id, $data);
        $this->session->set_flashdata('success', 'Data publikasi berhasil disimpan.');
        redirect('sumber_daya/publikasi');
    }

    public function hki()
    {
        $this->guard_jenjang('3b5');
        $data = [
            'page_title' => 'HKI & Buku DTPS (3.b.5)',
            'records'    => $this->db->select('t.*, d.nama as nama_dosen')
                                     ->from('trx_hki_buku_dtps t')
                                     ->join('master_dosen d', 'd.id = t.dosen_id')
                                     ->get()->result(),
            'list_dosen' => $this->db->get('master_dosen')->result(),
        ];
        $this->render('sumber_daya/hki_list', $data);
    }

    public function hki_save()
    {
        $this->guard_jenjang('3b5');
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Sumber_daya_model->save('trx_hki_buku_dtps', $id, $data);
        $this->session->set_flashdata('success', 'Data HKI/Buku berhasil disimpan.');
        redirect('sumber_daya/hki');
    }

    public function sitasi()
    {
        $this->guard_jenjang('3b6');
        $data = [
            'page_title' => 'Sitasi DTPS (3.b.6)',
            'records'    => $this->db->select('t.*, d.nama as nama_dosen')
                                     ->from('trx_sitasi_dtps t')
                                     ->join('master_dosen d', 'd.id = t.dosen_id')
                                     ->get()->result(),
            'list_dosen' => $this->db->get('master_dosen')->result(),
        ];
        $this->render('sumber_daya/sitasi_list', $data);
    }

    public function sitasi_save()
    {
        $this->guard_jenjang('3b5');
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Sumber_daya_model->save('trx_sitasi_dtps', $id, $data);
        $this->session->set_flashdata('success', 'Data sitasi berhasil disimpan.');
        redirect('sumber_daya/sitasi');
    }

    public function produk_jasa()
    {
        $this->guard_jenjang('3b6');
        $data = [
            'page_title' => 'Produk/Jasa DTPS yang Diadopsi (3.b.6)',
            'records'    => $this->db->select('t.*, d.nama as nama_dosen')
                                     ->from('trx_produk_jasa_dtps t')
                                     ->join('master_dosen d', 'd.id = t.dosen_id')
                                     ->get()->result(),
            'list_dosen' => $this->db->get('master_dosen')->result(),
        ];
        $this->render('sumber_daya/produk_jasa_list', $data);
    }

    public function produk_jasa_save()
    {
        $this->guard_jenjang('3b6');
        $data = $this->input->post(null, true);
        $id = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Sumber_daya_model->save('trx_produk_jasa_dtps', $id, $data);
        $this->session->set_flashdata('success', 'Data produk/jasa berhasil disimpan.');
        redirect('sumber_daya/produk_jasa');
    }

    // ========== Dosen Tetap — redirect ke master_data ==========

    public function dosen_tetap()
    {
        $this->guard_jenjang('3a1');
        redirect('master_data/dosen');
    }

    // ========== Pembimbing TA (3.a.2) ==========

    public function pembimbing_ta()
    {
        $this->guard_jenjang('3a2');
        $data = [
            'page_title' => 'Pembimbing Utama TA (3.a.2)',
            'records'    => $this->db->select('t.*, d.nama as nama_dosen')
                                     ->from('trx_dosen_bimbingan t')
                                     ->join('master_dosen d', 'd.id = t.dosen_id')
                                     ->order_by('t.tahun_akademik', 'DESC')
                                     ->get()->result(),
            'list_dosen' => $this->db->get('master_dosen')->result(),
        ];
        $this->render('sumber_daya/pembimbing_list', $data);
    }

    public function pembimbing_save()
    {
        $this->guard_jenjang('3a2');
        $data = $this->input->post(null, true);
        $id   = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Sumber_daya_model->save('trx_dosen_bimbingan', $id, $data);
        $this->session->set_flashdata('success', 'Data bimbingan multi-tahun berhasil disimpan.');
        redirect('sumber_daya/pembimbing_ta');
    }

    // ========== Dosen Tidak Tetap (3.a.4) — status_ikatan: tidak_tetap ==========

    public function dosen_tidak_tetap()
    {
        $this->guard_jenjang('3a4');
        $data = [
            'page_title' => 'Dosen Tidak Tetap (3.a.4)',
            'jenis'      => 'tidak_tetap',
            'records'    => $this->db->where('status_ikatan', 'tidak_tetap')
                                     ->where('prodi_id', 1)
                                     ->order_by('nama', 'ASC')
                                     ->get('master_dosen')->result(),
        ];
        $this->render('sumber_daya/dosen_filtered_list', $data);
    }

    // ========== Dosen Industri/Praktisi (3.a.5) — status_ikatan: industri ==========

    public function dosen_industri()
    {
        $this->guard_jenjang('3a5');
        $data = [
            'page_title' => 'Dosen Industri/Praktisi (3.a.5)',
            'jenis'      => 'industri',
            'records'    => $this->db->where('status_ikatan', 'industri')
                                     ->where('prodi_id', 1)
                                     ->order_by('nama', 'ASC')
                                     ->get('master_dosen')->result(),
        ];
        $this->render('sumber_daya/dosen_filtered_list', $data);
    }

    // ========== Luaran Lain DTPS (3.b.7) ==========

    public function luaran_lain()
    {
        $this->guard_jenjang('3b7');
        $data = [
            'page_title' => 'Luaran Lain DTPS (3.b.7)',
            'records'    => $this->db->select('t.*, d.nama as nama_dosen')
                                     ->from('trx_luaran_mhs t')
                                     ->join('master_mahasiswa d', 'd.id = t.mahasiswa_id', 'left')
                                     ->order_by('t.tahun', 'DESC')
                                     ->get()->result(),
            'list_mhs'   => $this->db->get('master_mahasiswa')->result(),
        ];
        $this->render('sumber_daya/luaran_lain_list', $data);
    }

    public function luaran_lain_save()
    {
        $this->guard_jenjang('3b7');
        $data = $this->input->post(null, true);
        $id   = $this->input->post('id');
        $data['prodi_id'] = 1;
        $this->Sumber_daya_model->save('trx_luaran_mhs', $id, $data);
        $this->session->set_flashdata('success', 'Data luaran berhasil disimpan.');
        redirect('sumber_daya/3b7');
    }

    public function __call($name, $arguments)
    {
        // Map kode_tabel (URL segment) to specific methods if they exist
        $map = [
            '3a3' => 'ewmp',
            '3b1' => 'rekognisi',
            '3b2' => 'penelitian',
            '3b3' => 'pkm',
            '3b4' => 'publikasi',
            '3b5' => 'sitasi',
            '3b6' => 'produk_jasa',
            '3b7' => 'hki',
        ];

        if (isset($map[$name])) {
            return call_user_func_array([$this, $map[$name]], $arguments);
        }

        $kode = str_replace('_', '.', $name);
        $data = [
            'page_title' => 'Data ' . strtoupper($kode),
            'records'    => [],
        ];
        $this->render('sumber_daya/generic', $data);
    }
}
