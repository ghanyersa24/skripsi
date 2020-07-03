<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('component/header');
$this->load->view('component/layout');
$this->load->view('component/sidebar');
$this->load->view("content/$content");
?>
<div id="progress-upload" class="position-fixed row bg-trans h-100" tabindex="-1" style="display:none; top:0; left:0; right:0;z-index:999999;background: rgba(137, 191, 202, 0.48)">
	<div class="d-flex justify-content-center vw-100">
		<div class="d-flex align-items-center mt-n5" style="width: 40%;">
			<img src="<?= base_url() . 'assets/img/loading.gif' ?>" alt="" class="w-100">
		</div>
	</div>
</div>
<?php
$this->load->view('component/footer');
