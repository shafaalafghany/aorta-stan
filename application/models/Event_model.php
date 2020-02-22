<?php

class Event_model extends CI_model
{
	public function getAllEvent()
	{
		$query = $this->db->get('event');
		return $query->result_array();
	}

	public function getEventById($id_event)
	{
		return $this->db->get_where('event', ['id_event' => $id_event])->row_array();
	}

	public function insertEvent($tampung)
	{
		return $this->db->insert('event', $tampung);
	}

	public function getHargaEvent($id_event)
	{
		return $this->db->select('harga')->get_where('event', ['id_event' => $id_event])->row()->harga;
	}

	public function deleteEvent($id)
	{
		$this->db->where('id_event', $id);
		$this->db->delete('event');
		//return $this->db->get_where('mahasiswa', ['id' => $id]);
	}
}
