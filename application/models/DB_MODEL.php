<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DB_MODEL extends CI_Model
{

	public static function all($table)
	{
		$CI = &get_instance();
		return true($CI->db->order_by("created_at", 'DESC')->get($table)->result());
	}

	public static function where($table, $where)
	{
		$CI = &get_instance();
		$query = $CI->db->where($where)->order_by("created_at", 'DESC')->get($table);
		if ($query)
			return true($query->result());
		else
			return false();
	}

	public static function like($table, $where, $like)
	{
		$CI = &get_instance();
		$query = $CI->db->where($where)->like($like)->order_by("created_at", 'DESC')->get($table);
		if ($query)
			return true($query->result());
		else
			return false();
	}

	public static function limit($table, $limit)
	{
		$CI = &get_instance();
		return true($CI->db->limit($limit)->order_by("created_at", 'DESC')->get($table)->result());
	}

	public static function find($table, $where)
	{
		$CI = &get_instance();
		$query = $CI->db->where($where)->limit(1)->order_by("created_at", 'DESC')->get($table);
		if ($CI->db->affected_rows() !== 0)
			return true($query->row());
		else
			return false();
	}

	public static function insert($table, $data)
	{
		$CI = &get_instance();
		$data['created_at'] = date('Y-m-d H:i:s');
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
		$CI->db->where($where)->update($table, $data);
		if (is_array($where))
			return true(array_merge($where, $data));
		else
			return true($data);
	}

	public static function update_straight($table, $where, $data)
	{
		$CI = &get_instance();
		$query = $CI->db->where($where)->update($table, $data);
		if ($CI->db->affected_rows() !== 0)
			if (is_array($where))
				return true(array_merge($where, $data));
			else
				return true($data);
		else
			return false();
	}

	public static function delete($table, $where)
	{
		$CI = &get_instance();
		$query = $CI->db->where($where)->delete($table);
		if ($CI->db->affected_rows() !== 0)
			return true($query);
		else
			return false();
	}

	public static function clean($table, $where)
	{
		$CI = &get_instance();
		$query = $CI->db->where($where)->delete($table);
		if ($query)
			return true($query);
		else
			return false();
	}

	public static function join($table_join, $to_table,  $on = null, $type = 'inner', $where = [], $select = '*')
	{
		$CI = &get_instance();
		if (is_null($on))
			$query = $CI->db->select($select)->from($to_table)->where($where)->join($table_join, $table_join . '.' . $to_table . '_id = ' . $to_table . '.id', $type)->get();
		else
			$query = $CI->db->select($select)->from($to_table)->where($where)->join($table_join, $on, $type)->get();
		if ($query)
			return true($query->result());
		else
			return false();
	}
}

/* End of file DB_MODEL.php */
/* Location: ./application/models/DB_MODEL.php */
