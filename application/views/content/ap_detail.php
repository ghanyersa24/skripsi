<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title ?></h1>
		</div>
		<div class="section-body">
			<div class="row mt-sm-4">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card ">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped" id="table">
									<thead>
										<tr>
											<th class="text-center" width="5%">
												#
											</th>
											<th>Nama Guru</th>
											<th>Lokasi</th>
											<th>Status</th>
											<th width="15%">Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th class="text-center">
												#
											</th>
											<th></th>
											<th>Ketercapaian</th>
											<th id="persentase"></th>
											<th>#</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="modal fade" id="add">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Detail {{$indicator}}</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<form id="form-add" name="form-add" method="post">
					<input type="text" class="form-control" id="add-teacher_id" name="teacher_id" readonly hidden>
					<div class="modal-body row" id="form-data">
						<div class="col border-right">
							<div class="form-group">
								<label for="add-name">Nama Guru</label>
								<input type="text" class="form-control" id="add-name" name="name" readonly>
							</div>
							<div class="form-group">
								<label for="add-location">Lokasi Dokumen</label>
								<input type="text" class="form-control" id="add-location" name="location">
							</div>
							<div class="form-group">
								<label for="add-year">Tahun Dokumen</label>
								<input type="number" class="form-control" id="add-year" name="year" min="2018" max="2022">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-info" id="btn-add">Tambah</button>
					</div>
				</form>
			</div>

		</div>
	</div>

	<div class="modal fade" id="view">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Detail {{$indicator}}</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<form id="form-view" name="form-view" method="post">
					<input type="number" class="form-control" id="view-id" name="id" readonly hidden>
					<div class="modal-body row" id="form-data">
						<div class="col border-right">
							<div class="form-group">
								<label for="view-name">Nama Guru</label>
								<input type="text" class="form-control" id="view-name" name="name" readonly>
							</div>
							<div class="form-group">
								<label for="view-location">Lokasi Dokumen</label>
								<input type="text" class="form-control" id="view-location" name="location">
							</div>
							<div class="form-group">
								<label for="view-year">Tahun Dokumen</label>
								<input type="number" class="form-control" id="view-year" name="year" min="2018" max="2022">
							</div>
						</div>
						<div class="col-sm-8">
							<div class="form-group">
								<label>Upload Dokumen</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="view-document" aria-describedby="btn-upload">
										<label class="custom-file-label" for="view-document">Cari file</label>
									</div>
									<div class="input-group-append">
										<button class="btn btn-primary" type="button" id="btn-upload">Upload</button>
									</div>
								</div>
							</div>
							<!-- <div class="col-12 text-center">
                            <img id="on-work" class="w-50" style="display: none" src="{{url('gif/on-work.gif')}}" alt="">
                        </div> -->
							<div class="d-flex align-items-start h-75 row no-gutters" id="data-links">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn" id="btn-save">Simpan</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#table').DataTable({
			ajax: api + '',
			"footerCallback": function(row, data, start, end, display) {
				var all = data.length;
				var valid = 0;
				data.forEach(element => {
					if (element.status == 'tervalidasi')
						++valid;
				});
				$('#persentase').html(`${parseInt (valid/all *100)} %`)
			},
			columns: [{
				"render": function(data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1
				},
				className: "text-center"
			}, {
				"render": function(data, type, JsonResultRow, meta) {
					return `${JsonResultRow.name} (${JsonResultRow.mapel})`
				}
			}, {
				"data": "location"
			}, {
				"render": function(data, type, JsonResultRow, meta) {
					return status(JsonResultRow.status);
				}
			}, {
				"render": function() {
					return '<button class="btn btn-view btn-sm btn-primary"><i class="far fa-eye"></i> Detail</button> ';
				},
				className: "text-center"
			}]
		});

		$('#table tbody').on('click', 'button.btn-view', function() {
			var data = $('#table').DataTable().row($(this).parents('tr')).data();
			if (data.id == null) {
				for (key in data) {
					$('#add-' + key).val(data[key]);
				}
				$('#add').modal('show');
			} else {
				year = data.year
				loc = data.location
				for (key in data) {
					$('#view-' + key).val(data[key]);
				}
				$('#btn-save').removeClass('btn-info')
				$('#btn-save').addClass('btn-default')
				$('#btn-save').attr('disabled', 'true')
				ajax_view(data.id)
				$('#view').modal('show')
			}
		});

		$("#view-location, #view-year").keyup(function() {
			if ($('#view-location').val() == loc && $('#view-year').val() == year) {
				$('#btn-save').removeClass('btn-info')
				$('#btn-save').addClass('btn-default')
				$('#btn-save').attr('disabled', 'true')
			} else {
				$('#btn-save').removeAttr('disabled')
				$('#btn-save').addClass('btn-info')
				$('#btn-save').removeClass('btn-default')
			}
		});

	});
</script>
