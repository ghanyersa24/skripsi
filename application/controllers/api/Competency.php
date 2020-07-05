<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Competency extends CI_Controller
{
	protected $table = "competency";
	public function __construct()
	{
		parent::__construct();
		// additional library
	}
	public function create()
	{
		$data = array(
			"competency" => post('competency', 'required'),
			"bobot" => post('bobot', 'required|numeric'),
			"details" => post('details', 'required'),
			"role_id" => post('role_id', 'required'),
		);

		$do = DB_MASTER::insert($this->table, $data);
		if (!$do->error) {
			success("data " . $this->table . " berhasil ditambahkan", $do->data);
		} else {
			error("data " . $this->table . " gagal ditambahkan");
		}
	}

	public function get($standar)
	{
		$do = DB_MODEL::where($this->table, ['role_id' => $standar]);
		if (!$do->error)
			success("data " . $this->table . " berhasil ditemukan", $do->data);
		else
			error("data " . $this->table . " gagal ditemukan");
	}

	public function update()
	{
		$data = array(
			"competency" => post('competency', 'required'),
			"bobot" => post('bobot', 'required|numeric'),
			"details" => post('details', 'required'),
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
