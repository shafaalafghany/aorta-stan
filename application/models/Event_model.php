<?php

/**
 * 
 */
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
}


?>