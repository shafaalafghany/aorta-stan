<?php

class Hasil_tes_model extends CI_Model
{
    public function insertHasil($dataHasil)
    {
        return $this->db->insert('hasil_tes', $dataHasil);
    }

    public function getHasil($id, $id_event, $id_topik)
    {
    	return $this->db->get_where('hasil_tes', [
    		'id_user' => $id,
    		'id_event' => $id_event,
    		'id_topik' => $id_topik
    	])->row_array();
    }
}
