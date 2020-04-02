<?php

class User_model extends CI_model
{
	// semua data
	public function getAll()
	{
		$query = $this->db->get('user');
		return $query->result_array();
	}

	public function sessionUserMasuk($usernameSession)
	{
		return $this->db->get_where('user', ['username' => $usernameSession])->row_array();
	}
	// End semua data


	// Admin
	public function getAllAdmin()
	{
		return $this->db->get_where('user', ['role_id' => 2])->result_array();
	}

	public function getAdminById($id)
	{
		return $this->db->get_where('user', ['role_id' => 2, 'id' => $id])->row_array();
	}

	public function deleteAdminById($id)
	{
		$this->db->where('role_id', 2);
		$this->db->where('id', $id);
		$this->db->delete('user');
	}
	public function insertAdmin($dataAdmin)
	{
		$this->db->insert('user', $dataAdmin);
	}
	// End Admin


	// User
	public function getAllUser()
	{
		return $this->db->get_where('user', ['role_id' => 3])->result_array();
	}

	public function getUserById($id)
	{
		return $this->db->get_where('user', ['role_id' => 3, 'id' => $id])->row_array();
	}

	public function getPointUserById($id)
	{
		return $this->db->select('point')->get_where('user', ['role_id' => 3, 'id' => $id])->row()->point;
	}

	public function getPointUserByUsername($sessionUser)
	{
		$this->db->select('point')->get_where('user', ['role_id' => 3, 'username' => $sessionUser])->row()->point;
	}

	public function updatePointUserById($id, $dataPoint)
	{
		$this->db->where('id', $id);
		$this->db->update('user', $dataPoint);
	}

	public function updatePointUserByUsername($username, $dataPoint)
	{
		$this->db->where('username', $username);
		$this->db->update('user', $dataPoint);
	}

	public function deleteUserById($id)
	{
		$hasilUser = $this->db->get_where('hasil_tes', ['id_user' => $id])->result_array();
		if ($hasilUser) {
			$this->db->where('id_user', $id)->delete('hasil_tes');
		}

		$leaderboardUser = $this->db->get_where('leaderboard', ['id_user' => $id])->result_array();
		if ($leaderboardUser) {
			$this->db->where('id_user', $id)->delete('leaderboard');
		}

		$transaksiUser = $this->db->get_where('transaksi_user', ['id_user' => $id])->result_array();
		if ($transaksiUser) {
			$this->db->where('id_user', $id)->delete('transaksi_user');
		}

		$transaksiEvent = $this->db->get_where('transaksi_event', ['id_user' => $id])->result_array();
		if ($transaksiEvent) {
		$this->db->where('id_user', $id)->delete('transaksi_event');
		}
		
		$email = $this->db->select('email')->get_where('user', ['id' => $id])->row()->email;
		$userToken = $this->db->get_where('user_token', ['email' => $email])->result_array();
		if($userToken) {
		$this->db->where('email', $email)->delete('user_token');
		}

		$this->db->where('role_id', 3);
		$this->db->where('id', $id);
		$this->db->delete('user');
	}

	public function getImageUserByEmail($email)
	{
		return $this->db->select('image')->get_where('user', ['email' => $email])->row()->image;
	}

	public function getIdUserByUsername($sessionUser)
	{
		return $this->db->select('id')->get_where('user', ['username' => $sessionUser])->row()->id;
	}
	// End User

	public function getAllTestimoni()
	{
		return $this->db->get('testimoni')->result_array();
	}
}
