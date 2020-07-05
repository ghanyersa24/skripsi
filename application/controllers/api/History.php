<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{
	protected $table = "history";
	public function __construct()
	{
		parent::__construct();
		// additional library
	}

	public function get($id = null)
	{
		if (is_null($id))
			$do = DB_MODEL::where($this->table, "type = 'pengajuan' OR type = 'create'");
		else
			$do = DB_MODEL::where($this->table, "type = 'pengajuan' OR type = 'create' AND reference = $id");
		if (!$do->error)
			success("data " . $this->table . " berhasil ditemukan", $do->data);
		else
			error("data " . $this->table . " gagal ditemukan");
	}
}
