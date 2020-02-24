<?php

class Topik_model extends CI_model
{
	public function getAllTopik()
	{
		$query = $this->db->get('topik_tes');
		return $query->result_array();
	}

	public function getFourTopik()
	{
		$query = $this->db->query("SELECT * from topik_tes limit 0, 4");
		return $query->result_array();
	}

	//TPA
	public function getTopikTPA()
	{
		return $this->db->get_where('topik_tes', ['id_topik_tes' => 1])->row_array();
	}

	public function getRuleTopikTPA()
	{
		return $this->db->query("SELECT * from rule_tes rt join topik_tes t on rt.id_rule_tes = t.id_rule where t.id_rule = 1 and t.id_topik_tes = 1")->row_array();
	}

	//TBI
	public function getTopikTBI()
	{
		return $this->db->get_where('topik_tes', ['id_topik_tes' => 2])->row_array();
	}

	public function getRuleTopikTBI()
	{
		return $this->db->query("SELECT * from rule_tes rt join topik_tes t on rt.id_rule_tes = t.id_rule where t.id_rule = 2 and t.id_topik_tes = 2")->row_array();
	}

	//SKD
	public function getTopikSKD()
	{
		return $this->db->get_where('kel_skd', ['id_skd' => 1])->row_array();
	}

	public function getKlmpkSKD()
	{
		return $this->db->get_where('topik_tes', ['id_skd' => 1])->result_array();
	}

	public function getRuleTopikSKD()
	{
		return $this->db->query("SELECT * from rule_tes rt left join topik_tes t on rt.id_rule_tes = t.id_rule where t.id_rule = 2 and t.id_topik_tes = 2")->row_array();
	}

	/*public function deleteModul($id)
	{
		$this->db->where('id_modul', $id);
		$this->db->delete('modul');
		//return $this->db->get_where('mahasiswa', ['id' => $id]);
	}*/
}
