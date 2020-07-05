<?php
defined('BASEPATH') or exit('No direct script access allowed');
class HISTORY
{
	public static function create($type, $title, $id, $note = "")
	{
		$CI = &get_instance();
		if ($type == 'create') {
			$data['message'] = "Menambahkan dokumen akreditasi pada $title.";
			$data['type'] = 'create';
			$data['slug'] = $note;
		} elseif ($type == 'update') {
			$data['message'] = "Pembaruan dokumen $title.";
			$data['type'] = 'update';
		} elseif ($type == 'pengajuan') {
			$data['message'] = "Mengajukan dokumen $title untuk divalidasi.";
			$data['type'] = 'pengajuan';
			$data['slug'] = $note;
		} elseif ($type == 'revisi') {
			$data['message'] = "Dokumen $title direvisi dengan catatan $note.";
			$data['type'] = 'revisi';
		} elseif ($type == 'tervalidasi') {
			$data['message'] = "Dokumen $title telah divalidasi. $note";
			$data['type'] = 'pengajuan';
		} elseif ($type == 'terdata') {
			$data['message'] = "Dokumen $title dikembalikan ke status terdata. $note";
			$data['type'] = 'pengajuan';
		} elseif ($type == 'delete') {
			$data['message'] = "Dokumen $title dihapus dari dokumen akreditasi.";
			$data['type'] = 'delete';
		}
		$data['full_name'] = $CI->session->full_name;
		$data['reference'] = $id;
		DB_MASTER::insert('history', $data);
	}
}
