<?php

class Soal_model extends CI_model
{
	// Select topik rule yang id
	public function getSoalTPAByIdEvent($id_event)
	{
		return $this->db->query("SELECT * from soal s where s.id_topik_tes = 1 and s.id_event = $id_event")->result_array();
	}
}
