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
        $this->load->model('Soal_model');
        $this->load->model('Hasil_tes_model');
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

    public function leaderboard()
    {
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['event'] = $this->Event_model->getAllEvent();
        // $data['leader'] = $this->hasil->getLeaderboardByEvent($id_event);
        // $data['hasilUser'] = $this->hasil->getLeaderboardByIdAndEvent($id, $id_event);
        // $hasil_tes = $this->hasil->getHasilByIdAndEvent($id, $id_event);
        // $transaksi = $this->db->get_where('transaksi_user', [
        //     'id_user' => $id,
        //     'id_event' => $id_event
        // ])->row_array();

        $data['judul'] = 'AORTASTAN Try Out Online | Leaderboard';
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/leaderboard');
    }

    public function leaderboard_list()
    {
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $optionEvent = $this->input->post('optionEvent');
        $data['event'] = $this->Event_model->getEventById($optionEvent);
        $data['leader'] = $this->Hasil_tes_model->getLeaderboardByEvent($optionEvent);

        $data['judul'] = 'AORTASTAN Try Out Online | Leaderboard';
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/leaderboard_list', $data);
    }

    public function leader_detail($id_event, $id_leaderboard)
    {
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['leader'] = $this->Hasil_tes_model->getLeaderboardByIdLeader($id_leaderboard);

        $data['judul'] = 'AORTASTAN Try Out Online | Leaderboard Detail';
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/leaderboard_detail', $data);
    }

    public function analisis_jurusan($id_leaderboard)
    {
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['leader'] = $this->Hasil_tes_model->getLeaderboardByIdLeader($id_leaderboard);

        $leaderboard = $this->db->get_where('leaderboard', [
            'id_leaderboard' => $id_leaderboard
        ])->row_array();
        $data['event'] = $this->Event_model->getEventById($leaderboard['id_event']);
        $data['transaksi'] = $this->db->get_where('transaksi_user', [
            'id_user' => $leaderboard['id_user'],
            'id_event' => $leaderboard['id_event']
        ])->row_array();

        $data['judul'] = 'AORTASTAN Try Out Online | Analisis Jurusan';
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/analisis_jurusan', $data);
    }

    public function upload_jurusan($id_leaderboard)
    {
        $jurusan = $this->input->post('optionJurusan');

        $tampungData = array(
            'analisis_jurusan' => $jurusan
        );

        $this->db->set($tampungData)->where('id_leaderboard', $id_leaderboard)->update('leaderboard');
        redirect('Administrator/leaderboard');
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
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12" role="alert"><strong>Maaf file gagal diupload! Pastikan ukuran dan format file sesuai.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('Administrator/tambah_modul');
                }
            }

            $tampungData = array(
                'judul_modul' => $judul,
                'deskripsi' => $deskripsi,
                'jenis' => $jenisModul,
                'file' => $new_file
            );

            $this->db->insert('modul', $tampungData);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12" role="alert"><strong>Satu Modul berhasil ditambahkan!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Administrator/daftar_modul');
        }
    }

    public function hapus_modul($id)
    {
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['event'] = $this->Modul_model->getAllModul();

        $this->load->helper('file');

        $file_name = $this->db->select('file')->get_where('modul', ['id_modul' => $id])->row()->file;
        $path = './assets/file/' . $file_name;
        unlink($path);

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

    public function edit_event($id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Event';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['event'] = $this->Event_model->getEventById($id_event);

        $this->form_validation->set_rules('event', 'Event', 'required|trim', [
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
            $this->load->view('Super_Admin/templates/header_admin', $data);
            $this->load->view('Super_Admin/event/edit_event');
        } else {
            $this->load->helper('file');

            $file_name = $this->db->select('pembahasan')->get_where('event', ['id_event' => $id_event])->row()->pembahasan;
            $file = $this->input->post('file');
            $jumlahJurusan = $this->input->post('optionJurusan');
            $upload_file = $_FILES['file']['name'];

            if ($upload_file) {
                $config['upload_path'] = './assets/filePembahasan/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 51200;
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $new_file = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12" role="alert"><strong>Maaf file gagal diupload! Pastikan ukuran dan format file sesuai.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('Administrator/daftar_event');
                }

                if ($file_name) {
                    $path = './assets/filePembahasan/' . $file_name;
                    unlink($path);
                }

                if ($jumlahJurusan == 0) {
                    $dataevent = [
                        'nama_event' => $this->input->post('event'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'harga' => $this->input->post('harga'),
                        'tgl_mulai' => $this->input->post('mulai'),
                        'tgl_akhir' => $this->input->post('akhir'),
                        'pembahasan' => $new_file
                    ];
                } else {
                    $dataevent = [
                        'nama_event' => $this->input->post('event'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'harga' => $this->input->post('harga'),
                        'tgl_mulai' => $this->input->post('mulai'),
                        'tgl_akhir' => $this->input->post('akhir'),
                        'jurusan' => $jumlahJurusan,
                        'pembahasan' => $new_file
                    ];
                }
            } else {
                if ($jumlahJurusan == 0) {
                    $dataevent = [
                        'nama_event' => $this->input->post('event'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'harga' => $this->input->post('harga'),
                        'tgl_mulai' => $this->input->post('mulai'),
                        'tgl_akhir' => $this->input->post('akhir')
                    ];
                } else {
                    $dataevent = [
                        'nama_event' => $this->input->post('event'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'harga' => $this->input->post('harga'),
                        'tgl_mulai' => $this->input->post('mulai'),
                        'tgl_akhir' => $this->input->post('akhir'),
                        'jurusan' => $jumlahJurusan
                    ];
                }
            }

            $this->Event_model->updateEvent($id_event, $dataevent);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12" role="alert"><strong>Satu event berhasil diperbarui</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Administrator/daftar_event');
        }
    }

    public function daftar_soal()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Soal';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['event'] = $this->Event_model->getAllEvent();
        $data['topik'] = $this->Topik_model->getAllTopik();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/daftar_soal', $data);
    }

    public function soal_detail()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Soal Detail';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $optionEvent = $this->input->post('optionEvent');
        $optionTopik = $this->input->post('optionTopik');
        $data['event'] = $this->Event_model->getEventById($optionEvent);
        $data['topik'] = $this->Topik_model->getTopikById($optionTopik);

        $data['soal'] = $this->Soal_model->getSoalByIdEventAndIdTopik($optionEvent, $optionTopik);

        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/event/daftar_soal_detail', $data);
    }

    public function view_soal($id_event, $id_topik, $id_soal)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Contact';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['topik'] = $this->Topik_model->getTopikById($id_topik);

        $data['soal'] = $this->Soal_model->getSoalByIdSoal($id_soal);
        $data['jawaban'] = $this->Soal_model->getJawabanByIdSoal($id_soal);

        $this->form_validation->set_rules('inputSoal', 'inputSoal', 'required|trim', [
            'required' => 'Soal tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('Super_Admin/templates/header_admin', $data);
            $this->load->view('Super_Admin/event/edit_soal', $data);
        } else {
            if ($id_topik >= 3) {
                $dataSoal = [
                    'id_soal' => $id_soal,
                    'id_topik_tes' => $id_topik,
                    'id_event' => $id_event,
                    'id_skd' => 3,
                    'soal' => $this->input->post('inputSoal')
                ];
            } else {
                $dataSoal = [
                    'id_soal' => $id_soal,
                    'id_topik_tes' => $id_topik,
                    'id_event' => $id_event,
                    'id_skd' => 0,
                    'soal' => $this->input->post('inputSoal')
                ];
            }
        }
        $this->db->where('id_soal', $id_soal);
        $this->db->update('soal', $dataSoal);
        $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12" role="alert"><strong>Satu soal berhasil diperbarui</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('Administrator/daftar_soal');
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
                'harga' => $this->input->post('harga'),
                'tgl_mulai' => $this->input->post('mulai'),
                'tgl_akhir' => $this->input->post('akhir'),
                'jurusan' => $this->input->post('optionJurusan')
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

        $this->load->helper('file');

        $file_name = $this->db->select('pembahasan')->get_where('event', ['id_event' => $id])->row()->pembahasan;
        if ($file_name) {
            $path = './assets/filePembahasan/' . $file_name;
            unlink($path);
        }

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

    public function hapus_soal($id)
    {
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['soal'] = $this->Soal_model->getAllSoal();

        $this->Soal_model->deleteSoal($id);
        redirect('Administrator/daftar_soal');
    }

    public function buat_soal()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Buat Soal';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $optionEvent = $this->input->post('optionEvent');
        $data['event'] = $this->Event_model->getEventById($optionEvent);

        $data['topik'] = $this->Topik_model->getAllTopik();
        $data['fourTopik'] = $this->Topik_model->getFourTopik();


        if ($optionEvent) {
            $this->load->view('Super_Admin/templates/header_admin', $data);
            $this->load->view('Super_Admin/event/buat_soal', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12" role="alert"><strong>Silahkan pilih event dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Administrator/tambah_soal');
        }
    }

    public function insert_soal($id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tambah Soal';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $optionTopik = $this->input->post('optionTopik');

        $this->form_validation->set_rules('inputSoal', 'soal', 'required|trim');
        $this->form_validation->set_rules('jawaban1', 'jawaban1', 'required|trim');
        $this->form_validation->set_rules('jawaban2', 'jawaban2', 'required|trim');
        $this->form_validation->set_rules('jawaban3', 'jawaban3', 'required|trim');
        $this->form_validation->set_rules('jawaban4', 'jawaban4', 'required|trim');
        $this->form_validation->set_rules('jawaban5', 'jawaban5', 'trim');

        $jawabanBenar = $this->input->post('jawabanBenar');
        $jawaban1 = $this->input->post('jawaban1');
        $jawaban2 = $this->input->post('jawaban2');
        $jawaban3 = $this->input->post('jawaban3');
        $jawaban4 = $this->input->post('jawaban4');
        $jawaban5 = $this->input->post('jawaban5');
        $soal = $this->input->post('inputSoal');

        if ($this->form_validation->run() == false) {
            $this->load->view('Super_Admin/templates/header_admin', $data);
            $this->load->view('Super_Admin/event/buat_soal', $data);
        } else {
            if ($optionTopik >= 3) {
                $dataSoal = [
                    'id_topik_tes' => $optionTopik,
                    'id_event' => $id_event,
                    'id_skd' => 3,
                    'soal' => $soal
                ];
            } else {
                $dataSoal = [
                    'id_topik_tes' => $optionTopik,
                    'id_event' => $id_event,
                    'id_skd' => 0,
                    'soal' => $soal
                ];
            }

            $this->db->insert('soal', $dataSoal);

            $getIdSoal = $this->db->select('id_soal')->get_where('soal', [
                'id_topik_tes' => $optionTopik,
                'id_event' => $id_event,
                'soal' => $soal
            ])->row()->id_soal;

            if ($optionTopik == 1) {
                if ($jawabanBenar == "jawaban1") {
                    $jawabanBenar = $jawaban1;

                    $dataJawabanBenar = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawabanBenar,
                        'score' => 4
                    ];
                    $this->db->insert('jawaban', $dataJawabanBenar);

                    $dataJawaban2 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban2,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban2);

                    $dataJawaban3 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban3,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban3);

                    $dataJawaban4 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban4,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban4);

                    if ($jawaban5 != null) {
                        $dataJawaban5 = [
                            'id_soal' => $getIdSoal,
                            'id_topik_tes' => $optionTopik,
                            'id_event' => $id_event,
                            'jawaban' => $jawaban5,
                            'score' => -1
                        ];
                        $this->db->insert('jawaban', $dataJawaban5);
                    }
                } elseif ($jawabanBenar == "jawaban2") {
                    $jawabanBenar = $jawaban2;

                    $dataJawaban1 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban1,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban1);

                    $dataJawabanBenar = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawabanBenar,
                        'score' => 4
                    ];
                    $this->db->insert('jawaban', $dataJawabanBenar);

                    $dataJawaban3 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban3,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban3);

                    $dataJawaban4 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban4,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban4);

                    if ($jawaban5 != null) {
                        $dataJawaban5 = [
                            'id_soal' => $getIdSoal,
                            'id_topik_tes' => $optionTopik,
                            'id_event' => $id_event,
                            'jawaban' => $jawaban5,
                            'score' => -1
                        ];
                        $this->db->insert('jawaban', $dataJawaban5);
                    }
                } elseif ($jawabanBenar == "jawaban3") {
                    $jawabanBenar = $jawaban3;

                    $dataJawaban1 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban1,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban1);

                    $dataJawaban2 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban2,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban2);

                    $dataJawabanBenar = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawabanBenar,
                        'score' => 4
                    ];
                    $this->db->insert('jawaban', $dataJawabanBenar);

                    $dataJawaban4 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban4,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban4);

                    if ($jawaban5 != null) {
                        $dataJawaban5 = [
                            'id_soal' => $getIdSoal,
                            'id_topik_tes' => $optionTopik,
                            'id_event' => $id_event,
                            'jawaban' => $jawaban5,
                            'score' => -1
                        ];
                        $this->db->insert('jawaban', $dataJawaban5);
                    }
                } elseif ($jawabanBenar == "jawaban4") {
                    $jawabanBenar = $jawaban4;

                    $dataJawaban1 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban1,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban1);

                    $dataJawaban2 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban2,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban2);

                    $dataJawaban3 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban3,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban3);

                    $dataJawabanBenar = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawabanBenar,
                        'score' => 4
                    ];
                    $this->db->insert('jawaban', $dataJawabanBenar);

                    if ($jawaban5 != null) {
                        $dataJawaban5 = [
                            'id_soal' => $getIdSoal,
                            'id_topik_tes' => $optionTopik,
                            'id_event' => $id_event,
                            'jawaban' => $jawaban5,
                            'score' => -1
                        ];
                    }
                    $this->db->insert('jawaban', $dataJawaban5);
                } else {
                    $jawabanBenar = $jawaban5;

                    $dataJawaban1 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban1,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban1);

                    $dataJawaban2 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban2,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban2);

                    $dataJawaban3 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban3,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban3);

                    $dataJawaban4 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban4,
                        'score' => -1
                    ];
                    $this->db->insert('jawaban', $dataJawaban4);

                    $dataJawabanBenar = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawabanBenar,
                        'score' => 4
                    ];
                    $this->db->insert('jawaban', $dataJawabanBenar);
                }
            } else {
                if ($jawabanBenar == "jawaban1") {
                    $jawabanBenar = $jawaban1;

                    $dataJawabanBenar = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawabanBenar,
                        'score' => 5
                    ];
                    $this->db->insert('jawaban', $dataJawabanBenar);

                    $dataJawaban2 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban2,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban2);

                    $dataJawaban3 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban3,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban3);

                    $dataJawaban4 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban4,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban4);

                    $dataJawaban5 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban5,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban5);
                } elseif ($jawabanBenar == "jawaban2") {
                    $jawabanBenar = $jawaban2;

                    $dataJawaban1 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban1,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban1);

                    $dataJawabanBenar = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawabanBenar,
                        'score' => 5
                    ];
                    $this->db->insert('jawaban', $dataJawabanBenar);

                    $dataJawaban3 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban3,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban3);

                    $dataJawaban4 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban4,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban4);

                    $dataJawaban5 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban5,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban5);
                } elseif ($jawabanBenar == "jawaban3") {
                    $jawabanBenar = $jawaban3;

                    $dataJawaban1 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban1,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban1);

                    $dataJawaban2 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban2,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban2);

                    $dataJawabanBenar = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawabanBenar,
                        'score' => 5
                    ];
                    $this->db->insert('jawaban', $dataJawabanBenar);

                    $dataJawaban4 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban4,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban4);

                    $dataJawaban5 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban5,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban5);
                } elseif ($jawabanBenar == "jawaban4") {
                    $jawabanBenar = $jawaban4;

                    $dataJawaban1 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban1,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban1);

                    $dataJawaban2 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban2,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban2);

                    $dataJawaban3 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban3,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban3);

                    $dataJawabanBenar = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawabanBenar,
                        'score' => 5
                    ];
                    $this->db->insert('jawaban', $dataJawabanBenar);

                    $dataJawaban5 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban5,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban5);
                } else {
                    $jawabanBenar = $jawaban5;

                    $dataJawaban1 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban1,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban1);

                    $dataJawaban2 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban2,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban2);

                    $dataJawaban3 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban3,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban3);

                    $dataJawaban4 = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawaban4,
                        'score' => 0
                    ];
                    $this->db->insert('jawaban', $dataJawaban4);

                    $dataJawabanBenar = [
                        'id_soal' => $getIdSoal,
                        'id_topik_tes' => $optionTopik,
                        'id_event' => $id_event,
                        'jawaban' => $jawabanBenar,
                        'score' => 5
                    ];
                    $this->db->insert('jawaban', $dataJawabanBenar);
                }
            }


            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12" role="alert"><strong>Satu soal berhasil ditambahkan</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('Administrator/tambah_soal');
        }
    }

    public function buat_soal_tkp($id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tambah Soal';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['topik'] = $this->Topik_model->getAllTopik();

        $this->form_validation->set_rules('inputSoalTKP', 'soal', 'required|trim');
        $this->form_validation->set_rules('jawabanTkp1', 'jawaban1', 'required|trim');
        $this->form_validation->set_rules('jawabanTkp2', 'jawaban2', 'required|trim');
        $this->form_validation->set_rules('jawabanTkp3', 'jawaban3', 'required|trim');
        $this->form_validation->set_rules('jawabanTkp4', 'jawaban4', 'required|trim');
        $this->form_validation->set_rules('jawabanTkp5', 'jawaban5', 'required|trim');
        $this->form_validation->set_rules('pointJawabanTkp1', 'pointJawaban1', 'required|trim');
        $this->form_validation->set_rules('pointJawabanTkp2', 'pointJawaban2', 'required|trim');
        $this->form_validation->set_rules('pointJawabanTkp3', 'pointJawaban3', 'required|trim');
        $this->form_validation->set_rules('pointJawabanTkp4', 'pointJawaban4', 'required|trim');
        $this->form_validation->set_rules('pointJawabanTkp5', 'pointJawaban5', 'required|trim');

        $pointJwbTkp1 = $this->input->post('pointJawabanTkp1');
        $pointJwbTkp2 = $this->input->post('pointJawabanTkp2');
        $pointJwbTkp3 = $this->input->post('pointJawabanTkp3');
        $pointJwbTkp4 = $this->input->post('pointJawabanTkp4');
        $pointJwbTkp5 = $this->input->post('pointJawabanTkp5');
        $jawaban1 = $this->input->post('jawabanTkp1');
        $jawaban2 = $this->input->post('jawabanTkp2');
        $jawaban3 = $this->input->post('jawabanTkp3');
        $jawaban4 = $this->input->post('jawabanTkp4');
        $jawaban5 = $this->input->post('jawabanTkp5');
        $soal = $this->input->post('inputSoalTKP');

        if ($this->form_validation->run() == false) {
            $this->load->view('Super_Admin/templates/header_admin', $data);
            $this->load->view('Super_Admin/event/buat_soal', $data);
        } else {
            $dataSoal = [
                'id_topik_tes' => 5,
                'id_event' => $id_event,
                'id_skd' => 3,
                'soal' => $soal
            ];

            $this->db->insert('soal', $dataSoal);

            $getIdSoal = $this->db->select('id_soal')->get_where('soal', [
                'id_topik_tes' => 5,
                'id_event' => $id_event,
                'id_skd' => 3,
                'soal' => $soal
            ])->row()->id_soal;

            $dataJawaban1 = [
                'id_soal' => $getIdSoal,
                'id_topik_tes' => 5,
                'id_event' => $id_event,
                'jawaban' => $jawaban1,
                'score' => $pointJwbTkp1
            ];
            $this->db->insert('jawaban', $dataJawaban1);

            $dataJawaban2 = [
                'id_soal' => $getIdSoal,
                'id_topik_tes' => 5,
                'id_event' => $id_event,
                'jawaban' => $jawaban2,
                'score' => $pointJwbTkp2
            ];
            $this->db->insert('jawaban', $dataJawaban2);

            $dataJawaban3 = [
                'id_soal' => $getIdSoal,
                'id_topik_tes' => 5,
                'id_event' => $id_event,
                'jawaban' => $jawaban3,
                'score' => $pointJwbTkp3
            ];
            $this->db->insert('jawaban', $dataJawaban3);

            $dataJawaban4 = [
                'id_soal' => $getIdSoal,
                'id_topik_tes' => 5,
                'id_event' => $id_event,
                'jawaban' => $jawaban4,
                'score' => $pointJwbTkp4
            ];
            $this->db->insert('jawaban', $dataJawaban4);

            $dataJawaban5 = [
                'id_soal' => $getIdSoal,
                'id_topik_tes' => 5,
                'id_event' => $id_event,
                'jawaban' => $jawaban5,
                'score' => $pointJwbTkp5
            ];
            $this->db->insert('jawaban', $dataJawaban5);

            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12" role="alert"><strong>Satu soal berhasil ditambahkan</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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

    public function view_admin($id)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Admin';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['member'] = $this->User_model->getAdminById($id);
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/admin/view_admin', $data);
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
                'telepon' => htmlspecialchars($this->input->post('telepon', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => date_create('now')->format('Y-m-d')
            ];

            $this->User_model->insertAdmin($datauser);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12" role="alert"><strong>Satu admin berhasil dibuat</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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

            $this->load->helper('file');

            $image = $this->db->select('image')->get_where('user', ['username' => $sessionUser])->row()->image;

            if ($image != "default.png") {
                $path = './assets/img/profile/' . $image;
                unlink($path);

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
                        $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12" role="alert"><strong>Maaf gambar tidak sesuai ketentuan</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('Administrator/profile_admin');
                    }
                }
            } else {
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
                        $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12" role="alert"><strong>Maaf gambar tidak sesuai ketentuan</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('Administrator/profile_admin');
                    }
                }
            }

            $this->db->set('name', $name);
            $this->db->where('username', $username);
            $this->db->update('user');
            redirect('Administrator/profile_admin');
        }
    }

    public function tentang_saya()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Profile Saya';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|trim');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|trim');
        $this->form_validation->set_rules('keahlian', 'Keahlian', 'required|trim');
        $this->form_validation->set_rules('quotes', 'Quotes', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('Administrator/profile_admin');
        } else {
            $pendidikan = $this->input->post('pendidikan');
            $lokasi = $this->input->post('lokasi');
            $keahlian = $this->input->post('keahlian');
            $quotes = $this->input->post('quotes');

            $this->db->set('riwayat_pendidikan', $pendidikan);
            $this->db->set('lokasi', $lokasi);
            $this->db->set('keahlian', $keahlian);
            $this->db->set('quotes', $quotes);
            $this->db->where('username', $sessionUser);
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

            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-12" role="alert"><strong>Point berhasil ditambahkan</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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

    public function upload_image()
    {
        if (isset($_FILES["image"]["name"])) {
            $config['upload_path'] = './assets/soalImages/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $this->upload->display_errors();
                return false;
            } else {
                $data = $this->upload->data();

                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/soalImages' . $data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['width'] = 800;
                $config['height'] = 800;
                $config['new_image'] = './assets/soalImages' . $data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                echo base_url() . 'asserts/soalImages/' . $data['file_name'];
            }
        }
    }

    public function delete_image()
    {
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if (unlink($file_name)) {
            echo 'File berhasil dihapus';
        }
    }

    public function testimoni()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Peserta';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['testimoni'] = $this->User_model->getAllTestimoni();
        $this->load->view('Super_Admin/templates/header_admin', $data);
        $this->load->view('Super_Admin/testimoni', $data);
    }

    public function delete_testimoni($id_testi)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Daftar Peserta';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $this->db->where('id_testimoni', $id_testi)->delete('testimoni');
        redirect('Administrator/testimoni');
    }

    public function backup()
    {
        ini_set("memory_limit", "-1");
        ini_set('max_execution_time', 200);

        // Load the DB utility class
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');

        force_download('backup_database_aortastan.gz', $backup);
    }
}
