<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'Try Out Online';

        $this->load->view('User/templates/header', $data);
        $this->load->view('User/index');
        $this->load->view('User/templates/footer');
    }
}
