<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DB_CUSTOM extends CI_Model
{
	public static function documentTeacher($kompetensi)
	{
		$CI = &get_instance();
		$query = $CI->db->query("SELECT
        `document`.*,
        `teacher`.`teacher_id`,
        `teacher`.`teacher_name`,
        `teacher`.`mapel`
    FROM
        (
        SELECT
            *
        FROM
            `document`
        WHERE
            `competency_id` = $kompetensi
    ) AS `document`
    RIGHT JOIN(
        SELECT
            `teacher`.`id` AS `teacher_id`,
            `teacher`.`teacher_name`,
            `mapel`.`mapel`
        FROM
            `teacher`
        INNER JOIN `mapel` ON `teacher`.`mapel_id` = `mapel`.`id`
    ) AS `teacher`
    ON
		`document`.`reference` = `teacher`.`teacher_id`");
		if ($query)
			return true($query->result());
		else
			return false();
	}
}
