<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title ?></h1>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h4>Dokumen saat ini</h4>
					</div>
					<div class="card-body">
					</div>
				</div>
			</div>
			<!-- <div class="col-md-4">
				<div class="card card-hero">
					<div class="card-header">
						<div class="card-icon">
							<i class="far fa-question-circle"></i>
						</div>
						<h4>14</h4>
						<div class="card-description">Breaking News</div>
					</div>
					<div class="card-body p-0">
						<div class="tickets-list">
							<a href="#" class="ticket-item">
								<div class="ticket-title">
									<h4>Lengkapi data produk inovasi anda</h4>
								</div>
								<div class="ticket-info">
									<div>UB Riset Administrator</div>
									<div class="bullet"></div>
									<div class="text-primary">1 menit lalu</div>
								</div>
							</a>
							<a href="#" class="ticket-item">
								<div class="ticket-title">
									<h4>Workshop pelatihan PPBT</h4>
								</div>
								<div class="ticket-info">
									<div>UB Riset Administrator</div>
									<div class="bullet"></div>
									<div>6 jam lalu</div>
								</div>
							</a>
							<a href="#" class="ticket-item">
								<div class="ticket-title">
									<h4>Update terbaru produk dikti</h4>
								</div>
								<div class="ticket-info">
									<div>UB Riset Administrator</div>
									<div class="bullet"></div>
									<div>6 jam lalu</div>
								</div>
							</a>
							<a href="features-tickets.html" class="ticket-item ticket-more">
								Lihat Semua <i class="fas fa-chevron-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div> -->
			<div class="row col-12" id="chart">

			</div>
		</div>
	</section>
</div>
<script>
	const req = requestGet(api + 'report/get')
	let canvas = ""
	req.data.forEach(element => {
		canvas += `<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<h4>${element.STANDAR}</h4>
						</div>
						<div class="card-body">
						<canvas class="mb-5" id="myChart-${element.STANDAR_ID}" height="158"></canvas>
						</div>
					</div>
				</div>`
	});
	$('#chart').html(canvas)

	req.data.forEach(element => {
		let statistics_chart = document.getElementById("myChart-" + element.STANDAR_ID).getContext('2d')
		let myChart = new Chart(statistics_chart, {
			type: 'doughnut',
			data: {
				labels: ['Terdata', 'Diajukan', 'Revisi', 'Tervalidasi'],
				datasets: [{
					label: '# of Votes',
					data: [element.TERDATA, element.DIAJUKAN, element.REVISI, element.TERVALIDASI],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
					],
					borderColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
					],
					borderWidth: 1
				}],
			}
		});
	});
</script>
