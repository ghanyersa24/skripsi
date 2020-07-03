<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
	}

	public function index()
	{
		$username = post('username', 'required');
		$password = post('password', 'required');
		$response = Auth::login('users', ['username' => $username], $password);
		$response->logged_in = true;
		$this->session->set_userdata((array) $response);
		success("Welcome to our system.", $response);
	}
}
