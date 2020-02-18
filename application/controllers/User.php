<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Event_model');
    }


    public function index()
    {

        $data['judul'] = 'AORTASTAN Try Out Online';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['event'] = $this->Event_model->getAllEvent();

        $this->load->view('User/templates/header_home', $data);
        $this->load->view('User/index', $data);
        $this->load->view('User/templates/footer');
    }

    public function tryout()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tryout';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['event'] = $this->Event_model->getAllEvent();

        $this->load->view('User/templates/header_tryout', $data);
        $this->load->view('User/tryout', $data);
        $this->load->view('User/templates/footer');
    }

    public function event($id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Event Detail';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['topik'] = $this->db->get('topik')->result_array();

        $this->load->view('User/templates/header_tryout', $data);
        $this->load->view('User/event_detail', $data);
        $this->load->view('User/templates/footer');
    }

    public function tes_tpa($id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tes TPA';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['topik'] = $this->db->get_where('topik', ['id_topik' => 1])->row_array();
        $data['topik_rule'] = $this->db->query("SELECT * from topik_rule tr left join topik t on tr.id_topik = t.id_topik")->row_array();

        $harga = $this->db->select('harga')->get_where('event', ['id_event' => $id_event])->row()->harga;
        $point = $this->db->select('point')->get_where('user', ['username' => $this->session->userdata('username')])->row()->point;
        $username = $this->session->userdata('username');

        if ($point < $harga) {
            log_message('error', 'Point anda tidak cukup.');
            redirect('User/tryout');
        }
        else{
            $bayar = $point - $harga;

            $this->db->set('point', $bayar);
            $this->db->where('username', $username);
            $this->db->update('user');

            $this->load->view('User/templates/header_tryout', $data);
            $this->load->view('User/tes_tpa', $data);
            $this->load->view('User/templates/footer');
        }
    }

    public function kerjakan_tpa($id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tes TPA';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['topik'] = $this->db->get_where('topik', ['id_topik' => 1])->row_array();
        $data['topik_rule'] = $this->db->query("SELECT * from topik_rule tr left join topik t on tr.id_topik = t.id_topik")->row_array();

        $this->load->view('User/templates/header_tryout', $data);
        $this->load->view('User/tes/kerjakan_tpa', $data);
        $this->load->view('User/templates/footer');
    }

    public function testimoni()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Testimoni';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('User/templates/header_testimoni', $data);
        $this->load->view('User/testimoni');
        $this->load->view('User/templates/footer');
    }

    public function contact()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Contact';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('User/templates/header_contact', $data);
        $this->load->view('User/contact');
        $this->load->view('User/templates/footer');
    }

    public function profile_saya()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Profile Saya';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('User/templates/header_profile', $data);
            $this->load->view('User/profile_saya', $data);
            $this->load->view('User/templates/footer');
        } else {
            $name = $this->input->post('name');
            $username = $this->input->post('username');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 2048;
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
            }

            $this->db->set('name', $name);
            $this->db->where('username', $username);
            $this->db->update('user');
            redirect('User');
        }
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
                    if ($user['role_id'] < 3) {
                        redirect('Administrator');
                    } else {
                        redirect('User');
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
                'tentang' => 'Aku adalah seorang pejuang !',
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
