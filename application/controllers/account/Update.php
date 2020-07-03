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
	public function admin()
	{
		if ($this->session->status !== 'penanggung jawab')
			error('kamu tidak punya hak untuk merubah akun');

		$where = array(
			"id" => $id = post('id', 'required'),
		);
		$data = [
			'full_name' => post('full_name', 'required'),
			'address' => post('address'),
			'phone' => post('phone', 'required|numeric'),
			'email' => post('email', "required|email|update_unique:users&$id"),
			'username' => post('username', "required|update_unique:users&$id"),
			'status' => post('status', 'required|enum:tim pengembang sekolah&penanggung jawab'),
		];
		$do = DB_MODEL::update('users', $where, $data);
		foreach ($this->input->post('access') as $value) {
			$access[] = [
				'users_id' => $do->data['id'],
				'role_id' => $value,
				'created_at' => date('Y-m-d H:i:s')
			];
		}
		if (!$do->error) {
			$do = DB_MODEL::clean('access', ['users_id' => $id]);
			if (!$do->error) {
				$do = DB_MODEL::insert_any('access', $access);
				success("data berhasil diubah", $do->data);
			} else
				error("data akses gagal dihapus");
		} else {
			error("data gagal diubah");
		}
	}
}
