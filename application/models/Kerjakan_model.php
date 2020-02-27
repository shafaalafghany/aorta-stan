<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kerjakan_model extends CI_Model
{

    /* PENGERJAAN SOAL */
    public function jawabsoal($data)
    {
        $this->db->select('*'); //skip ini jika mau select spesifik
        $this->db->from('event_jawaban');
        $this->db->where('id_soal', $data['id_soal']);
        $this->db->where('id_event', $data['id_event']);
        $this->db->where('id_user', $data['id_user']);
        $this->db->where('id_topik', $data['id_topik']);
        $query = $this->db->get();
        $cekjawab = $query->row_array();
        if ($cekjawab > 0) {
            $this->db->where('soal_id', $data['soal_id']);
            $this->db->update('event_jawaban', ['jawaban_id' => $data['jawaban_id']]);
        } else {
            $this->db->insert('event_jawaban', $data);
        }
    }

    public function hapusjawabsoal($data)
    {
        $this->db->where('soal_id', $data['soal_id']);
        $this->db->where('event_id', $data['event_id']);
        $this->db->where('peserta_id', $data['peserta_id']);
        $this->db->delete('event_jawaban');
    }

    public function koreksi($token)
    {
        $this->db->select(['peserta.event_id', 'peserta.id', 'soal_jawaban.poin', 'soal_jawaban.status']); //skip ini jika mau select spesifik
        $this->db->from('peserta');
        $this->db->join('event_jawaban', 'event_jawaban.peserta_id=peserta.id', 'left');
        $this->db->join('soal_jawaban', 'soal_jawaban.id=event_jawaban.jawaban_id', 'left');
        $this->db->where('peserta.token', $token);
        $this->db->where('soal_jawaban.poin !=', NULL);
        $this->db->where('soal_jawaban.status !=', NULL);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function hapuscache($event_id, $peserta_id)
    {
        $this->db->where('event_id', $event_id);
        $this->db->where('peserta_id', $peserta_id);
        $this->db->delete('event_jawaban');
    }

    public function sessionKerjakan($data)
    {
        return $this->db->insert('transaksi_event', $data);
    }

    public function getSessionKerjakan($data)
    {
        $this->db->get_where('transaksi_event', $data);
        return $this->db->affected_rows();
    }
}
