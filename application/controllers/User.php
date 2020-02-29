<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Event_model');
        $this->load->model('Modul_model');
        $this->load->model('Topik_model');
        $this->load->model('User_model');
        $this->load->model('Rule_topik_model');
        $this->load->model('Soal_model');
        $this->load->model('Kerjakan_model');
        $this->load->model('Hasil_tes_model');
    }


    public function index()
    {

        $data['judul'] = 'AORTASTAN Try Out Online';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getAllEvent();

        $this->load->view('User/templates/header_home', $data);
        $this->load->view('User/index', $data);
        $this->load->view('User/templates/footer');
    }

    public function tryout()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tryout';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getAllEvent();

        $this->load->view('User/templates/header_tryout', $data);
        $this->load->view('User/tryout', $data);
        $this->load->view('User/templates/footer');
    }

    public function event($id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Event Detail';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['topik_tpa'] = $this->Topik_model->getTopikTPA();
        $data['topik_tbi'] = $this->Topik_model->getTopikTBI();
        $data['topik_skd'] = $this->Topik_model->getTopikSKD();

        $this->load->view('User/templates/header_tryout', $data);
        $this->load->view('User/event_detail', $data);
        $this->load->view('User/templates/footer');
    }

    public function tes_tpa($id, $id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tes TPA';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['topik_tpa'] = $this->Topik_model->getTopikTPA();
        $data['topik_rule_tpa'] = $this->Topik_model->getRuleTopikTPA();

        $id_topik = $this->Topik_model->getIdTopikTPA();
        $topik_rule = $this->Topik_model->getRuleTopikTPA();

        $harga = $this->Event_model->getHargaEvent($id_event);
        $point = $this->db->select('point')->get_where('user', ['role_id' => 3, 'username' => $sessionUser])->row()->point;

        if ($point < $harga) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Maaf point anda tidak mencukupi untuk ikut dalam event! Silahkan top up point di menu profile saya.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/tryout');
        } else {
            $bayar = $point - $harga;

            $tampungBayar = array('point' => $bayar);
            $this->User_model->updatePointUserByUsername($sessionUser, $tampungBayar);
        }
        redirect('User/tes_detail/' . $id . '/' . $id_event . '/' . $id_topik);
    }

    public function tes_tbi($id, $id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tes TPA';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getEventById($id_event);
        $id_topik = $this->Topik_model->getIdTopikTBI();
        $topik_rule = $this->Topik_model->getRuleTopikTBI();

        redirect('User/tes_detail/' . $id . '/' . $id_event . '/' . $id_topik);
    }

    public function tes_skd($id, $id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tes TPA';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getEventById($id_event);
        $id_topik = $this->Topik_model->getIdTopikTBI();
        $topik_rule = $this->Topik_model->getRuleTopikTBI();

        redirect('User/tes_skd_detail/' . $id . '/' . $id_event);
    }

    public function tes_skd_detail($id, $id_event)
    {
        $nama = $this->Topik_model->getNamaTopikSKD();

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['klmpk_skd'] = $this->Topik_model->getKlmpkSKD();
        $data['klmpk_rule_skd'] = $this->Topik_model->getRuleTopikSKD();
        $data['topik_skd'] = $this->Topik_model->getTopikSKD();

        $data['judul'] = 'AORTASTAN Try Out Online | ' . $nama;

        $this->load->view('User/templates/header_tes', $data);
        $this->load->view('User/tes_skd', $data);
        $this->load->view('User/templates/footer_tes');
    }

    public function kerjakan_skd($id, $id_event, $id_topik)
    {
        $nama = $this->Topik_model->getNamaTopikById($id_topik);
        $data['judul'] = 'AORTASTAN Try Out Online | ' . $nama;
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['topik'] = $this->Topik_model->getTopikSKD();
        $data['topik_rule'] = $this->Topik_model->getRuleTopikSKD();
        $data['soal_twk'] = $this->Soal_model->getSoalTWKbyIdEvent($id_event);
        $data['soal_tiu'] = $this->Soal_model->getSoalTIUbyIdEvent($id_event);
        $data['soal_tkp'] = $this->Soal_model->getSoalTKPbyIdEvent($id_event);
        
        $waktudaftar = time();

        $dataTransaksi = [
            'id_topik' => $id_topik,
            'id_event' => $id_event,
            'id_user' => $id,
            'waktu_daftar' => $waktudaftar
        ];
        $this->Kerjakan_model->sessionKerjakan($dataTransaksi);

        $this->session->unset_userdata('id_event');
        $this->session->unset_userdata('id_topik');
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('waktu_daftar');

        $data['transaksi'] = $this->Kerjakan_model->getKerjakan($id_event, $id_topik, $id);

        $this->load->view('User/templates/header_tes', $data);
        $this->load->view('User/tes/kerjakan_tes', $data);
        $this->load->view('User/templates/footer_tes');
    }

    public function tes_detail($id, $id_event, $id_topik)
    {
        $nama = $this->Topik_model->getNamaTopikById($id_topik);

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['topik'] = $this->Topik_model->getTopikById($id_topik);
        $data['topik_rule'] = $this->Topik_model->getRuleTopikById($id_topik);
        $data['topik_skd'] = $this->Topik_model->getTopikSKD();

        $data['judul'] = 'AORTASTAN Try Out Online | ' . $nama;

        $this->load->view('User/templates/header_tes', $data);
        $this->load->view('User/tes_detail', $data);
        $this->load->view('User/templates/footer_tes');
    }

    public function kerjakan_tes($id, $id_event, $id_topik)
    {
        $nama = $this->Topik_model->getNamaTopikById($id_topik);
        $data['judul'] = 'AORTASTAN Try Out Online | ' . $nama;
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['topik'] = $this->Topik_model->getTopikById($id_topik);
        $data['topik_rule'] = $this->Topik_model->getRuleTopikById($id_topik);
        $data['soal'] = $this->Soal_model->getSoalById($id_event, $id_topik);
        
        $waktudaftar = time();

        $dataTransaksi = [
            'id_topik' => $id_topik,
            'id_event' => $id_event,
            'id_user' => $id,
            'waktu_daftar' => $waktudaftar
        ];
        $this->Kerjakan_model->sessionKerjakan($dataTransaksi);

        $this->session->unset_userdata('id_event');
        $this->session->unset_userdata('id_topik');
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('waktu_daftar');

        $data['transaksi'] = $this->Kerjakan_model->getKerjakan($id_event, $id_topik, $id);

        $this->load->view('User/templates/header_tes', $data);
        $this->load->view('User/tes/kerjakan_tes', $data);
        $this->load->view('User/templates/footer_tes');
    }

    public function jawab()
    {
        $this->load->model('Kerjakan_model', 'kerjakan');
        $jawaban = $_POST;
        $dataJawaban = [
            'id_user' => $jawaban['idp'],
            'id_topik' => $jawaban['topik'],
            'id_event' => $jawaban['eve'],
            'id_soal' => $jawaban['soal'],
            'id_jawaban' => $jawaban['jwb']
        ];
        $this->kerjakan->jawabsoal($dataJawaban);
    }

    public function testimoni()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Testimoni';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $this->load->view('User/templates/header_testimoni', $data);
        $this->load->view('User/testimoni');
        $this->load->view('User/templates/footer');
    }

    public function koreksi($id, $id_event, $id_topik)
    {
        $dataJawaban = $this->Kerjakan_model->koreksi($id, $id_event, $id_topik);

        $total_benar = 0;
        foreach ($dataJawaban as $jawab) {
            $total_benar = $total_benar + $jawab['score'];
        }

        $dataHasil = [
            'id_topik' => $id_topik,
            'id_event' => $id_event,
            'id_user' => $id,
            'hasil' => $total_benar
        ];

        $this->Hasil_tes_model->insertHasil($dataHasil);

        $this->Kerjakan_model->hapuscache($id, $id_topik, $id_event);

        redirect('User/hasil_tes/' . $id . '/' . $id_event . '/' . $id_topik);
    }

    public function hasil_tes($id, $id_event, $id_topik)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tes TPA';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['topik'] = $this->Topik_model->getTopikById($id_topik);
        $data['topik_rule'] = $this->Topik_model->getRuleTopikById($id_topik);
        $data['hasil'] = $this->Hasil_tes_model->getHasil($id, $id_event, $id_topik);

        $this->load->view('User/templates/header_tes', $data);
        $this->load->view('User/hasil_tes', $data);
        $this->load->view('User/templates/footer_tes');
    }


    public function contact()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Contact';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $this->load->view('User/templates/header_contact', $data);
        $this->load->view('User/contact');
        $this->load->view('User/templates/footer');
    }

    public function profile_saya()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Profile Saya';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('User/templates/header_profile', $data);
            $this->load->view('User/profile_saya', $data);
            $this->load->view('User/templates/footer');
        } else {
            $name = $this->input->post('name');
            $tentang = $this->input->post('tentang');
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

            $tampung = array(
                'name' => $name,
                'tentang' => $tentang
            );
            $this->db->where('username', $username);
            $this->db->update('user', $tampung);
            redirect($this->uri->uri_string());
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong!'
        ]);

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
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf password yang dimasukkan salah!</div>');
                    redirect('User/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf email belum terverifikasi! Silahkan cek email anda untuk verifikasi.</div>');
                redirect('User/login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf email tidak terdaftar!</div>');
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
            'matches' => 'Password tidak sama !',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'AORTASTAN Try Out Online | Register';
            $this->load->view('User/registration', $data);
        } else {
            $email = $this->input->post('email', true);
            $datauser = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'tentang' => 'Aku adalah seorang pejuang !',
                'role_id' => 3,
                'is_active' => 0,
                'date_created' => time()
            ];

            //Menyiapkan token untuk verifikasi
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $datauser);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat! Silahkan cek email anda untuk verifikasi akun.</div>');
            redirect('User/login');
        }
    }

    private function _sendEmail($token, $type)
    {
        $this->load->library('email');

        $emailLupa = $this->input->post('email');
        $namaUserLupa = $this->db->select('name')->get_where('user', ['email' => $emailLupa])->row()->name;

        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'sobatkode@gmail.com';
        $config['smtp_pass'] = 'Iws161jy21';
        $config['smtp_port'] = 465;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('sobatkode@gmail.com', 'Sobatkode.com');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('<h3>Halo ' . $namaUserLupa . '</h3> <br> Silahkan klik link dibawah ini untuk verifikasi akun anda: <br><a href="' . base_url() . 'User/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('<h3>Halo ' . $namaUserLupa . '</h3> <br> Silahkan klik link dibawah ini untuk merubah password akun anda: <br><a href="' . base_url() . 'User/forgotPassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token =  $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 2)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Email ' . $email . ' telah aktif! Silahkan login</div>');
                    redirect('User/login');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf aktifasi akun gagal! Token user kadaluarsa.</div>');
                    redirect('User/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf aktifasi akun gagal! Token user salah.</div>');
                redirect('User/login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf aktifasi akun gagal! Email salah.</div>');
            redirect('User/login');
        }
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'AORTASTAN Try Out Online | Forgot Password';
            $this->load->view('User/forgot_password', $data);
        } else {
            $email = $this->input->post('email', true);
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil! Silahkan cek email anda untuk ganti password</div>');
                redirect('User/forgot_password');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum verifikasi atau tidak terdaftar</div>');
                redirect('User/forgot_password');
            }
        }
    }

    public function forgotPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf ganti password gagal! Token user salah.</div>');
                redirect('User/login');
            }
        }
        else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf ganti password gagal! Email salah.</div>');
            redirect('User/login');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('User/login');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Minimal password terdiri dari 8 karakter',
            'matches' => 'Password tidak sama'
        ]);
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|required|min_length[8]|matches[password1]');  
              
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'AORTASTAN Try Out Online | Change Password';

            $this->load->view('User/change_password', $data);
        } else{
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil dirubah! Silahkan login.</div>');
            redirect('User/login');
        }
    }
}
