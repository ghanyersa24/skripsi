<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="<?= base_url(); ?>admin"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bb/Logo_Universitas_Brawijaya.svg/1200px-Logo_Universitas_Brawijaya.svg.png" width="12%" alt=""> SIMDA Apps</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm text-center">
			<a href="<?= base_url(); ?>admin">
				<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bb/Logo_Universitas_Brawijaya.svg/1200px-Logo_Universitas_Brawijaya.svg.png" class="w-50" alt="">
			</a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">Dashboard</li>
			<?php $segment = $this->uri->segment(2) ?>
			<li class="<?= $segment == '' || $segment == 'index' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url(); ?>admin"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
			</li>
			<li class="dropdown <?= $segment == 'akreditasi' ? 'active' : ''; ?>"><a class="nav-link has-dropdown" href=""><i class="fab fa-megaport"></i><span>Standar Akreditasi</span></a>
				<ul class="dropdown-menu" id="instrumen-menu">
					<?php
					$access = str_replace('standar-', '', $this->uri->segment(3));
					foreach ($this->session->access as $value) {
					?>
						<li class="<?= $access == $value->role_id ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() . 'admin/akreditasi/standar-' . $value->role_id . '/' . $value->role ?>">Standar <?= $value->role_id ?></a></li>
					<?php
					}
					?>
				</ul>
			</li>
			<li class="<?= $segment == 'manage' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url(); ?>admin/manage"><i class="fas fa-users"></i> <span>Tim Pengembang</span></a></li>
			<li class="<?= $segment == 'teacher' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url(); ?>admin/teacher"><i class="fas fa-user"></i> <span>Tenaga Pengajar</span></a></li>
			<li class="<?= $segment == 'mapel' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url(); ?>admin/mapel"><i class="fas fa-book"></i> <span>Mata Pelajaran</span></a></li>
			<li class="<?= $segment == 'profile' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url(); ?>admin/profile"><i class="fas fa-user"></i> <span>Profile</span></a></li>
			<li onclick="logout()"><a class="nav-link" href="#"> <i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
		</ul>
	</aside>
</div>
<script>
	let logout = () => {
		confirm("keluar dari sistem Sistem Informasi Manajemen Dokumen Akreditasi (SIMDA).").then((willLogout) => {
			if (willLogout)
				window.location.replace('<?= base_url() . 'admin/logout' ?>')
		})
	}
</script>
