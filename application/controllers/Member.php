<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'AORTASTAN Try Out Online';
        $datauser['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // echo 'Selamat datang ' . $datauser['user']['name'];

        $this->load->view('User/templates/header_login', $data);
        $this->load->view('User/index');
        $this->load->view('User/templates/footer');
    }
}
