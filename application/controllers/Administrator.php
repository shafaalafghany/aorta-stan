<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Event_model');
        $this->load->model('User_model');
        $this->load->model('Modul_model');
        $this->load->model('Topik_model');
    }

    public function index()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Dashboard';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['modul'] = $this->Modul_model->getAllModul();
        $data['event'] = $this->Event_model->getAllEvent();
        $data['allUser'] = $this->User_model->getAllUser();
        $data['admin'] = $this->User_model->getAllAdmin();

        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/index', $data);
        $this->load->view('Super_Admin/templates/footer_admin');
    }

    public function daftar_modul()
    {
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['modul'] = $this->Modul_model->getAllModul();

        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Modul';
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/modul/daftar_modul');
    }

    public function tambah_modul()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tambah Modul';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['topik'] = $this->Topik_model->getAllTopik();

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('jenisModul', 'JenisModul', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('Super_Admin/templates/header_admin', $data);
            $this->load->view('Super_Admin/modul/tambah_modul', $data);
        } else {
            $judul = $this->input->post('judul');
            $jenisModul = $this->input->post('jenisModul');
            $deskripsi = $this->input->post('deskripsi');

            $upload_file = $_FILES['file']['name'];

            if ($upload_file) {
                $config['upload_path'] = './assets/file/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 51200;
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $new_file = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $tampungData = array(
                'judul_modul' => $judul,
                'deskripsi' => $deskripsi,
                'jenis' => $jenisModul,
                'file' => $new_file
            );

            $this->db->insert('modul', $tampungData);
            redirect('Administrator/daftar_modul');
        }
    }

    public function hapus_modul($id)
    {
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['event'] = $this->Modul_model->getAllModul();

        $this->Modul_model->deleteModul($id);
        redirect('Administrator/daftar_modul');
    }

    public function daftar_event()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Event';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['event'] = $this->Event_model->getAllEvent();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/daftar_event', $data);
    }

    public function daftar_soal()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Soal';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['topik'] = $this->Topik_model->getAllTopik();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/daftar_soal');
    }

    public function tambah_event()
    {
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['event'] = $this->Event_model->getAllEvent();

        $this->form_validation->set_rules('event', 'Event', 'required|trim|is_unique[event.nama_event]', [
            'is_unique' => 'Nama sudah digunakan',
            'required' => 'Nama event tidak boleh kosong'

        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
            'required' => 'Deskripsi tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim', [
            'required' => 'Harga tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('mulai', 'Mulai', 'required|trim', [
            'required' => 'Waktu tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('akhir', 'Akhir', 'required|trim', [
            'required' => 'Waktu tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'AORTASTAN Try Out Online | Tambah Event';
            $this->load->view('Super_Admin/templates/header_admin', $data);
            $this->load->view('Super_Admin/event/tambah_event');
        } else {
            $dataevent = [
                'nama_event' => $this->input->post('event'),
                'deskripsi' => $this->input->post('deskripsi'),
                'tingkat' => 'Se-Indonesia',
                'harga' => $this->input->post('harga'),
                'tgl_mulai' => $this->input->post('mulai'),
                'tgl_akhir' => $this->input->post('akhir')
            ];

            $this->Event_model->insertEvent($dataevent);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12" role="alert"><strong>Satu event berhasil ditambahkan! Silahkan buat soalnya</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Administrator/tambah_soal');
        }
    }

    public function hapus_event($id)
    {
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['event'] = $this->Event_model->getAllEvent();

        $this->Event_model->deleteEvent($id);
        redirect('Administrator/daftar_event');
    }

    public function tambah_soal()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tambah Soal';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['event'] = $this->Event_model->getAllEvent();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/tambah_soal', $data);
    }

    public function buat_soal()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tambah Soal';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $optionEvent = $this->input->post('optionEvent');
        $data['event'] = $this->Event_model->getEventById($optionEvent);

        $data['topik'] = $this->Topik_model->getAllTopik();
        $data['fourTopik'] = $this->Topik_model->getFourTopik();

        $optionTopik = $this->input->post('pilihTopik');

        $this->form_validation->set_rules('inputSoal', 'soal', 'required|trim');
        $this->form_validation->set_rules('jawaban1', 'jawaban1', 'required|trim');
        $this->form_validation->set_rules('jawaban2', 'jawaban2', 'required|trim');
        $this->form_validation->set_rules('jawaban3', 'jawaban3', 'required|trim');
        $this->form_validation->set_rules('jawaban4', 'jawaban4', 'required|trim');
        $this->form_validation->set_rules('jawaban5', 'jawaban5', 'required|trim');

        if ($optionEvent) {
            if ($this->form_validation->run() == false) {
                $this->load->view('Super_Admin/templates/header_admin', $data);
                $this->load->view('Super_Admin/event/buat_soal', $data);
            } else {
                $this->Soal_model->tambahSoal($optionTopik, $optionEvent);
                redirect('Administrator/buat_soal');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12" role="alert"><strong>Silahkan pilih event dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Administrator/tambah_soal');
        }
    }

    public function buat_soal_tkp()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tambah Soal';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $optionEvent = $this->input->post('optionEvent');
        $data['event'] = $this->Event_model->getEventById($optionEvent);

        $data['topik'] = $this->Topik_model->getAllTopik();

        $this->form_validation->set_rules('inputSoal', 'soal', 'required|trim');
        $this->form_validation->set_rules('jawaban1', 'jawaban1', 'required|trim');
        $this->form_validation->set_rules('jawaban2', 'jawaban2', 'required|trim');
        $this->form_validation->set_rules('jawaban3', 'jawaban3', 'required|trim');
        $this->form_validation->set_rules('jawaban4', 'jawaban4', 'required|trim');
        $this->form_validation->set_rules('jawaban5', 'jawaban5', 'required|trim');

        if ($optionEvent) {
            if ($this->form_validation->run() == false) {
                $this->load->view('Super_Admin/templates/header_admin', $data);
                $this->load->view('Super_Admin/event/buat_soal', $data);
            } else {
                $dataSoal = [];
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12" role="alert"><strong>Silahkan pilih event dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Administrator/tambah_soal');
        }
    }

    public function daftar_admin()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Admin';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['admin'] = $this->User_model->getAllAdmin();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/admin/daftar_admin', $data);
    }

    public function tambah_admin()
    {
        $this->load->library('form_validation');
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

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

            $this->User_model->insertAdmin($datauser);
            redirect('Administrator/daftar_admin');
        }
    }

    public function hapus_admin($id)
    {
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['event'] = $this->Event_model->getAllEvent();

        $this->User_model->deleteAdminById($id);
        redirect('Administrator/daftar_admin');
    }

    public function daftar_peserta()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Peserta';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['member'] = $this->User_model->getAllUser();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/peserta/daftar_peserta', $data);
    }

    public function profile_admin()
    {

        $data['judul'] = 'AORTASTAN Try Out Online | Profile Saya';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

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
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['member'] = $this->User_model->getUserById($id);
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/peserta/tambah_point', $data);
    }

    public function point($id)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Peserta';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['member'] = $this->User_model->getUserById($id);

        $this->form_validation->set_rules('inputPoint', 'InputPoint', 'required|trim', [
            'required' => 'Mohon masukkan point untuk tambah point!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('Super_Admin/templates/header_admin', $data);
            $this->load->view('Super_Admin/peserta/tambah_point');
        } else {
            $pointUser = $this->User_model->getPointUserById($id);
            $inputPoint = $this->input->post('inputPoint');

            $tambahPoint = $pointUser + $inputPoint;

            $datapoint = [
                'point' => $tambahPoint
            ];

            $this->User_model->updatePointUserById($id, $datapoint);
            redirect('Administrator/daftar_peserta');
        }
    }

    public function view_peserta($id)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Peserta';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['member'] = $this->User_model->getUserById($id);
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/peserta/view_peserta', $data);
    }

    public function delete_member($id)
    {
        $this->User_model->deleteUserById($id);
        redirect('Administrator/daftar_peserta');
    }
}
