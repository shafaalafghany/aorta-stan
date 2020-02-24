<?php

class Soal_model extends CI_model
{
	// Select topik rule yang id
	public function getSoalTPAByIdEvent($id_event)
	{
		return $this->db->query("SELECT * from soal s where s.id_topik_tes = 1 and s.id_event = $id_event")->result_array();
	}

	public function tambahSoal($soal, $event)
	{

		$jawabanBenar = $this->input->post('jawabanBenar');
		$jawaban1 = $this->input->post('jawaban1');
		$jawaban2 = $this->input->post('jawaban2');
		$jawaban3 = $this->input->post('jawaban3');
		$jawaban4 = $this->input->post('jawaban4');
		$jawaban5 = $this->input->post('jawaban5');

		if ($jawabanBenar == $jawaban1) {
			$jawabanBenar = $jawaban1;
		} elseif ($jawabanBenar == $jawaban2) {
			$jawabanBenar = $jawaban2;
		} elseif ($jawabanBenar == $jawaban3) {
			$jawabanBenar = $jawaban3;
		} elseif ($jawabanBenar == $jawaban4) {
			$jawabanBenar = $jawaban4;
		} else {
			$jawabanBenar = $jawaban5;
		}

		$dataSoal = [
			'id_topik_tes' => $soal,
			'id_event' => $event,
			'soal' => $this->input->post('inputSoal')
		];

		$this->db->insert('soal', $dataSoal);

		// $dataJawaban1 = [
		// 	'id soal' => ,
		// ];

	}
}
