<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {

        if ($this->session->userdata('noInduk')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_head');
            $this->load->view('auth/login');
            $this->load->view('templates/auth_foot');
        } else {
            $this->_login();
        }
    }

    public function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('users', ['noInduk' => $username])->row_array();
        if ($user != null) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'noInduk' => $user['noInduk']
                ];
                $this->session->set_userdata($data);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong username or password</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong username or password</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('noInduk');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out</div>');
        redirect('auth');
    }
}
