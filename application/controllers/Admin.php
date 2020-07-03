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

	public function akreditasi($slug, $competency = null)
	{
		$slug = str_replace('%20', ' ', $slug);
		$standar = explode('~', $slug, 2);
		$find = false;
		foreach ($this->access as $key => $value) {
			if ($value->role_id ==  $standar[1])
				$find = true;
		}
		if ($find) {
			$data['title'] = 'Detail ' . $standar[0];
			$data['content'] = 'ap_competency';
			$data['role_id'] = $standar[1];
			$data['standar'] = $standar[0];
			$data['slug'] = $slug;
			if (!is_null($competency))
				$this->competency($slug, $competency, $data);
			else
				$this->load->view('template', $data);
		} else
			redirect('admin');
	}

	private function competency($slug, $slugCompetency, $data)
	{
		$slug = str_replace('%20', ' ', $slug);
		$standar = explode('~', $slug, 2);

		$slugCompetency = str_replace('%20', ' ', $slugCompetency);
		$competency = explode('~', $slugCompetency, 2);

		$do = DB_MODEL::find('competency', ['role_id' => $standar[1], 'id' => $competency[1]]);
		if (!$do->error) {
			$data['title'] = "Detail " . $competency[0];
			$data['content'] = 'ap_detail';
			$data['competency_id'] = $competency[1];
			$data['competency'] = $competency[0];
			$data['role_id'] = $standar[1];
			$data['standar'] = $standar[0];
			$this->load->view('template', $data);
		} else
			redirect('admin/akreditasi/' . $slug);
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
