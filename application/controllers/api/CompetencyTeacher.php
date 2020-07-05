<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompetencyTeacher extends CI_Controller
{
	protected $table = "document";
	public function __construct()
	{
		parent::__construct();
		// additional library
	}
	public function create()
	{
		$data = array(
			"competency_id" => post('competency_id', 'required|numeric'),
			"location" => post('location', 'required'),
			"status" => 'terdata',
			"type" => 'teacher',
			"reference" => post('reference', 'required')
		);

		$do = DB_MASTER::insert($this->table, $data);
		if (!$do->error) {
			success("data " . $this->table . " berhasil ditambahkan", $do->data);
		} else {
			error("data " . $this->table . " gagal ditambahkan");
		}
	}

	public function update()
	{
		$data = array(
			"column" => post('column'),
		);

		$where = array(
			"id" => post('id', 'required'),
		);

		$do = DB_MASTER::update($this->table, $where, $data);
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
