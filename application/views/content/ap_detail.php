<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title ?></h1>
		</div>
		<button class="btn btn-info " data-toggle="modal" data-target="#add" style="position: fixed; bottom: 36px;   right: 20px; padding: 18.5px;z-index: 10;">
			<i class="fa fa-plus"></i>
		</button>
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
											<th width="35%">Judul</th>
											<th>Lokasi</th>
											<th>Tahun</th>
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
											<th></th>
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

	<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Dokumen <?= $competency ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<form id="form-add" name="form-add">
					<input type="number" class="form-control" id="view-id" name="id" readonly hidden>
					<div class="modal-body row" id="form-data">
						<div class="col border-right">
							<div class="form-group">
								<label for="add-document">Judul Dokumen</label>
								<input type="text" class="form-control" id="add-document" name="document">
							</div>
							<div class="form-group">
								<label for="add-location">Lokasi Dokumen</label>
								<input type="text" class="form-control" id="add-location" name="location">
							</div>
							<div class="form-group">
								<label for="add-year">Tahun</label>
								<input type="number" class="form-control" id="add-year" name="year" value="<?= date('Y') ?>">
							</div>
							<div class="form-group">
								<label>Dokumen</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="add-upload" aria-describedby="btn-upload">
										<label class="custom-file-label" for="add-upload">Cari file</label>
									</div>
								</div>
							</div>
							<!-- <button class="btn btn-primary mt-3 w-100" type="button" data-toggle="modal" data-target="#unggah">Unggah Berkas</button> -->
						</div>
						<div class="col-sm-8">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="button" class="btn" id="btn-add">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="unggah" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Unggah Dokumen <?= $competency ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<form id="form-upload" class="form-upload">
					<div class="modal-body" id="form-data">
						<div class="form-group">
							<label>Dokumen</label>
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="add-upload" aria-describedby="btn-upload">
									<label class="custom-file-label" for="add-upload">Cari file</label>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="button" class="btn btn-info" id="btn-upload">Tambah</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#btn-add').click(async (e) => {
			let formData = new FormData()
			formData.append('gdrive', document.getElementById('add-upload').files[0])
			formData.append('competency_id', <?= $competency_id ?>)
			formData.append('judul', $('#add-document').val())
			formData.append('year', $('#add-year').val())
			formData.append('location', $('#add-location').val())
			formData.append('folderName', '<?= $competency ?>')
			await $('#progress-upload').fadeIn()
			await $.ajax({
				type: "POST",
				url: api + 'document/create',
				data: formData,
				processData: false,
				contentType: false,
				success: function(res) {
					$('#progress-upload').fadeOut()
					if (!res.error) {
						swal('Berhasil !', res.message, 'success')
						$('#add').modal('hide')
						$('#table').datatable().api().ajax.reload()
						$('#form-add input').val('')
					} else if (res.error && res.message == 'silahkan melakukan autentikasi google drive')
						konfirm('menggunggah file ke google drive perlu autentikasi google.').then((yes) => {
							if (yes)
								window.open(res.data.url)
						})
					else
						swal('Gagal !', res.message, 'error')
				},
				error: function(xhr, ajaxOptions, thrownError) {
					$('#progress-upload').fadeOut()
					swal('Gagal !', `(${xhr.status}) ${thrownError}`, 'error')
				}
			})
		})

		$('#table').DataTable({
			ajax: api + 'document/get/<?= $competency_id ?>',
			footerCallback: function(row, data, start, end, display) {
				let all = data.length;
				let valid = 0;
				data.forEach(element => {
					if (element.status == 'tervalidasi')
						++valid;
				});
				$('#persentase').html(`${parseInt (valid==0?valid: valid/all *100)} %`)
			},
			columns: [{
				render: function(data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1
				},
				className: "text-center"
			}, {
				data: "title"
			}, {
				data: "location"
			}, {
				data: "year"
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
	});
</script>
