<?php

class Soal_model extends CI_model
{
	// Select topik rule yang id
	public function getSoalTPAByIdEvent($id_event)
	{
		return $this->db->query("SELECT * from soal s where s.id_topik_tes = 1 and s.id_event = $id_event")->result_array();
	}

	public function tambahSoal($topik, $event, $soal, $jawaban1, $jawaban2, $jawaban3, $jawaban4, $jawaban5, $jawabanBenar)
	{
		$dataSoal = [
			'id_topik_tes' => $topik,
			'id_event' => $event,
			'soal' => $soal
		];

		$this->db->insert('soal', $dataSoal);

		// $this->db->Select('id_soal')->get_where('soal', $dataSoal)->

		// $dataJawaban1 = [
		// 	'id soal' => ,
		// ];
		/*if ($jawabanBenar == $jawaban1) {
            $jawabanBenar = $jawaban1;
        } elseif ($jawabanBenar == $jawaban2) {
            $jawabanBenar = $jawaban2;
        } elseif ($jawabanBenar == $jawaban3) {
            $jawabanBenar = $jawaban3;
        } elseif ($jawabanBenar == $jawaban4) {
            $jawabanBenar = $jawaban4;
        } else {
            $jawabanBenar = $jawaban5;
        }*/
	}
}
