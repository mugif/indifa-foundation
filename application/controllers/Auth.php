<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index()
    {
        $this->load->view('templates/auth_head');
        $this->load->view('auth/login');
        $this->load->view('templates/auth_foot');
    }

    public function login()
    {
        # code...
    }

}