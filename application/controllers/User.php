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
        $this->load->model('Hasil_tes_model', 'hasil');
    }


    public function index()
    {

        $data['judul'] = 'AORTASTAN Try Out Online';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getAllEvent();
        $data['modul'] = $this->Modul_model->getAllModul();
        $data['testimoni'] = $this->Modul_model->getTestimoni();

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

        $tgl_transaksi = date_create('now')->format('Y-m-d H:i:s');

        $dataTransaksiUser = [
            'id_user' => $id,
            'id_event' => $id_event,
            'tgl_transaksi' => $tgl_transaksi
        ];
        $this->db->insert('transaksi_user', $dataTransaksiUser);

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
        $hasil_tes = $this->hasil->getHasilByIdAndEvent($id, $id_event);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row_array();
        if ($transaksi) {
            if (count($hasil_tes) == 2) {
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
            } elseif (count($hasil_tes) < 2) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Selesaikan dulu tes TPA dan TBI</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda sudah melakukan tes ini</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum terdaftar di event ini!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/tryout');
        }
    }

    public function kerjakan_skd($id, $id_event, $id_topik)
    {
        $nama = $this->Topik_model->getNamaTopikById($id_topik);
        $data['judul'] = 'AORTASTAN Try Out Online | ' . $nama;
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $hasil_tes = $this->hasil->getHasilByIdAndEvent($id, $id_event);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row_array();
        if ($transaksi) {
            if (count($hasil_tes) == 2) {
                $data['event'] = $this->Event_model->getEventById($id_event);
                $data['topik'] = $this->Topik_model->getTopikSKD();
                $data['topik_rule'] = $this->Topik_model->getRuleTopikSKD();
                $data['soal'] = $this->Soal_model->getSoalSKDbyId($id_event, $id_topik);

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
                $this->load->view('User/tes/kerjakan_skd', $data);
                $this->load->view('User/templates/footer_tes');
            } elseif (count($hasil_tes) < 2) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Selesaikan dulu tes TPA dan TBI</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda sudah melakukan tes ini</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum terdaftar di event ini!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/tryout');
        }
    }

    public function tes_detail($id, $id_event, $id_topik)
    {
        $hasil_tes = $this->hasil->getHasilByIdAndEvent($id, $id_event);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row_array();
        if ($transaksi) {
            if ($hasil_tes == null) {
                if ($id_topik == 1) {
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
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Selesaikan dulu tes TPA!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('User/tryout');
                };
            } elseif (count($hasil_tes) == 1) {
                if ($id_topik == 2) {
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
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Selesaikan dulu tes TBI!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('User/tryout');
                };
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda sudah melakukan tes tersebut!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum terdaftar di event ini!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/tryout');
        }
    }

    public function kerjakan_tes($id, $id_event, $id_topik)
    {
        $nama = $this->Topik_model->getNamaTopikById($id_topik);
        $data['judul'] = 'AORTASTAN Try Out Online | ' . $nama;
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $hasil_tes = $this->hasil->getHasilByIdAndEvent($id, $id_event);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row_array();
        if ($transaksi) {
            if ($hasil_tes == null) {
                if ($id_topik == 1) {
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
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Selesaikan dulu tes TPA!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('User/tryout');
                };
            } elseif (count($hasil_tes) == 1) {
                if ($id_topik == 2) {
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
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Selesaikan dulu tes TBI!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('User/tryout');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda sudah melakukan tes tersebut!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum terdaftar di event ini!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/tryout');
        }
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

    public function ragu()
    {
        $this->load->model('Kerjakan_model', 'kerjakan');
        $klikRagu = $_POST;
        $dataRagu = [
            'id_user' => $klikRagu['idp'],
            'id_topik' => $klikRagu['topik'],
            'id_event' => $klikRagu['eve'],
            'id_soal' => $klikRagu['soal'],
            'btn_ragu' => $klikRagu['ragu']
        ];
        $this->kerjakan->klikragu($dataRagu);
    }

    public function testimoni()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Testimoni';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['testimoni'] = $this->Modul_model->getTestimoni();

        $this->form_validation->set_rules('inputSubjek', 'InputSubjek', 'required|trim');
        $this->form_validation->set_rules('inputPesan', 'InputPesan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('User/templates/header_testimoni', $data);
            $this->load->view('User/testimoni');
            $this->load->view('User/templates/footer');
        } else {
            $nama = $this->input->post('name');
            $email = $this->input->post('inputEmail');
            $subjek = $this->input->post('inputSubjek');
            $pesan = $this->input->post('inputPesan');
            $tgl = time();
            $image = $this->User_model->getImageUserByEmail($email);

            $dataTestimoni = [
                'nama_user' => $nama,
                'email_user' => $email,
                'subjek' => $subjek,
                'pesan' => $pesan,
                'date_create' => $tgl,
                'image' => $image
            ];

            $this->db->insert('testimoni', $dataTestimoni);
            redirect('User/testimoni');
        }
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

        $this->hasil->insertHasil($dataHasil);

        $this->Kerjakan_model->hapuscache($id, $id_topik, $id_event);

        redirect('User/hasil_tes/' . $id . '/' . $id_event . '/' . $id_topik);
    }

    public function koreksi_skd($id, $id_event, $id_topik)
    {
        $jawabanTwk = $this->Kerjakan_model->koreksiTwk($id, $id_event);
        $jawabanTiu = $this->Kerjakan_model->koreksiTiu($id, $id_event);
        $jawabanTkp = $this->Kerjakan_model->koreksiTkp($id, $id_event);



        $total_benar_twk = 0;
        foreach ($jawabanTwk as $jawabTwk) {
            $total_benar_twk = $total_benar_twk + $jawabTwk['score'];
        }
        $dataHasilTwk = [
            'id_topik' => 3,
            'id_event' => $id_event,
            'id_user' => $id,
            'hasil' => $total_benar_twk
        ];
        $this->hasil->insertHasil($dataHasilTwk);
        $this->Kerjakan_model->hapuscachetwk($id, $id_event);



        $total_benar_tiu = 0;
        foreach ($jawabanTiu as $jawabTiu) {
            $total_benar_tiu = $total_benar_tiu + $jawabTiu['score'];
        }
        $dataHasilTiu = [
            'id_topik' => 4,
            'id_event' => $id_event,
            'id_user' => $id,
            'hasil' => $total_benar_tiu
        ];

        $this->hasil->insertHasil($dataHasilTiu);
        $this->Kerjakan_model->hapuscachetiu($id, $id_event);



        $total_benar_tkp = 0;
        foreach ($jawabanTkp as $jawabTkp) {
            $total_benar_tkp = $total_benar_tkp + $jawabTkp['score'];
        }
        $dataHasilTiu = [
            'id_topik' => 5,
            'id_event' => $id_event,
            'id_user' => $id,
            'hasil' => $total_benar_tkp
        ];
        $this->hasil->insertHasil($dataHasilTiu);
        $this->Kerjakan_model->hapuscachetkp($id, $id_event);

        redirect('User/hasil_skd/' . $id . '/' . $id_event . '/' . $id_topik);
    }

    public function hasil_tes($id, $id_event, $id_topik)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tes TPA';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $hasil_tes = $this->hasil->getHasilByIdAndEvent($id, $id_event);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row_array();
        if ($transaksi) {
            if ($hasil_tes > 0) {
                if ($id_topik > 0 && $id_topik <= 2) {
                    $data['event'] = $this->Event_model->getEventById($id_event);
                    $data['topik'] = $this->Topik_model->getTopikById($id_topik);
                    $data['topik_rule'] = $this->Topik_model->getRuleTopikById($id_topik);
                    $data['hasil'] = $this->hasil->getHasil($id, $id_event, $id_topik);
                    $data['hasilSemuaTes'] = $this->hasil->getHasilByIdAndEvent($id, $id_event);

                    $this->load->view('User/templates/header_tes', $data);
                    $this->load->view('User/hasil_tes', $data);
                    $this->load->view('User/templates/footer_tes');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Halaman tidak ditemukan</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('User/tryout');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum memiliki hasil pada tes tersebut</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum terdaftar di event ini!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/tryout');
        }
    }

    public function hasil_skd($id, $id_event, $id_topik)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tes TPA';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $hasil_tes = $this->hasil->getHasilByIdAndEvent($id, $id_event);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row_array();
        if ($transaksi) {
            if ($hasil_tes >= 3) {
                if ($id_topik == 3) {
                    $data['event'] = $this->Event_model->getEventById($id_event);
                    $data['topik_twk'] = $this->Topik_model->getTwk();
                    $data['topik_rule_twk'] = $this->Topik_model->getRuleTwk();
                    $data['topik_tiu'] = $this->Topik_model->getTiu();
                    $data['topik_rule_tiu'] = $this->Topik_model->getRuleTiu();
                    $data['topik_tkp'] = $this->Topik_model->getTkp();
                    $data['topik_rule_tkp'] = $this->Topik_model->getRuleTkp();
                    $data['topik_skd'] = $this->Topik_model->getTopikSKD();
                    $data['topik_rule_skd'] = $this->Topik_model->getRuleTopikSKD();
                    $data['hasil_twk'] = $this->hasil->getHasil($id, $id_event, 3);
                    $data['hasil_tiu'] = $this->hasil->getHasil($id, $id_event, 4);
                    $data['hasil_tkp'] = $this->hasil->getHasil($id, $id_event, 5);

                    $this->load->view('User/templates/header_tes', $data);
                    $this->load->view('User/hasil_tes_skd', $data);
                    $this->load->view('User/templates/footer_tes');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Halaman tidak ditemukan!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('User/tryout');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum mengikuti tes SKD</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum terdaftar di event ini!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/tryout');
        }
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
        $id_user = $this->User_model->getIdUserByUsername($sessionUser);
        $data['transaksi'] = $this->db->get_where('transaksi_user', ['id_user' => $id_user])->result_array();

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
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf ganti password gagal! Token user salah.</div>');
                redirect('User/login');
            }
        } else {
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
        } else {
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
