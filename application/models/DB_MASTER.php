<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DB_MASTER extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		session($this->session);
	}
	public static function insert($table, $data)
	{
		$CI = &get_instance();
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['created_by'] = $CI->session->userdata('id');
		$data['updated_by'] = $CI->session->userdata('id');
		$query = $CI->db->insert($table, $data);
		if ($query) {
			$id = $CI->db->insert_id();
			if ($id != 0)
				$data['id'] = $id;
			return true($data);
		} else
			return false();
	}

	public static function insert_any($table, $data)
	{
		$CI = &get_instance();
		$query = $CI->db->insert_batch($table, $data);
		if ($query)
			return true($query);
		else
			return false();
	}

	public static function update($table, $where, $data)
	{
		$CI = &get_instance();
		$data['updated_by'] = $CI->session->userdata('id');
		$CI->db->where($where)->update($table, $data);
		if (is_array($where))
			return true(array_merge($where, $data));
		else
			return true($data);
	}

	public static function update_straight($table, $where, $data)
	{
		$CI = &get_instance();
		$data['updated_by'] = $CI->session->userdata('id');
		$query = $CI->db->where($where)->update($table, $data);
		if ($CI->db->affected_rows() !== 0)
			if (is_array($where))
				return true(array_merge($where, $data));
			else
				return true($data);
		else
			return false();
	}
}

/* End of file db_model.php */
/* Location: ./application/models/db_model.php */
