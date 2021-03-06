<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="google-site-verification" content="xWBZiZPzBiBvDRZut67DLFwVhfhhNlizV7bHG2JVBik" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.css">
	<title><?php echo $title; ?> &mdash; SIMDA Apps</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/login.css">
	<script>
		const api = '<?= base_url() ?>'
	</script>
</head>

<body class="bg-primary overflow-hidden">

	<div class="vh-100 d-flex justify-content-center">
		<div id="loader" style="display: none" class="text-center">
			<div class="spinner-border text-danger" style="width: 10rem; height: 10rem; margin-left:3rem; margin-top:2rem" role="status">
				<span class="sr-only">Loading...</span>
			</div>
			<div class="spinner-border text-info" style="width: 14rem; height: 14rem; margin-left:1rem" role="status">
				<span class="sr-only">Loading...</span>
			</div>
			<div class="spinner-border text-light" style="width: 12rem; height: 12rem;margin-left:2rem;margin-top:1rem" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</div>
		<div class="d-flex align-items-center" style="max-width:500px">
			<div style="display: none" id="greating" class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Hi, <span id="name"></span> !</strong> Selamat Datang di <strong>Sistem Informasi Manajemen Dokumen Akreditasi (SIMDA)</strong>, Sistem Informasi Manajemen Inovasi Universitas Brawijaya.
			</div>
			<img src="<?=base_url().'assets/img/logo-sekolah.jpg'?>" alt="" id="icon-login" class="p-2 bg-white rounded-circle login-icon position-icon" />
			<div class="shadow bg-white p-5 login-form m-3" id="card-login">
				<p class="h3 mt-4 mb-4">SIMDA - Authentication</p>
				<form name="form-login" id="form-login">
					<div class="form-group">
						<label class="form-label" for="username">Username</label>
						<input id="username" class="form-control rounded-pill" type="text" name="username">
					</div>
					<div class="form-group mt-n1">
						<label class="form-label" for="password">Password</label>
						<input id="password" class="form-control rounded-pill" type="password" name="password">
					</div>
					<div class="text-center text-danger" id="msg"></div>
					<button class="btn btn-primary rounded-pill form-control" id="btn-login" type="submit">Login</button>
				</form>
			</div>
		</div>
		<div class="simple-footer fixed-bottom text-white">
			Copyright &copy; Sistem Informasi Manajemen Dokumen Akreditasi (SIMDA)
		</div>
	</div>
	<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>

	<script>
		function bounce(height, delay = 0) {
			$('#icon-login').delay(delay).animate({
				'margin-top': height + "em"
			}, 500);
		}

		$('#form-login').submit(async function(e) {
			e.preventDefault()
			$('#card-login').hide()
			$('#loader').delay(300).fadeIn()
			await bounce(0)
			await $.ajax({
				type: "post",
				url: '<?=base_url()?>' + 'account/login',
				data: $('#form-login').serialize(),
				success: function(response) {
					$('#loader').delay(700).fadeOut();
					if (!response.error) {
						$("#icon-login").delay(700).fadeOut(1000, function() {
							$("#name").text(response.data.full_name)
							$("#greating").fadeIn(2000, function() {
								window.location.replace("<?= base_url("admin") ?>")
							})
						})
					} else {
						$('#card-login').delay(1450).slideDown(400);
						bounce(-13, 1000);
						$("#msg").text(response.message);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					$('#loader').delay(700).fadeOut()
					$('#card-login').delay(1450).slideDown(400)
					bounce(-13, 1000)
					$("#msg").text(`(${xhr.status}) ${thrownError}`)
				}
			})
		});

		$('input').focus(function() {
			$(this).parents('.form-group').addClass('focused');
		});

		$('input').blur(function() {
			var inputValue = $(this).val();
			if (inputValue == "") {
				$(this).removeClass('filled');
				$(this).parents('.form-group').removeClass('focused');
			} else {
				$(this).addClass('filled');
			}
		})
	</script>
</body>

</html>
