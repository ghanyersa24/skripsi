<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TEST extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('gdrive');
		if ($this->session->logged_in) {
			redirect('admin');
		}
	}
	public function index()
	{

		$this->load->helper(array('form', 'url'));
		$data = array(
			'title' => 'GDRIVE TEST'
		);
		$this->load->view('content/ap_gdrive', $data);
	}
	public function post()
	{
		success("success upload", GDRIVE::upload('all', 'hayo', 'nama file'));
	}

	public function delete()
	{
		success("success upload", GDRIVE::delete());
	}
}
