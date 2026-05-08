<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller — Base Controller with Auth Guard (Layer 2: Backend)
 * Semua controller yang membutuhkan login harus extend class ini.
 */
#[AllowDynamicProperties]
class MY_Controller extends CI_Controller
{
    protected $current_user = null;
    protected $current_jenjang = null;
    public $Borang_setup_model;
    public $Dashboard_model;
    public $Master_model;
    public $Kerjasama_model;
    public $Kemahasiswaan_model;
    public $Sumber_daya_model;
    public $Luaran_model;

    public function __construct()
    {
        parent::__construct();

        // Cek session login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        // Load user data untuk navbar/layout
        $this->current_user = [
            'id'            => $this->session->userdata('user_id'),
            'username'      => $this->session->userdata('username'),
            'nama_lengkap'  => $this->session->userdata('nama_lengkap'),
            'role'          => $this->session->userdata('role'),
        ];

        // Load jenjang prodi aktif dari identitas
        $this->load->model('Borang_setup_model');
        $identitas = $this->db->get('identitas_pengusul')->row();
        $this->current_jenjang = $identitas ? $identitas->jenjang : null;

        // Build dynamic menu berdasarkan jenjang (Layer 2)
        $menu_items = $this->Borang_setup_model->get_menu_by_jenjang($this->current_jenjang);

        // Pass data ke semua views
        $this->load->vars([
            'current_user'    => $this->current_user,
            'current_jenjang' => $this->current_jenjang,
            'menu_items'      => $menu_items,
            'identitas'       => $identitas, // Injeksi identitas global
        ]);
    }

    /**
     * Guard: cek apakah tabel borang berlaku untuk jenjang aktif
     */
    protected function guard_jenjang($kode_tabel)
    {
        if (!$this->Borang_setup_model->is_allowed($kode_tabel, $this->current_jenjang)) {
            show_error('Tabel ' . $kode_tabel . ' tidak berlaku untuk jenjang ' . $this->current_jenjang, 403, 'Akses Ditolak');
        }
    }

    /**
     * Render view dengan layout (header + content + footer)
     */
    protected function render($view, $data = [])
    {
        $this->load->view('layout/header', $data);
        $this->load->view($view, $data);
        $this->load->view('layout/footer', $data);
    }
}

/**
 * Public_Controller — Untuk halaman tanpa auth (login)
 */
#[AllowDynamicProperties]
class Public_Controller extends CI_Controller
{
    public $Auth_model;

    public function __construct()
    {
        parent::__construct();
        $identitas = $this->db->get('identitas_pengusul')->row();
        $this->load->vars(['identitas' => $identitas]);
    }
}
