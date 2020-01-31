<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
    }


    public function index()
    {
        $data['judul'] = 'Try Out Online';

        $this->load->view('User/templates/header', $data);
        $this->load->view('User/index');
        $this->load->view('User/templates/footer');
    }

    public function tryout()
    {
        $data['judul'] = 'Try Out Online - Pilih Tryout';

        $this->load->view('User/templates/header', $data);
        $this->load->view('User/Tryout');
        $this->load->view('User/templates/footer');
    }

    public function testimoni()
    {
        $data['judul'] = 'Try Out Online - Testimoni';

        $this->load->view('User/templates/header', $data);
        $this->load->view('User/Testimoni');
        $this->load->view('User/templates/footer');
    }

    public function contact()
    {
        $data['judul'] = 'Try Out Online - Contact';

        $this->load->view('User/templates/header', $data);
        $this->load->view('User/Contact');
        $this->load->view('User/templates/footer');
    }
}
