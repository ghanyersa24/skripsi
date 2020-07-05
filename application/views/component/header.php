<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $title; ?> &mdash; SIMDA Apps</title>

	<!-- Global CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/datatables.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/components.css">

	<!-- Global Javascript -->
	<script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/modules/sweetalert/sweetalert.min.js"></script>
	<script src="<?= base_url() ?>assets/modules/datatables/datatables.min.js"></script>
	<script src="<?= base_url(); ?>assets/modules/chart.min.js"></script>
	<script src="<?= base_url() . 'assets/js/request.js' ?>"></script>
	<script>
		const api = '<?= base_url() ?>api/'
		const base_url = '<?= base_url() ?>'
	</script>
	<style>
		.ck.ck-content ul,
		.ck.ck-content ul li {
			list-style-type: inherit;
		}
	</style>

</head>
