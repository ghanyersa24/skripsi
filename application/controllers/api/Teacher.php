<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teacher extends CI_Controller
{
	protected $table = "teacher";
	public function __construct()
	{
		parent::__construct();
		// additional library
	}
	public function create()
	{
		$data = array(
			"mapel_id" => post('mapel_id', 'required|numeric'),
			"nip" => post('nip'),
			"teacher_name" => post('teacher_name', 'required'),
			"address" => post('address'),
			"phone" => post('phone', 'required|numeric'),
			"email" => post('email', 'email'),
			"last_ed" => post('last_ed', 'enum:SMA/MA&D1&D2&D3&S1/D4&S2&S3'),
		);

		$do = DB_MASTER::insert($this->table, $data);
		if (!$do->error) {
			success("data " . $this->table . " berhasil ditambahkan", $do->data);
		} else {
			error("data " . $this->table . " gagal ditambahkan");
		}
	}

	public function get($id = null)
	{
		if (is_null($id)) {
			$do = DB_MODEL::join($this->table, 'mapel');
		} else {
			$do = DB_MODEL::find($this->table, array("id" => $id));
		}

		if (!$do->error)
			success("data " . $this->table . " berhasil ditemukan", $do->data);
		else
			error("data " . $this->table . " gagal ditemukan");
	}

	public function update()
	{
		$data = array(
			"mapel_id" => post('mapel_id', 'required|numeric'),
			"nip" => post('nip'),
			"teacher_name" => post('teacher_name', 'required'),
			"address" => post('address'),
			"phone" => post('phone', 'required|numeric'),
			"email" => post('email', 'email'),
			"last_ed" => post('last_ed', 'enum:SMA/MA&D1&D2&D3&S1/D4&S2&S3'),
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
