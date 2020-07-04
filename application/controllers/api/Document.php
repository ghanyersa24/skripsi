<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{
	protected $table = "document";
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('gdrive');
	}

	public function create()
	{
		$code = $this->input->get('code');
		if ($code == null) {
			$data = array(
				"competency_id" => post('competency_id', 'required|numeric'),
				"title" => $title = post('judul', 'required'),
				"location" => post('location'),
				"year" => post('year', 'numeric'),
			);
			$drive = GDRIVE::upload('all', 'gdrive', null, post('folderName', 'required'));
			$data['name'] = $drive['name'];
			$data['link'] = $drive['url'];
			$do = DB_MODEL::insert($this->table, $data);
			if (!$do->error)
				success("data " . $this->table . " berhasil ditambahkan", $do->data);
			else
				error("data " . $this->table . " gagal ditambahkan");
		} else {
			$this->session->set_userdata('code', $code);
			echo "<script>window.close()</script>";
		}
	}
	public function get($id)
	{
		$do = DB_MODEL::join($this->table, 'competency', null, null, ['competency_id' => $id]);
		if (!$do->error)
			success("data " . $this->table . " berhasil ditemukan", $do->data);
		else
			error("data " . $this->table . " gagal ditemukan");
	}

	public function list()
	{
		success("data", GDRIVE::listDrive()->files);
	}

	public function download()
	{
		echo GDRIVE::download('ca2b3b5dfa5806accaa0ff4afe08728f.png');
	}
	public function update()
	{
		$code = $this->input->get('code');
		if ($code == null) {
			$where = array(
				"id" => post('id', 'required'),
			);
			$data = array(
				"competency_id" => post('competency_id', 'required|numeric'),
				"title" => $title = post('judul', 'required'),
				"location" => post('location'),
				"year" => post('year', 'numeric'),
			);
			if (isset($_FILES['gdrive'])) {
				$drive = GDRIVE::upload('all', 'gdrive', null, post('folderName', 'required'));
				$data['name'] = $drive['name'];
				$data['link'] = $drive['url'];
			}
			$do = DB_MODEL::update($this->table, $where, $data);
			if (!$do->error)
				success("data " . $this->table . " berhasil ditambahkan", $do->data);
			else
				error("data " . $this->table . " gagal ditambahkan");
		} else {
			$this->session->set_userdata('code', $code);
			echo "<script>window.close()</script>";
		}
	}

	public function pengajuan()
	{
		$where = array(
			"id" => post('id', 'required'),
		);

		$do = DB_MODEL::update($this->table, $where, ['status' => 'diajukan']);
		if (!$do->error)
			success("data " . $this->table . " berhasil diajukan untuk validasi", $do->data);
		else
			error("data " . $this->table . " gagal diajukan untuk validasi");
	}

	public function status()
	{
		$where = [
			"id" => post('id', 'required'),
		];
		$data = [
			'status' => $status = post('status', 'enum:revisi&tervalidasi&terdata'),
			'note' => post('note', 'max_char:255')
		];
		$do = DB_MODEL::update($this->table, $where, $data);
		if (!$do->error)
			success("data " . $this->table . " berhasil diubah menjadi status $status", $do->data);
		else
			error("data " . $this->table . " gagal diubah menjadi $status");
	}

	public function delete()
	{
		$where = array(
			"id" => post('id', 'required')
		);

		$do = DB_MODEL::delete($this->table, $where);
		if (!$do->error)
			success("data " . $this->table . " berhasil dihapus", $do->data);
		else
			error("data " . $this->table . " gagal dihapus");
	}
}
