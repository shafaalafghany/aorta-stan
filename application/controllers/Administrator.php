<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Event_model');
    }
    
    public function index()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/index');
        $this->load->view('Super_Admin/templates/footer_admin');
    }

    public function daftar_modul()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Modul';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/modul/daftar_modul');
    }

    public function tambah_modul()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tambah Modul';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/modul/tambah_modul');
    }

    public function daftar_event()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Event';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['event'] = $this->db->get('event')->result_array();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/daftar_event', $data);
    }

    public function daftar_soal()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Soal';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/daftar_soal');
    }

    public function tambah_event()
    {
        $this->load->library('form_validation');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['event'] = $this->db->get('event')->result_array();

        $this->form_validation->set_rules('inputNama', 'InputNama', 'required|trim|is_unique[event.nama_event]', [
            'is_unique' => 'Nama sudah digunakan',
            'required' => 'Nama event tidak boleh kosong'

        ]);
        $this->form_validation->set_rules('inpuDeskripsi', 'InputDeskripsi', 'required|trim', [
            'required' => 'Deskripsi tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('inputHarga', 'InputHarga', 'required|trim', [
            'required' => 'Harga tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('reservation', 'Reservation', 'required|trim', [
            'required' => 'Waktu tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'AORTASTAN Try Out Online | Tambah Event';
            $this->load->view('Super_Admin/templates/header_admin', $data);
            $this->load->view('Super_Admin/event/tambah_event');
        } else {
            $dataevent = [  
                'nama_event' => $this->input->post('inputName'),
                'deskripsi' => $this->input->post('inpuDeskripsi'),
                'harga' => $this->input->post('inputHarga'),
                'tgl_mulai' => $this->input->post('reservation')
            ];

            $this->db->insert('event', $dataevent);
            redirect('Administrator/tambah_soal');
        }
        
    }

    public function tambah_soal()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tambah Soal';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/tambah_soal');
    }

    public function daftar_admin()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Admin';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['admin'] = $this->db->get_where('user', ['role_id' => 2])->result_array();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/admin/daftar_admin', $data);
    }

    public function tambah_admin()
    {
        $this->load->library('form_validation');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

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
            $data['judul'] = 'AORTASTAN Try Out Online | Tambah Admin';
            $this->load->view('Super_Admin/templates/header_admin', $data);
            $this->load->view('Super_Admin/admin/tambah_admin');
        } else {
            $datauser = [  
                'username' => htmlspecialchars($this->input->post('username', true)),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $datauser);
            redirect('Administrator/daftar_admin');
        }
    }

    public function daftar_peserta()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Peserta';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['member'] = $this->db->get_where('user', ['role_id' => 3])->result_array();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/peserta/daftar_peserta', $data);
    }

    public function profile_admin()
    {
        
        $data['judul'] = 'AORTASTAN Try Out Online | Profile Saya';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('Super_Admin/templates/header_profile', $data);
            $this->load->view('Super_Admin/profile_admin');
            $this->load->view('Super_Admin/templates/footer_admin');
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
            redirect('Administrator/profile_admin');
        }
    }

    public function tambah_point($id)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Peserta';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['member'] = $this->db->get_where('user', ['id' => $id])->row_array();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/peserta/tambah_point', $data);
    }

    public function point($id)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Peserta';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['member'] = $this->db->get_where('user', ['id' => $id])->row_array();

        $this->form_validation->set_rules('inputPoint', 'InputPoint', 'required|trim', [
            'required' => 'Mohon masukkan point untuk tambah point!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('Super_Admin/templates/header_admin', $data);
            $this->load->view('Super_Admin/peserta/tambah_point');
        } else {
            $pointUser = $this->db->select('point')->get_where('user', ['id' => $id])->row()->point;
            $inputPoint = $this->input->post('inputPoint');

            $tambahPoint = $pointUser + $inputPoint;

            $datapoint = [  
                'point' => $tambahPoint
            ];

            $this->db->where('id',$id);
            $this->db->update('user', $datapoint);
            redirect('Administrator/daftar_peserta');
        }
    }

    public function view_peserta($id)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Peserta';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['member'] = $this->db->get_where('user', ['id' => $id])->row_array();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/peserta/view_peserta', $data);
    }

    public function delete_member($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
        redirect('Administrator/daftar_peserta');
    }
}
