<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
	public function get()
	{
		$standar = empty($this->input->get('standar')) ? null : $this->input->get('standar');
		if (is_null($standar)) {
			$do = DB_CUSTOM::perStandar();
			$perCompetency = DB_CUSTOM::perCompetency();
			$data = [
				'standar' => $do->data,
				'rekap' => $this->rekap($perCompetency->data)
			];
		} else {
			$do = DB_CUSTOM::perCompetency($standar);
			$data = $do->data;
		}
		if (!$do->error)
			success("data rekap berhasil ditemukan", $data);
		else
			error("data rekap gagal ditemukan");
	}
	private function rekap($data)
	{

		$rekap = [];
		$standar = "";
		$i = -1;
		foreach ($data as $value) {
			if ($standar != $value->STANDAR_ID) {
				$i++;
				$standar = $value->STANDAR_ID;
				$rekap[$i]['id'] = $value->STANDAR_ID;
				$rekap[$i]['standar'] = $value->STANDAR;
			}
			if (isset($rekap[$i]['totalCompetency']))
				$rekap[$i]['totalCompetency'] += 1;
			else
				$rekap[$i]['totalCompetency'] = 1;

			if ($value->TOTAL > 0) {
				if (isset($rekap[$i]['applyCompetency']))
					$rekap[$i]['applyCompetency'] += 1;
				else
					$rekap[$i]['applyCompetency'] = 1;

				if (isset($rekap[$i]['totalDocument']))
					$rekap[$i]['totalDocument'] += $value->TOTAL;
				else
					$rekap[$i]['totalDocument'] = (int) $value->TOTAL;

				if (isset($rekap[$i]['totalTerdata']))
					$rekap[$i]['totalTerdata'] += $value->TERDATA;
				else
					$rekap[$i]['totalTerdata'] = (int) $value->TERDATA;

				if (isset($rekap[$i]['totalTervalidasi']))
					$rekap[$i]['totalTervalidasi'] += $value->TERVALIDASI;
				else
					$rekap[$i]['totalTervalidasi'] = (int) $value->TERVALIDASI;

				if (isset($rekap[$i]['totalRevisi']))
					$rekap[$i]['totalRevisi'] += $value->REVISI;
				else
					$rekap[$i]['totalRevisi'] = (int) $value->REVISI;

				if (isset($rekap[$i]['totalDiajukan']))
					$rekap[$i]['totalDiajukan'] += $value->DIAJUKAN;
				else
					$rekap[$i]['totalDiajukan'] = (int) $value->DIAJUKAN;
			}


			$rekap[$i]['bobot'] = (int) $value->BOBOT_KOMPONEN;
			if (isset($rekap[$i]['perolehan']))
				$rekap[$i]['perolehan'] += (float) number_format(($value->TERVALIDASI / max($value->TOTAL, 1)) * 4, 2, '.', '');
			else
				$rekap[$i]['perolehan'] = (float) number_format(($value->TERVALIDASI / max($value->TOTAL, 1)) * 4, 2, '.', '');

			if (isset($rekap[$i]['skorMax']))
				$rekap[$i]['skorMax'] += $value->BOBOT * 4;
			else
				$rekap[$i]['skorMax'] = $value->BOBOT * 4;
		}
		$finall = $i = 0;
		foreach ($rekap as $value) {
			$temp = ($rekap[$i]['perolehan'] / $value['skorMax']) * $value['bobot'];
			$rekap[$i++]['akreditasi'] = (float) number_format($temp, 2, '.', '');
			$finall += $temp;
		}
		$finall = round($finall, 0);
		if (91 <= $finall && $finall <= 100)
			$peringkat = 'Akreditasi A (Unggul)';
		elseif (81 <= $finall && $finall <= 90)
			$peringkat = 'Akreditasi B (Baik)';
		elseif (71 <= $finall && $finall <= 80)
			$peringkat = 'Akreditasi C (Cukup)';
		elseif (61 <= $finall && $finall <= 70)
			$peringkat = 'Akreditasi D (Kurang)';
		elseif (0 <= $finall && $finall <= 60)
			$peringkat = 'Akreditasi E (Sangat Kurang)';

		return [
			'nilai_akhir' => $finall,
			'peringkat' => $peringkat,
			'rekap' => $rekap
		];
	}
}
