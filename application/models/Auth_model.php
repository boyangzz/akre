<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    /**
     * Authenticate user by username + password (bcrypt)
     */
    public function authenticate($username, $password)
    {
        $user = $this->db->where('username', $username)
                         ->get('admin_users')
                         ->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }

    /**
     * Get user by ID
     */
    public function get_user_by_id($id)
    {
        return $this->db->where('id', $id)
                        ->get('admin_users')
                        ->row();
    }
}
