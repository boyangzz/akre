<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $data = [
            'page_title'  => 'Dashboard',
            'stats'       => $this->Dashboard_model->get_stats(),
        ];
        $this->render('dashboard/index', $data);
    }
}
