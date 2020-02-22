<?php

class Soal_model extends CI_model
{
	// Select topik rule yang id
	public function getSoalTPAByIdEvent($id_event)
	{
		return $this->db->query("SELECT * from soal_topik st where st.id_topik = 1 and st.id_event = $id_event")->result_array();
	}
}
