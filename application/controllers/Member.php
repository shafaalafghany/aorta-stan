<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'AORTASTAN Try Out Online';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('User/templates/header_login', $data);
        $this->load->view('User/index');
        $this->load->view('User/templates/footer');
    }

    public function tryout_member()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tryout';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('User/templates/header_login', $data);
        $this->load->view('User/tryout');
        $this->load->view('User/templates/footer');
    }

    public function testimoni_member()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Testimoni';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('User/templates/header_login', $data);
        $this->load->view('User/testimoni');
        $this->load->view('User/templates/footer');
    }
    public function contact_member()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Contact';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('User/templates/header_login', $data);
        $this->load->view('User/contact');
        $this->load->view('User/templates/footer');
    }
}
