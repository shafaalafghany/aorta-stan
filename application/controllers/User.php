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

    public function topup()
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Top Up Point';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getAllEvent();

        $this->load->view('User/templates/header_topup', $data);
        $this->load->view('User/topup', $data);
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

        if($data['user']){
            $id_user = $this->db->select('id')->get_where('user', ['username' => $sessionUser])->row()->id;
            
            $data['leader'] = $this->hasil->getLeaderboardByIdAndEvent($id_user, $id_event);
        }

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
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Maaf point anda tidak mencukupi untuk ikut dalam event! Silahkan top up point dulu.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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

        redirect('User/pilih_jurusan/' . $id . '/' . $id_event);
    }

    public function pilih_jurusan($id, $id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Pilih Jurusan';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['topik_tpa'] = $this->Topik_model->getTopikTPA();
        $data['topik_rule_tpa'] = $this->Topik_model->getRuleTopikTPA();
        $data['transaksiUser'] = $this->db->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row_array();

        $id_topik = $this->Topik_model->getIdTopikTPA();
        $topik_rule = $this->Topik_model->getRuleTopikTPA();

        $this->load->view('User/templates/header_tryout', $data);
        $this->load->view('User/pilih_jurusan', $data);
        $this->load->view('User/templates/footer');
    }

    public function proses_jurusan($id, $id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tes TPA';

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $id_topik = $this->Topik_model->getIdTopikTPA();

        $id_transaksi = $this->db->select('id_transaksi')->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row()->id_transaksi;

        $jurusan1 = $this->input->post('optionJurusan1');
        $jurusan2 = $this->input->post('optionJurusan2');
        $jurusan3 = $this->input->post('optionJurusan3');

        if ($jurusan1 != "0") {
            if ($jurusan2 != "0") {
                if ($jurusan3 != "0") {
                    $dataJurusan = [
                        'jurusan1' => $jurusan1,
                        'jurusan2' => $jurusan2,
                        'jurusan3' => $jurusan3
                    ];
                } else {
                    $dataJurusan = [
                        'jurusan1' => $jurusan1,
                        'jurusan2' => $jurusan2
                    ];
                }
            } else {
                if ($jurusan3 != "0") {
                    $dataJurusan = [
                        'jurusan1' => $jurusan1,
                        'jurusan3' => $jurusan3
                    ];
                } else {
                    $dataJurusan = [
                        'jurusan1' => $jurusan1
                    ];
                }
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Pilihan pertama tidak boleh kosong!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/pilih_jurusan/' . $id . '/' . $id_event);
        }

        $this->db->where('id_transaksi', $id_transaksi)->update('transaksi_user', $dataJurusan);
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

        $hasil_tes = $this->hasil->getHasilByIdAndEvent($id, $id_event);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row_array();
        $userID = $this->User_model->getIdUserByUsername($sessionUser);
        if ($sessionUser) {
            if ($id == $userID) {
                if ($transaksi) {
                    if (count($hasil_tes) == 2) {
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
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda tidak memiliki akses untuk kesana!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/login');
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
        $userID = $this->User_model->getIdUserByUsername($sessionUser);
        if ($sessionUser) {
            if ($id == $userID) {
                if ($transaksi) {
                    if (count($hasil_tes) == 2) {
                        $data['event'] = $this->Event_model->getEventById($id_event);
                        $data['topik'] = $this->Topik_model->getTopikSKD();
                        $data['topik_rule'] = $this->Topik_model->getRuleTopikSKD();
                        $data['soal'] = $this->Soal_model->getSoalSKDbyId($id_event, $id_topik);
                        $data['soal1'] = $this->Soal_model->getSoalSKDbyIdLimit1($id_event, $id_topik);
                        $data['soal2'] = $this->Soal_model->getSoalSKDbyIdLimit2($id_event, $id_topik);
                        $data['soal3'] = $this->Soal_model->getSoalSKDbyIdLimit3($id_event, $id_topik);
                        $data['soal4'] = $this->Soal_model->getSoalSKDbyIdLimit4($id_event, $id_topik);
                        $data['soal5'] = $this->Soal_model->getSoalSKDbyIdLimit5($id_event, $id_topik);

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
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda tidak memiliki akses untuk kesana!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/login');
        }
    }

    public function tes_detail($id, $id_event, $id_topik)
    {
        $nama = $this->Topik_model->getNamaTopikById($id_topik);

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $hasil_tes = $this->hasil->getHasilByIdAndEvent($id, $id_event);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row_array();
        $userID = $this->User_model->getIdUserByUsername($sessionUser);
        if ($sessionUser) {
            if ($id == $userID) {
                if ($transaksi) {
                    if ($hasil_tes == null) {
                        if ($id_topik == 1) {
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
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda tidak memiliki akses untuk kesana!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/login');
        }
    }

    public function tes_detail_psiko($idUser, $idEvent, $idTopik)
    {
        $nama = $this->Topik_model->getNamaTopikById($idTopik);

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $hasil_tes = $this->hasil->getHasilByIdAndEvent($idUser, $idTopik);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $idUser,
            'id_event' => $idEvent
        ])->row_array();
        $userID = $this->User_model->getIdUserByUsername($sessionUser);
        $leaderboard = $this->hasil->getLeaderboardByIdAndEvent($idUser, $idEvent);

        if ($sessionUser) {
            if ($idUser == $userID) {
                if ($transaksi) {
                    if ($leaderboard) {
                        if ($leaderboard['nilai_psikotes'] == null) {
                            $data['event'] = $this->Event_model->getEventById($idEvent);
                            $data['topik'] = $this->Topik_model->getTopikById($idTopik);
                            $data['topik_rule'] = $this->Topik_model->getRuleTopikById($idTopik);
                            $data['topik_skd'] = $this->Topik_model->getTopikSKD();

                            $data['judul'] = 'AORTASTAN Try Out Online | ' . $nama;

                            $this->load->view('User/templates/header_tes', $data);
                            $this->load->view('User/tes_psiko_detail', $data);
                            $this->load->view('User/templates/footer_tes');
                        } else{
                            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda sudah melakukan tes tersebut</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            redirect('User/tryout');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Selesaikan dulu seluruh tes sebelumnya!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('User/tryout');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum terdaftar di event ini!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('User/tryout');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda tidak memiliki akses untuk kesana!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/login');
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
        $userID = $this->User_model->getIdUserByUsername($sessionUser);
        if ($sessionUser) {
            if ($id == $userID) {
                if ($transaksi) {
                    if ($hasil_tes == null) {
                        if ($id_topik == 1) {
                            $data['event'] = $this->Event_model->getEventById($id_event);
                            $data['topik'] = $this->Topik_model->getTopikById($id_topik);
                            $data['topik_rule'] = $this->Topik_model->getRuleTopikById($id_topik);
                            $data['soal'] = $this->Soal_model->getSoalById($id_event, $id_topik);
                            $data['soal1'] = $this->Soal_model->getSoalByIdLimit1($id_event, $id_topik);
                            $data['soal2'] = $this->Soal_model->getSoalByIdLimit2($id_event, $id_topik);
                            $data['soal3'] = $this->Soal_model->getSoalByIdLimit3($id_event, $id_topik);

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
                            $data['soal1'] = $this->Soal_model->getSoalByIdLimit1($id_event, $id_topik);

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
                            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda sudah melakukan tes tersebut!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda tidak memiliki akses untuk kesana!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/login');
        }
    }

    public function kerjakan_tes_psiko($idUser, $idEvent, $idTopik)
    {
        $nama = $this->Topik_model->getNamaTopikById($idTopik);

        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);

        $hasil_tes_topik = $this->hasil->getHasilByIdEventTopik($id, $id_event, $id_topik);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $idUser,
            'id_event' => $idEvent
        ])->row_array();
        $userID = $this->User_model->getIdUserByUsername($sessionUser);
        $leaderboard = $this->hasil->getLeaderboardByIdAndEvent($idUser, $idEvent);

        if ($sessionUser) {
            if ($idUser == $userID) {
                if ($transaksi) {
                    if ($leaderboard) {
                        if ($hasil_tes_topik) {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda sudah melakukan tes tersebut!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            redirect('User/tryout');
                        } else {
                            if ($leaderboard['nilai_psikotes'] == null) {
                                $data['event'] = $this->Event_model->getEventById($idEvent);
                                $data['topik'] = $this->Topik_model->getTopikById($idTopik);
                                $data['topik_rule'] = $this->Topik_model->getRuleTopikById($idTopik);
                                $data['soal'] = $this->Soal_model->getSoalById($idEvent, $idTopik);
                                $data['soal1'] = $this->Soal_model->getSoalByIdLimit1($idEvent, $idTopik);
                                $data['soal2'] = $this->Soal_model->getSoalByIdLimit2($idEvent, $idTopik);
                                $data['soal3'] = $this->Soal_model->getSoalByIdLimit3($idEvent, $idTopik);
                                $data['soal4'] = $this->Soal_model->getSoalByIdLimit3($idEvent, $idTopik);
                                $data['soal5'] = $this->Soal_model->getSoalByIdLimit3($idEvent, $idTopik);

                                $waktudaftar = time();

                                $dataTransaksi = [
                                    'id_topik' => $idTopik,
                                    'id_event' => $idEvent,
                                    'id_user' => $idUser,
                                    'waktu_daftar' => $waktudaftar
                                ];
                                $this->Kerjakan_model->sessionKerjakan($dataTransaksi);

                                $this->session->unset_userdata('id_event');
                                $this->session->unset_userdata('id_topik');
                                $this->session->unset_userdata('id_user');
                                $this->session->unset_userdata('waktu_daftar');

                                $data['transaksi'] = $this->Kerjakan_model->getKerjakan($idEvent, $idTopik, $idUser);

                                $this->load->view('User/templates/header_tes', $data);
                                $this->load->view('User/tes/kerjakan_psikotes', $data);
                                $this->load->view('User/templates/footer_tes');
                            } else {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda sudah melakukan tes tersebut!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                                redirect('User/tryout');
                            }
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Selesaikan dulu seluruh tes sebelumnya!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('User/tryout');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum terdaftar di event ini!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('User/tryout');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda tidak memiliki akses untuk kesana!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/login');
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
        return true;
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
        $hasil_tes_topik = $this->hasil->getHasilByIdEventTopik($id, $id_event, $id_topik);

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

        if($hasil_tes_topik){
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda sudah melakukan tes tersebut</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/event/' . $id_event);
        } else{
            $this->hasil->insertHasil($dataHasil);

            $this->Kerjakan_model->hapuscache($id, $id_topik, $id_event);
    
            if ($id_topik == 6) {
                redirect('User/hasil_tes_psiko/' . $id . '/' . $id_event . '/' . $id_topik);
            } else {
                redirect('User/hasil_tes/' . $id . '/' . $id_event . '/' . $id_topik);
            }
        }
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
        $userID = $this->User_model->getIdUserByUsername($sessionUser);
        if ($sessionUser) {
            if ($id == $userID) {
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
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda tidak memiliki akses untuk kesana!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/login');
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
        $userID = $this->User_model->getIdUserByUsername($sessionUser);
        if ($sessionUser) {
            if ($id == $userID) {
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
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda tidak memiliki akses untuk kesana!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/login');
        }
    }

    public function hasil_tes_psiko($idUser, $idEvent, $idTopik)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Tes Psikotes';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $hasil_tes = $this->hasil->getHasilByIdEventTopik($idUser, $idEvent, $idTopik);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $idUser,
            'id_event' => $idEvent
        ])->row_array();
        $userID = $this->User_model->getIdUserByUsername($sessionUser);
        $leaderboard = $this->hasil->getLeaderboardByIdAndEvent($idUser, $idEvent);

        if ($sessionUser) {
            if ($idUser == $userID) {
                if ($transaksi) {
                    if ($leaderboard) {
                        if ($hasil_tes) {
                            if ($idTopik == 6) {
                                $data['event'] = $this->Event_model->getEventById($idEvent);
                                $data['topik'] = $this->Topik_model->getTopikById($idTopik);
                                $data['topik_rule'] = $this->Topik_model->getRuleTopikById($idTopik);
                                $data['hasil'] = $this->hasil->getHasil($idUser, $idEvent, $idTopik);
                                $data['hasilSemuaTes'] = $this->hasil->getHasilByIdAndEvent($idUser, $idEvent);

                                $this->load->view('User/templates/header_tes', $data);
                                $this->load->view('User/hasil_tes_psiko', $data);
                                $this->load->view('User/templates/footer_tes');
                            } else {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Halaman tidak ditemukan</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                                redirect('User/tryout');
                            }
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Selesaikan tes psiko dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            redirect('User/tryout');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Selesaikan tes-tes sebelumnya dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('User/tryout');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum terdaftar di event ini!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('User/tryout');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda tidak memiliki akses untuk kesana!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/login');
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
        $data['modul'] = $this->Modul_model->getAllModul();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('User/templates/header_profile', $data);
            $this->load->view('User/profile_saya', $data);
            $this->load->view('User/templates/footer');
        } else {
            $name = $this->input->post('name');
            $tentang = $this->input->post('tentang');
            $username = $this->input->post('username');

            $this->load->helper('file');

            $image = $this->db->select('image')->get_where('user', ['username' => $username])->row()->image;

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
                        $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-10" style="margin-left: 8%;" role="alert"><strong>Maaf gambar tidak sesuai ketentuan</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('User/profile_saya');
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
                        $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-10" style="margin-left: 8%;" role="alert"><strong>Maaf gambar tidak sesuai ketentuan</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('User/profile_saya');
                    }
                }
            }

            $tampung = array(
                'name' => $name,
                'tentang' => $tentang
            );
            $this->db->where('username', $username);
            $this->db->update('user', $tampung);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-md-10" style="margin-left: 8%;" role="alert"><strong>Perubahan profile berhasil disimpan</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($this->uri->uri_string());
        }
    }

    public function reward_tes($id_leaderboard)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Analisis Jurusan';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $jurusan = $this->hasil->getFileJurusanByIdLeader($id_leaderboard);
        $data['leader'] = $this->db->get_where('leaderboard', [
            'id_leaderboard' => $id_leaderboard
        ])->row_array();

        $this->load->view('User/templates/header_tryout', $data);
        $this->load->view('User/reward_tes');
        $this->load->view('User/templates/footer');
    }

    public function openModul($id_modul)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Modul';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $modul = $this->Modul_model->getModulById($id_modul);

        $tofile = realpath("assets/file/" . $modul);
        header('Content-Type: application/pdf');
        readfile($tofile);
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
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf akun belum terdaftar!</div>');
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
            'is_unique' => 'Username sudah terdaftar'

        ]);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim|numeric');
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
                'telepon' => htmlspecialchars($this->input->post('telepon', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'tentang' => 'Aku adalah seorang pejuang !',
                'role_id' => 3,
                'is_active' => 0,
                'date_created' => date_create('now')->format('Y-m-d')
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

            $result = $this->_sendEmail($token, 'verify');

            if ($result) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat! Silahkan cek email anda untuk verifikasi akun <b>dalam 24 jam</b>. Jika tidak ada pada inbox anda coba cek pada spam.</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat! Silahkan cek email anda untuk verifikasi akun. Jika tidak ada pada inbox anda coba cek pada spam. Jika dalam 1 jam tidak ada email verifikasi akun silahkan kontak admin dengan menyertakan email anda.</div>');
            }

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
        $config['smtp_crypto'] = 'ssl';
        $config['smtp_host'] = 'sylveon.rapidplex.com';
        $config['smtp_user'] = 'admin@aortastan.com';
        $config['smtp_pass'] = 'AortaStan123';
        $config['smtp_port'] = 465;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('admin@aortastan.com', 'Aortastan.com');
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
            // echo $this->email->print_debugger();
            // die;
            return false;
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
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Email ' . $email . ' telah aktif! Silahkan login</div>');
                    redirect('User/login');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf aktifasi akun gagal! Token user kadaluarsa. Silahkan daftarkan kembali akun anda.</div>');
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

    public function proses_leader($id, $id_event)
    {
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row_array();
        $hasil_tes_psiko = $this->hasil->getHasilByIdEventTopik($id, $id_event, 6);
        
        if($transaksi){
            if ($hasil_tes_psiko) {
                $psiko = $this->hasil->getHasilPsikoByIdAndEvent($id, $id_event);
                $dataPsiko = [
                    'nilai_psikotes' => $psiko
                ];
                $nilai_psiko = $this->db->select('nilai_psikotes')->get_where('leaderboard', [
                    'id_user' => $id,
                    'id_event' => $id_event
                ])->row()->nilai_psikotes;
                if ($nilai_psiko == null) {
                    $this->db->set($dataPsiko);
                    $this->db->where('id_user', $id);
                    $this->db->where('id_event', $id_event);
                    $this->db->update('leaderboard');
                }
            }
            $tpa = $this->hasil->getHasilTpaByIdAndEvent($id, $id_event);
            $tbi = $this->hasil->getHasilTbiByIdAndEvent($id, $id_event);
            $twk = $this->hasil->getHasilTwkByIdAndEvent($id, $id_event);
            $tiu = $this->hasil->getHasilTiuByIdAndEvent($id, $id_event);
            $tkp = $this->hasil->getHasilTkpByIdAndEvent($id, $id_event);
            
            if($tpa == null){
                $tpa = 0;
            }
            
            if($tbi == null){
                $tbi = 0;
            }
            
            if($twk == null){
                $twk = 0;
            }
            
            if($tiu == null){
                $tiu = 0;
            }
            
            if($tkp == null){
                $tkp = 0;
            }
            
            $skd = $twk + $tiu + $tkp;
            $total = $tpa + $tbi + $skd;
    
            $status = "";
            if ($tpa >= 67 && $tbi >= 30 && $twk >= 65 && $tiu >= 80 && $tkp >= 126 && $skd >= 271) {
                $status = "LULUS";
            } else {
                $status = "TIDAK LULUS";
            }
    
            $dataLeader = [
                'id_user' => $id,
                'id_event' => $id_event,
                'nilai_tpa' => $tpa,
                'nilai_tbi' => $tbi,
                'nilai_twk' => $twk,
                'nilai_tiu' => $tiu,
                'nilai_tkp' => $tkp,
                'nilai_skd' => $skd,
                'nilai_total' => $total,
                'status' => $status
            ];
            $this->hasil->insertLeader($dataLeader);
                
            $getEventJawaban = $this->db->get_where('event_jawaban', [
                'id_user' => $id,
                'id_event' => $id_event
            ])->result_array();
            
            if($getEventJawaban){
                $this->db->where('id_user', $id);
                $this->db->where('id_event', $id_event);
                $this->db->delete('event_jawaban');
            }
    
            redirect('User/leaderboard/' . $id . '/' . $id_event);   
        } else {
            redirect('User/leaderboard/' . $id . '/' . $id_event);
        }
    }
    
    public function open_pembahasan($id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Pembahasan';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $pmbhsnName = $this->db->select('pembahasan')->get_where('event', ['id_event' => $id_event])->row()->pembahasan;

        $tofile = realpath("assets/filePembahasan/" . $pmbhsnName);
        header('Content-Type: application/pdf');
        readfile($tofile);
    }

    public function leaderboard($id, $id_event)
    {
        $data['judul'] = 'AORTASTAN Try Out Online | Leaderboard';
        $sessionUser = $this->session->userdata('username');
        $data['user'] = $this->User_model->sessionUserMasuk($sessionUser);
        $data['leader'] = $this->hasil->getLeaderboardByEvent($id_event);
        $data['event'] = $this->Event_model->getEventById($id_event);
        $data['hasilUser'] = $this->hasil->getLeaderboardByIdAndEvent($id, $id_event);
        $hasil_tes = $this->hasil->getHasilByIdAndEvent($id, $id_event);
        $transaksi = $this->db->get_where('transaksi_user', [
            'id_user' => $id,
            'id_event' => $id_event
        ])->row_array();
        $cekMulai = $this->db->select('tgl_mulai')->get_where('event', ['id_event' => $id_event])->row()->tgl_mulai;
        $cekAkhir = $this->db->select('tgl_akhir')->get_where('event', ['id_event' => $id_event])->row()->tgl_akhir;
        $waktuSekarang = date("Y-m-d");
        $leaderEvent = $this->hasil->getLeaderboardByIdAndEvent($id, $id_event);
        $userID = $this->User_model->getIdUserByUsername($sessionUser);
        $data['soalPsiko'] = $this->Soal_model->getSoalPsikoByEvent($id_event);
        if ($sessionUser) {
            if ($id == $userID) {
                if ($transaksi) {
                    if($leaderEvent){
                        $this->load->view('User/templates/header_tryout', $data);
                        $this->load->view('User/leaderboard');
                        $this->load->view('User/templates/footer');
                    } else{
                        if (count($hasil_tes) == 5) {
                            $this->load->view('User/templates/header_tryout', $data);
                            $this->load->view('User/leaderboard');
                            $this->load->view('User/templates/footer');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Selesaikan tes TPA, TBI, dan SKD terlebih dahulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            redirect('User/tryout');
                        }
                    }
                } else {
                    if($cekAkhir<=$waktuSekarang){
                        $this->load->view('User/templates/header_tryout', $data);
                        $this->load->view('User/leaderboard');
                        $this->load->view('User/templates/footer');
                    } else{
                        $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda belum terdaftar dalam event ini!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        redirect('User/tryout');   
                    }
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Anda tidak memiliki akses untuk kesana!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('User/tryout');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-md-12 text-center" role="alert"><strong>Silahkan login dulu!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/login');
        }
    }
}
