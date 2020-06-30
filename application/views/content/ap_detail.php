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
											<th width="35%">Nama Guru</th>
											<th>Lokasi</th>
											<th width="15%">Status</th>
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
					<h5 class="modal-title" id="exampleModalLabel">Detail Kompetensi <?= $competency ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<form id="form-add" name="form-add" method="post">
					<input type="number" class="form-control" id="add-teacher_id" name="reference" readonly hidden>
					<input type="number" class="form-control" value="<?= $competency ?>" name="competency_id" readonly hidden>
					<div class="modal-body row" id="form-data">
						<div class="col">
							<div class="form-group">
								<label for="add-teacher_name">Nama Guru</label>
								<input type="text" class="form-control" id="add-teacher_name" name="teacher_name" readonly>
							</div>
							<div class="form-group">
								<label for="add-location">Lokasi Dokumen</label>
								<input type="text" class="form-control" id="add-location" name="location">
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

	<div class="modal fade" id="unggah" style="z-index:9999999">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Unggah Dokumen Kompetensi <?= $competency ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<form id="form-upload" name="form-upload" method="post">
					<input type="number" class="form-control" value="<?= $competency ?>" name="competency_id" readonly hidden>
					<div class="modal-body" id="form-data">
						<div class="form-group">
							<label>Dokumen</label>
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="add-document" aria-describedby="btn-upload">
									<label class="custom-file-label" for="view-document">Cari file</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="add-year">Tahun</label>
							<input id="add-year" class="form-control" type="number" name="year">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-info" id="btn-uplad">Tambah</button>
					</div>
				</form>
			</div>

		</div>
	</div>

	<div class="modal fade" id="view">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Detail Kompetensi <?= $competency ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<form id="form-view" name="form-view" method="post">
					<input type="number" class="form-control" id="view-id" name="id" readonly hidden>
					<div class="modal-body row" id="form-data">
						<div class="col border-right">
							<div class="form-group">
								<label for="view-teacher_name">Nama Guru</label>
								<input type="text" class="form-control" id="view-teacher_name" name="teacher_name" readonly>
							</div>
							<div class="form-group">
								<label for="view-location">Lokasi Dokumen</label>
								<input type="text" class="form-control" id="view-location" name="location">
							</div>

							<button class="btn btn-primary mt-3 w-100" type="button" data-toggle="modal" data-target="#unggah">Unggah Berkas</button>
						</div>
						<div class="col-sm-8">
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
			ajax: api + 'CompetencyTeacher/get/1',
			footerCallback: function(row, data, start, end, display) {
				let all = data.length;
				let valid = 0;
				data.forEach(element => {
					if (element.status == 'tervalidasi')
						++valid;
				});
				$('#persentase').html(`${parseInt (valid/all *100)} %`)
			},
			columns: [{
				render: function(data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1
				},
				className: "text-center"
			}, {
				render: function(data, type, row, meta) {
					return `${row.teacher_name} (${row.mapel})`
				}
			}, {
				data: "location"
			}, {
				render: function(data, type, row, meta) {
					return status(row.status);
				}
			}, {
				render: function() {
					return `<button class="btn btn-primary btn-view"><i class="fa fa-eye"></i> Detail </button>`
				},
				className: "text-center"
			}]
		});

		$('#table tbody').on('click', 'button.btn-view', function() {
			let data = $('#table').DataTable().row($(this).parents('tr')).data();
			if (data.id == null) {
				for (key in data) {
					$('#add-' + key).val(data[key]);
				}
				$('#add').modal('show');
			} else {
				loc = data.location
				for (key in data) {
					$('#view-' + key).val(data[key]);
				}
				$('#btn-save').removeClass('btn-info')
				$('#btn-save').addClass('btn-default')
				$('#btn-save').attr('disabled', 'true')
				$('#view').modal('show')
			}
		});

		$("#view-location").keyup(function() {
			if ($('#view-location').val() == loc) {
				$('#btn-save').removeClass('btn-info')
				$('#btn-save').addClass('btn-default')
				$('#btn-save').attr('disabled', 'true')
			} else {
				$('#btn-save').removeAttr('disabled')
				$('#btn-save').addClass('btn-info')
				$('#btn-save').removeClass('btn-default')
			}
		});

		$('#form-add').submit(function(e) {
			e.preventDefault();
			let data = $('#form-add').serialize()
			const req = requestPost(api + 'CompetencyTeacher/create', data)
			if (!req.error) {
				$('#form-add input').val('')
				$('#add').modal('hide')
				$('#table').dataTable().api().ajax.reload()
			}
		});

	});
</script>
