<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Auth extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    /**
     * Halaman login (GET) / Proses login (POST)
     */
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }

        if ($this->input->method() === 'post') {
            $username = $this->input->post('username', true);
            $password = $this->input->post('password');

            $user = $this->Auth_model->authenticate($username, $password);

            if ($user) {
                $this->session->set_userdata([
                    'user_id'       => $user->id,
                    'username'      => $user->username,
                    'nama_lengkap'  => $user->nama_lengkap,
                    'role'          => $user->role,
                    'logged_in'     => true,
                ]);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah.');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/login');
    }

    /**
     * Logout — destroy session
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
