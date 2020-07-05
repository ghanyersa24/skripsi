<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DB_CUSTOM extends CI_Model
{
	public static function perStandar()
	{
		$CI = &get_instance();
		$sql = "SELECT
		`role`.`id` STANDAR_ID,
		`role`.`role` STANDAR,
		COUNT(`document`.`competency_id`) TOTAL,
		(
		SELECT
			COUNT(*)
		FROM
			`document`
		JOIN
			`competency` ON `document`.`competency_id`=`competency`.`id`
		WHERE
			`document`.`status` = 'terdata' AND `competency`.`role_id`=`role`.`id`
	) TERDATA,
	(
		SELECT
			COUNT(*)
		FROM
			`document`
		JOIN
			`competency` ON `document`.`competency_id`=`competency`.`id`
		WHERE
			`document`.`status` = 'diajukan' AND `competency`.`role_id`=`role`.`id`
	) DIAJUKAN,
	(
		SELECT
			COUNT(*)
		FROM
			`document`
		JOIN
			`competency` ON `document`.`competency_id`=`competency`.`id`
		WHERE
			`document`.`status` = 'tervalidasi' AND `competency`.`role_id`=`role`.`id`
	) TERVALIDASI,
	(
		SELECT
			COUNT(*)
		FROM
			`document`
		JOIN
			`competency` ON `document`.`competency_id`=`competency`.`id`
		WHERE
			`document`.`status` = 'revisi' AND `competency`.`role_id`=`role`.`id`
	) REVISI
	FROM
		`competency`
	LEFT JOIN `document` ON `competency`.`id` = `document`.`competency_id`
	JOIN `role` ON `competency`.`role_id`=`role`.`id`
	GROUP BY `role`.`id`";
		$query = $CI->db->query($sql);
		if ($query)
			return true($query->result());
		else
			return false();
	}

	public static function perCompetency($standar = null)
	{
		$CI = &get_instance();
		$sql = "SELECT
		`role`.`id` STANDAR_ID,
		`role`.`role` STANDAR,
		`role`.`bobot_komponen` BOBOT_KOMPONEN,
		`competency`.`id` COMPETENCY_ID,
		`competency`.`competency` COMPETENCY,
		`competency`.`bobot` BOBOT,
		`competency`.`details` DETAILS,
		`competency`.`bobot` * COUNT(`document`.`competency_id`) MAX_POINT,
		COUNT(`document`.`competency_id`) TOTAL,
		(
		SELECT
			COUNT(*)
		FROM
			`document`
		WHERE
			`document`.`status` = 'terdata' AND `document`.`competency_id` = `competency`.`id`
	) TERDATA,
	(
		SELECT
			COUNT(*)
		FROM
			`document`
		WHERE
			`document`.`status` = 'diajukan' AND `document`.`competency_id` = `competency`.`id`
	) DIAJUKAN,
	(
		SELECT
			COUNT(*)
		FROM
			`document`
		WHERE
			`document`.`status` = 'tervalidasi' AND `document`.`competency_id` = `competency`.`id`
	) TERVALIDASI,
	(
		SELECT
			COUNT(*)
		FROM
			`document`
		WHERE
			`document`.`status` = 'revisi' AND `document`.`competency_id` = `competency`.`id`
	) REVISI
	FROM
		`competency`
	LEFT JOIN `document` ON `competency`.`id` = `document`.`competency_id`
	JOIN `role` ON `competency`.`role_id`=`role`.`id`";
		if (!is_null($standar))
			$sql .= " WHERE `role`.`id`=$standar";

		$sql .= " GROUP BY `competency`.`id`";
		$query = $CI->db->query($sql);
		if ($query)
			return true($query->result());
		else
			return false();
	}
}
