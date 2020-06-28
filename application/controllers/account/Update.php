<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Update extends CI_Controller
{
	public function index()
	{
		$where = array(
			"id" =>  $this->session->userdata('id'),
		);
		$data = [
			'full_name' => post('full_name', 'required'),
			'address' => post('address'),
			'phone' => post('phone', 'required|numeric'),
			'email' => post('email', 'required|email'),
		];
		$do = DB_MODEL::update('users', $where, $data);
		if (!$do->error) {
			$this->session->set_userdata($data);
			success("data berhasil diubah", $do->data);
		} else {
			error("data gagal diubah");
		}
	}
}
