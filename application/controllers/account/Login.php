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
		$email = post('email', 'required|email');
		$password = post('password', 'required');
		$response = Auth::login('users', ['email' => $email], $password);
		$response->logged_in = true;
		$this->session->set_userdata((array) $response);
		success("Welcome to our system.", $response);
	}
}
