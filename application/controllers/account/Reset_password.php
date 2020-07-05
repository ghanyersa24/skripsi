<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reset_password extends CI_Controller
{
	public function index()
	{
		$where = array(
			"id" => $this->session->id,
		);
		post("password_confirmation", "required|same:password_new");
		$new_password = post("password_new", 'required');

		if (password_verify(post("password_old", 'required'), $this->session->password)) {
			$data = array(
				'password' => password_hash($new_password, PASSWORD_DEFAULT, array('cost' => 10))
			);
			$do = DB_MASTER::update('users', $where, $data);
			if (!$do->error) {
				success("password berhasil diubah", $do->data);
			} else {
				error("password gagal diubah");
			}
		} else
			error("password lama salah.");
	}
}
