<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<form class="form-inline mr-auto">
					<ul class="navbar-nav mr-3">
						<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
						<!-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> -->
					</ul>
					<!-- <div class="custom-control custom-switch">
						<input type="checkbox" class="custom-control-input" id="dark-theme" <?php echo $this->session->dark_mode == true ? 'checked' : '' ?>>
						<label class="custom-control-label text-white" for="dark-theme">Dark Theme</label>
					</div> -->
					<!-- 
					<div class="search-element">
						<input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
						<button class="btn" type="submit"><i class="fas fa-search"></i></button>
						<div class="search-backdrop"></div>
						<div class="search-result">
							<div class="search-header">
								Histories
							</div>
							<div class="search-item">
								<a href="#">How to hack NASA using CSS</a>
								<a href="#" class="search-close"><i class="fas fa-times"></i></a>
							</div>
							<div class="search-item">
								<a href="#">Kodinger.com</a>
								<a href="#" class="search-close"><i class="fas fa-times"></i></a>
							</div>
							<div class="search-item">
								<a href="#">#Stisla</a>
								<a href="#" class="search-close"><i class="fas fa-times"></i></a>
							</div>
							<div class="search-header">
								Result
							</div>
							<div class="search-item">
								<a href="#">
									<img class="mr-3 rounded" width="30" src="<?php echo base_url(); ?>assets/img/products/product-3-50.png" alt="product">
									oPhone S9 Limited Edition
								</a>
							</div>
							<div class="search-item">
								<a href="#">
									<img class="mr-3 rounded" width="30" src="<?php echo base_url(); ?>assets/img/products/product-2-50.png" alt="product">
									Drone X2 New Gen-7
								</a>
							</div>
							<div class="search-item">
								<a href="#">
									<img class="mr-3 rounded" width="30" src="<?php echo base_url(); ?>assets/img/products/product-1-50.png" alt="product">
									Headphone Blitz
								</a>
							</div>
							<div class="search-header">
								Projects
							</div>
							<div class="search-item">
								<a href="#">
									<div class="search-icon bg-danger text-white mr-3">
										<i class="fas fa-code"></i>
									</div>
									Stisla Admin Template
								</a>
							</div>
							<div class="search-item">
								<a href="#">
									<div class="search-icon bg-primary text-white mr-3">
										<i class="fas fa-laptop"></i>
									</div>
									Create a new Homepage Design
								</a>
							</div>
						</div>
					</div> -->
				</form>
				<ul class="navbar-nav navbar-right">
					<!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
						<div class="dropdown-menu dropdown-list dropdown-menu-right">
							<div class="dropdown-header">Messages
								<div class="float-right">
									<a href="#">Mark All As Read</a>
								</div>
							</div>
							<div class="dropdown-list-content dropdown-list-message">
								<a href="#" class="dropdown-item dropdown-item-unread">
									<div class="dropdown-item-avatar">
										<img alt="image" src="<?php echo base_url(); ?>assets/img/avatar/avatar-2.png" class="rounded-circle">
									</div>
									<div class="dropdown-item-desc">
										<b>Dedik Sugiharto</b>
										<p>Saya tertarik dengan produk anda, bisa jelaskan lebih detail?</p>
										<div class="time">12 Hours Ago</div>
									</div>
								</a>
								<a href="#" class="dropdown-item dropdown-item-unread">
									<div class="dropdown-item-avatar">
										<img alt="image" src="<?php echo base_url(); ?>assets/img/avatar/avatar-3.png" class="rounded-circle">
										<div class="is-online"></div>
									</div>
									<div class="dropdown-item-desc">
										<b>Agung Ardiansyah</b>
										<p>Produk kamu luar biasa, semoga tetap menginspirasi.</p>
										<div class="time">12 Hours Ago</div>
									</div>
								</a>
								<a href="#" class="dropdown-item dropdown-item-unread">
									<div class="dropdown-item-avatar">
										<img alt="image" src="<?php echo base_url(); ?>assets/img/avatar/avatar-1.png" class="rounded-circle">
										<div class="is-online"></div>
									</div>
									<div class="dropdown-item-desc">
										<b>Kusnaedi</b>
										<p>Hello, Bro!</p>
										<div class="time">10 Hours Ago</div>
									</div>
								</a>
							</div>
					</li>
					<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
						<div class="dropdown-menu dropdown-list dropdown-menu-right">
							<div class="dropdown-header">Notifications
								<div class="float-right">
									<a href="#">Mark All As Read</a>
								</div>
							</div>
							<div class="dropdown-list-content dropdown-list-icons">
								<a href="#" class="dropdown-item">
									<div class="dropdown-item-icon bg-info text-white">
										<i class="far fa-heart"></i>
									</div>
									<div class="dropdown-item-desc">
										Miranda renata</b> menyukai produk anda
										<div class="time">10 Hours Ago</div>
									</div>
								</a>
								<a href="#" class="dropdown-item">
									<div class="dropdown-item-icon bg-warning text-white">
										<i class="far fa-star"></i>
									</div>
									<div class="dropdown-item-desc">
										Ernanda renata</b> memberikan rating pada produk anda
										<div class="time">10 Hours Ago</div>
									</div>

									<a href="#" class="dropdown-item">
										<div class="dropdown-item-icon bg-danger text-white">
											<i class="far fa-comments"></i>
										</div>
										<div class="dropdown-item-desc">
											Ernanda renata</b> memberikan ulasan [ada] produk anda
											<div class="time">10 Hours Ago</div>
										</div>
									</a>
							</div>
							<div class="dropdown-footer text-center">
								<a href="#">View All <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>
					</li> -->
					<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
							<img alt="profile" src="<?= $this->session->photo == '' ? 'https://4.bp.blogspot.com/-pQD-irIgjU0/V5SSGHNCC7I/AAAAAAAAEsI/2UEF1E1m7LA02zWyJJdHGoUbUDk22-YLgCLcB/s72-w680-c/Song%2BJoong-Ki%2Bsebagai%2BYoo%2BShi-Jin%2B3.png' : base_url() . $this->session->photo ?>" class="rounded-circle mr-1" style="object-fit:cover; object-position: center; width:30px; height:30px">
							<div class="d-sm-none d-lg-inline-block">Hi, <?= $this->session->full_name ?></div>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="dropdown-title">Logged in 5 min ago</div>
							<a href="<?php echo base_url() . "admin/profile"; ?>" class="dropdown-item has-icon">
								<i class="far fa-user"></i> Profile
							</a>
							<div class="dropdown-divider"></div>
							<a href="#" class="btn-logout dropdown-item has-icon text-danger">
								<i class="fas fa-sign-out-alt"></i> Logout
							</a>
						</div>
					</li>
				</ul>


			</nav>
