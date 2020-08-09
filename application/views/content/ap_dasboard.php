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
					<div class="card-body">
						<div class="row container">
							<h4 class="w-100">Peringkat <span id="peringkat"></h4>
							<label>dengan jumlah <span id="point" class="text-warning"></span> <span class="text-warning">poin</span> akreditasi. </span></label>
						</div>
						<div class="table-responsive">
							<table class="table table-striped w-100" id="table">
								<thead>
									<tr>
										<th class="text-center" width="5%">
											#
										</th>
										<th width="35%">Standar</th>
										<th>Kompetensi</th>
										<th>Bobot Komponen</th>
										<th>Poin Maksimal</th>
										<th>Perolehan</th>
										<th>Nilai</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<div class="card-description h5">Riwayat</div>
					</div>
					<div class="card-body p-0">
						<div class="tickets-list overflow-auto vh-100" id="history">

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="chart">
		</div>
	</section>
</div>

<style>
	td.details-control {
		background: url('<?= base_url() ?>assets/img/details_open.png') no-repeat center center;
		cursor: pointer;
	}

	tr.shown td.details-control {
		background: url('<?= base_url() ?>assets/img/details_close.png') no-repeat center center;
	}
</style>
<script>
	$(document).ready(function() {
		const req = requestGet(api + 'report/get')
		$('#point').text(req.data.rekap.nilai_akhir)
		$('#peringkat').text(req.data.rekap.peringkat)

		$('#table').DataTable({
			data: req.data.rekap.rekap,
			dom: 'Bfrtip',
			buttons: [{
					extend: 'excelHtml5',
					footer: true
				},
				{
					extend: 'pdfHtml5',
					footer: true
				},
				{
					extend: 'print',
					footer: true,
				}
			],
			searching: false,
			ordering: false,
			paging: false,
			columns: [{
				className: 'details-control',
				orderable: false,
				data: null,
				defaultContent: ''
			}, {
				data: "standar"
			}, {
				data: "totalCompetency"
			}, {
				data: "bobot"
			}, {
				data: "skorMax"
			}, {
				data: "perolehan"
			}, {
				data: "akreditasi"
			}]
		})
		$('#table tbody').on('click', 'td.details-control', function() {
			var tr = $(this).closest('tr');
			var row = $('#table').DataTable().row(tr);

			if (row.child.isShown()) {
				row.child.hide();
				tr.removeClass('shown');
			} else {
				row.child(format(row.data())).show();
				tr.addClass('shown');
			}
		});

		let canvas = ""
		req.data.standar.forEach(element => {
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

		req.data.standar.forEach(element => {
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

		const history = requestGet(api + 'history/get')
		printHistory(history.data)
	});

	const format = (d) => {
		return '<table class="ml-4 w-100">' +
			'<tr>' +
			'<td width="30%">Total Dokumen :</td>' +
			'<td>' + d.totalDocument + ' Dokumen</td>' +
			'</tr>' +
			'<tr>' +
			'<td>Total Terdata :</td>' +
			'<td>' + d.totalTerdata + ' Dokumen</td>' +
			'</tr>' +
			'<tr>' +
			'<td>Total Tervalidasi :</td>' +
			'<td>' + d.totalTervalidasi + ' Dokumen</td>' +
			'</tr>' +
			'<tr>' +
			'<td>Total Revisi :</td>' +
			'<td>' + d.totalRevisi + ' Dokumen</td>' +
			'</tr>' +
			'<tr>' +
			'<td>Total Diajukan :</td>' +
			'<td>' + d.totalDiajukan + ' Dokumen</td>' +
			'</tr>' +
			'</table>';
	}
	const printHistory = (data) => {
		let hist = ""
		data.forEach(element => {
			hist += `<a href="${base_url}/admin/akreditasi/${element.slug}" class="ticket-item ${element.type=='pengajuan'?'text-warning':'text-primary'}">
						<div class="ticket-title">
							<h4>${element.message}</h4>
						</div>
						<div class="ticket-info">
							<div>${element.full_name}</div>
						<div class="bullet"></div>
						<div class="text-primary">${element.created_at}</div>
						</div>
					</a>`
		});
		$('#history').html(hist)
	}
</script>
