<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	protected $table = "users";
	public function get($id = null)
	{
		if (is_null($id)) {
			$do = DB_MODEL::all($this->table);
		} else {
			$single = true;
			$do = DB_MODEL::find($this->table, array("id" => $id));
		}

		if (!$do->error) {
			if (isset($single))
				$do->data->access = DB_MODEL::where('access', ['users_id' => $id])->data;
			success("data berhasil ditemukan", $do->data);
		} else {
			error("data gagal ditemukan");
		}
	}

	public function delete()
	{
		$where = array(
			"id" => post('id', 'required')
		);

		$do = DB_MODEL::delete($this->table, $where);
		if (!$do->error) {
			success("data berhasil dihapus", $do->data);
		} else {
			error("datat gagal dihapus");
		}
	}
}
