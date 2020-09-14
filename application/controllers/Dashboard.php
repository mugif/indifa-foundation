<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        // echo "bisa login" . $this->session->userdata('noInduk');
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('users', ['noInduk' => $this->session->userdata('noInduk')])->row_array();
        $this->load->view('templates/dashboard_header', $data);
        $this->load->view('templates/dashboard_sidebar');
        $this->load->view('templates/dashboard_topbar', $data);
        $this->load->view('dashboard/index');
        $this->load->view('templates/dashboard_footer');
    }
}
