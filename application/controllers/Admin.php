<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	protected $access = [];
	function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('logged_in')) {
			redirect('login');
		}
		$do = DB_MODEL::join('access', 'role', null, 'right', ['access.users_id' => $this->session->userdata('id')], 'access.role_id , role.role');
		if (count($do->data) < 1) {
			$this->session->sess_destroy();
			redirect('login');
		}
		$this->access = $do->data;
		$this->session->set_userdata(['access' => (array) $do->data]);
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['content'] = 'ap_dasboard';
		$this->load->view('template', $data);
	}

	public function akreditasi($standar, $competency = null)
	{
		$standar = str_replace('standar-', '', $standar);
		$find = false;
		foreach ($this->access as $key => $value) {
			if ($value->role_id ==  $standar)
				$find = true;
		}
		if ($find) {
			$data['title'] = 'Detail Standar ' . $standar;
			$data['content'] = 'ap_competency';
			$data['standar'] = $standar;
			if (!is_null($competency))
				$this->competency($standar, $competency);
			else
				$this->load->view('template', $data);
		} else
			redirect('admin');
	}

	private function competency($standar, $competency)
	{
		$kompetensi = str_replace('kompetensi-', '', $competency);
		$do = DB_MODEL::find('competency', ['role_id' => $standar, 'id' => $kompetensi]);
		if (!$do->error) {
			$data['title'] = "Detail Kompetensi $kompetensi";
			$data['content'] = 'ap_detail';
			$data['standar'] = $standar;
			$data['competency'] = $kompetensi;
			$this->load->view('template', $data);
		} else
			redirect('admin/akreditasi/standar-' . $standar);
	}

	public function profile()
	{
		$data['title'] = 'My Profile';
		$data['content'] = 'users/ap_profile';
		$this->load->view('template', $data);
	}

	public function mapel()
	{
		$data['title'] = 'Mata Pelajaran';
		$data['content'] = 'ap_mapel';
		$this->load->view('template', $data);
	}

	public function teacher()
	{
		$data['title'] = 'Tenaga Pengajar';
		$data['content'] = 'ap_teacher';
		$this->load->view('template', $data);
	}

	public function manage()
	{
		$data['title'] = 'Halaman Management User';
		$data['content'] = 'users/ap_users';
		$this->load->view('template', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
