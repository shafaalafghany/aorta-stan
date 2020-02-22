<?php

class Topik_model extends CI_model
{
	public function getAllTopik()
	{
		$query = $this->db->get('topik');
		return $query->result_array();
	}

	public function getTopikTPA()
	{
		return $this->db->get_where('topik', ['id_topik' => 1])->row_array();
	}

	/*public function deleteModul($id)
	{
		$this->db->where('id_modul', $id);
		$this->db->delete('modul');
		//return $this->db->get_where('mahasiswa', ['id' => $id]);
	}*/
}
