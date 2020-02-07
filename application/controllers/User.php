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
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[to_user.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Try Out Online';

            $this->load->view('User/templates/header', $data);
            $this->load->view('User/index');
            $this->load->view('User/templates/footer');
        } else {

            $data_user = [
                'user_name' => $this->input->post('name'),
                'user_email' => $this->input->post('user_email'),
                'user_password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3,
                'images' => 'default.jpg',
                'is_active' => 1,
                'date_created' => time()
            ];

            // $this->db->insert('to_user', $data_user);
            // redirect('User');
            echo 'berhasil!';

            // $data['judul'] = 'Try Out Online';

            // $this->load->view('User/templates/header_login', $data);
            // $this->load->view('User/index');
            // $this->load->view('User/templates/footer');
        }
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
