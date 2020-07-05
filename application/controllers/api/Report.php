<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
	protected $table = "table";
	public function __construct()
	{
		parent::__construct();
		// additional library
	}
	public function get()
	{
		$standar = empty($this->input->get('standar')) ? null : $this->input->get('standar');
		if (is_null($standar))
			$do = DB_CUSTOM::perStandar();
		else
			$do = DB_CUSTOM::perCompetency($standar);
		if (!$do->error)
			success("data rekap berhasil ditemukan", $do->data);
		else
			error("data rekap gagal ditemukan");
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
