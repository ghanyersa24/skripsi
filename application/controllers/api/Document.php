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
				"link" => GDRIVE::upload('all', 'gdrive', $title, post('folderName', 'required')),
			);
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

	public function update()
	{
		$data = array(
			"column" => post('column'),
		);

		$where = array(
			"id" => post('id', 'required'),
		);

		$do = DB_MODEL::update($this->table, $where, $data);
		if (!$do->error)
			success("data " . $this->table . " berhasil diubah", $do->data);
		else
			error("data " . $this->table . " gagal diubah");
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
