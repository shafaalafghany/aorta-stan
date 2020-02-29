<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kerjakan_model extends CI_Model
{

    /* PENGERJAAN SOAL */
    public function jawabsoal($dataJawaban)
    {
        $this->db->select('*'); //skip ini jika mau select spesifik
        $this->db->from('event_jawaban');
        $this->db->where('id_soal', $dataJawaban['id_soal']);
        $this->db->where('id_event', $dataJawaban['id_event']);
        $this->db->where('id_user', $dataJawaban['id_user']);
        $this->db->where('id_topik', $dataJawaban['id_topik']);
        $query = $this->db->get();
        $cekjawab = $query->row_array();
        if ($cekjawab > 0) {
            $this->db->where('id_soal', $dataJawaban['id_soal']);
            $this->db->update('event_jawaban', ['id_jawaban' => $dataJawaban['id_jawaban']]);
        } else {
            $this->db->insert('event_jawaban', $dataJawaban);
        }
    }

    public function hapusjawabsoal($data)
    {
        $this->db->where('soal_id', $data['soal_id']);
        $this->db->where('event_id', $data['event_id']);
        $this->db->where('peserta_id', $data['peserta_id']);
        $this->db->delete('event_jawaban');
    }

    public function koreksi($id, $id_event, $id_topik)
    {
        $query = $this->db->query("SELECT j.score, ej.id_soal, ej.id_jawaban from event_jawaban ej left join jawaban j on ej.id_jawaban = j.id_jawaban where ej.id_user = $id and ej.id_event = $id_event and ej.id_topik = $id_topik");
        return $query->result_array();
    }

    public function hapuscache($id, $id_topik, $id_event)
    {
        $this->db->where('id_event', $id_event);
        $this->db->where('id_user', $id);
        $this->db->where('id_topik', $id_topik);
        $this->db->delete('event_jawaban');
    }

    public function sessionKerjakan($data)
    {
        return $this->db->insert('transaksi_event', $data);
    }

    public function getSessionKerjakan($data)
    {
        return $this->db->get_where('transaksi_event', $data)->row_array();
    }

    public function getKerjakan($id_event, $id_topik, $id)
    {
        return $this->db->get_where('transaksi_event', [
            'id_event' => $id_event,
            'id_topik' => $id_topik,
            'id_user' => $id
        ])->row_array();
    }
}
