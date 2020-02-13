<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('Admin/templates/header_admin', $data);
        $this->load->view('Admin/index');
        $this->load->view('Admin/templates/footer_admin');
    }

    public function daftar_modul()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Modul';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Admin/templates/header_admin', $data);
        $this->load->view('Admin/modul/daftar_modul');
        $this->load->view('Admin/templates/footer_admin');
    }

    public function tambah_modul()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tambah Modul';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Admin/templates/header_admin', $data);
        $this->load->view('Admin/modul/tambah_modul');
        $this->load->view('Admin/templates/footer_admin');
    }

    public function daftar_event()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Event';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Admin/templates/header_admin', $data);
        $this->load->view('Admin/event/daftar_event');
        $this->load->view('Admin/templates/footer_admin');
    }

    public function daftar_soal()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Soal';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Admin/templates/header_admin', $data);
        $this->load->view('Admin/event/daftar_soal');
        $this->load->view('Admin/templates/footer_admin');
    }
    public function tambah_event()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tambah Event';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Admin/templates/header_admin', $data);
        $this->load->view('Admin/event/tambah_event');
        $this->load->view('Admin/templates/footer_admin');
    }
    public function tambah_soal()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tambah Soal';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Admin/templates/header_admin', $data);
        $this->load->view('Admin/event/tambah_soal');
        $this->load->view('Admin/templates/footer_admin');
    }
    public function daftar_peserta()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Peserta';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Admin/templates/header_admin', $data);
        $this->load->view('Admin/peserta/daftar_peserta');
        $this->load->view('Admin/templates/footer_admin');
    }
}
