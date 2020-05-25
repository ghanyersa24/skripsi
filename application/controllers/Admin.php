<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// if (!$this->session->has_userdata('logged_in')) {
		// 	redirect('login');
		// }
		// $user = DB_MODEL::find('users', ['id' => $this->session->userdata('id')]);
		// if ($user->error) {
		// 	$this->session->sess_destroy();
		// 	redirect('login');
		// }
		// $this->session->set_userdata((array) $user->data);
		// $this->load->helper('riset');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['content'] = 'ap_dasboard';
		$this->load->view('template', $data);
	}

	public function profile()
	{
		$data['title'] = 'My Profile';
		$data['content'] = 'users/ap_profile';
		$this->load->view('template', $data);
	}

	public function myproduct()
	{
		$data['title'] = 'My List Product';
		$data['content'] = 'ap_myproduct';
		$this->load->view('template', $data);
	}

	public function detail()
	{
		$data['title'] = 'Roadmap Produk ';
		$data['content'] = 'ap_detail';
		$this->load->view('template', $data);
	}

	public function manage()
	{
		$data['title'] = 'Halaman Management User';
		$data['content'] = 'users/ap_users';
		$this->load->view('template', $data);
	}

	public function tambahan($slug)
	{
		$data['title'] = 'Data Tambahan ';
		$data['content'] = 'ap_tambahan';
		$this->load->view('template', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
