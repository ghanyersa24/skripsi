<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title ?></h1>
		</div>
	</section>

	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body row" id="kompetensi">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		const competency = requestGet(api + 'competency/get/<?= $standar ?>')
		printCompetancy(competency)
	});
	const printCompetancy = response => {
		let div = "";
		if (!response.error)
			response.data.forEach(print => {
				div += `<div class="card col-sm-3 shadow-none ">
                            <div class="card-body shadow-sm rounded">
                                <a href="<?= base_url() . 'admin/akreditasi/standar-'.$standar.'/kompetensi-' ?>${print.id}/${print.details}" class="text-decoration-none">
                                    <h5 class="card-title">${print.competency}</h5>
                                    <hr>
                                    <p class="card-text">${print.details}</p>
                                </a>
                            </div>
                        </div>`;
			});
		$('#kompetensi').append(div)
	}
</script>
