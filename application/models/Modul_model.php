<?php

class Modul_model extends CI_model
{
	public function getAllModul()
	{
		return $this->db->get('modul')->result_array();
	}

	public function insertModul($dataInsert)
	{
		$this->db->insert('modul', $dataInsert);
	}

	public function deleteModul($id)
	{
		$this->db->where('id_modul', $id);
		$this->db->delete('modul');
		//return $this->db->get_where('mahasiswa', ['id' => $id]);
	}
}
