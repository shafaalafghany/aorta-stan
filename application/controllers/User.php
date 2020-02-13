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
        $data['judul'] = 'AORTASTAN Try Out Online';

        $this->load->view('User/templates/header_home', $data);
        $this->load->view('User/index');
        $this->load->view('User/templates/footer');
    }

    public function tryout()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Pilih Tryout';

        $this->load->view('User/templates/header_tryout', $data);
        $this->load->view('User/Tryout');
        $this->load->view('User/templates/footer');
    }

    public function testimoni()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Testimoni';

        $this->load->view('User/templates/header_testimoni', $data);
        $this->load->view('User/Testimoni');
        $this->load->view('User/templates/footer');
    }

    public function contact()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Contact';

        $this->load->view('User/templates/header_contact', $data);
        $this->load->view('User/Contact');
        $this->load->view('User/templates/footer');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'AORTASTAN Try Out Online | Login';

            $this->load->view('User/login', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        //cek inputan
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
            //jika user active
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    //cek role_id
                    if ($user['role_id'] == 1) {
                        redirect('Super_Admin');
                    } elseif ($user['role_id'] == 2) {
                        redirect('Admin');
                    } else {
                        redirect('Member');
                    }
                } else {
                    redirect('User/login');
                }
            } else {
                redirect('User/login');
            }
        } else {
            redirect('User/login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        redirect('User');
    }

    public function registration()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username has already registered'

        ]);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Password dont match !',
            'min_length' => 'Password too short'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'AORTASTAN Try Out Online | Register';
            $this->load->view('User/registration', $data);
        } else {
            $datauser = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $datauser);
            redirect('User/login');
        }
    }

    public function forgot_password()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Forgot Password';

        $this->load->view('User/forgot_password', $data);
    }

    public function change()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Change Password';

        $this->load->view('User/change_password', $data);
    }
}
