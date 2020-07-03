<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Drive extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('gdrive');
	}
	public function index()
	{

		$this->load->helper(array('form', 'url'));
		$data = array(
			'title' => 'GDRIVE TEST'
		);
		$this->load->view('content/ap_gdrive', $data);
	}
	public function create()
	{
		success("File Berhasil upload ke google drive", GDRIVE::upload('all', 'gdrive', 'asdasd'));
	}

	public function delete()
	{
		success("success upload", GDRIVE::delete());
	}
}
