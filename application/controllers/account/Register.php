<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
	public function index()
	{
		$data = [
			'full_name' => post('full_name', 'required'),
			'address' => post('address'),
			'phone' => post('phone', 'required|numeric'),
			'username' => post('username', 'required|max_char:30|unique:users'),
			'email' => post('email', 'required|email|unique:users'),
			'password' => password_hash(post('password', 'required'), PASSWORD_DEFAULT, array('cost' => 10)),
		];

		post('password_confirmation', 'same:password');
		$do = DB_MASTER::insert('users', $data);
		foreach ($this->input->post('access') as $value) {
			$access[] = [
				'users_id' => $do->data['id'],
				'role_id' => $value,
				'created_at' => date('Y-m-d H:i:s')
			];
		}

		if (!$do->error) {
			$do = DB_MODEL::insert_any('access', $access);
			success('data berhasil ditambahkan', $do->data);
		} else {
			error('data gagal ditambahkan');
		}
	}
}
