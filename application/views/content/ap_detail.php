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
					<h5 class="modal-title" id="exampleModalLabel">Tambah Dokumen <?= $competency ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<form id="form-add" name="form-add">
					<div class="modal-body row" id="form-data">
						<div class="col border-right">
							<div class="form-group">
								<label for="add-title">Judul Dokumen</label>
								<input type="text" class="form-control" id="add-title" name="title">
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
						<button type="button" class="btn btn-primary" id="btn-add">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Detail Dokumen <?= $competency ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<form id="form-view" name="form-view">
					<input type="number" class="form-control" id="view-id" name="id" readonly hidden>
					<div class="modal-body row" id="form-data">
						<div class="col-sm-4 border-right">
							<div class="form-group">
								<label for="view-title">Judul Dokumen</label>
								<input type="text" class="form-control" id="view-title" name="title">
							</div>
							<div class="form-group">
								<label for="view-location">Lokasi Dokumen</label>
								<input type="text" class="form-control" id="view-location" name="location">
							</div>
							<div class="form-group">
								<label for="view-year">Tahun</label>
								<input type="number" class="form-control" id="view-year" name="year" value="<?= date('Y') ?>">
							</div>
							<div class="form-group">
								<label>Dokumen</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="view-upload" aria-describedby="btn-upload">
										<label class="custom-file-label view-l" for="view-upload">Cari file</label>
									</div>
								</div>
							</div>
							<!-- <button class="btn btn-primary mt-3 w-100" type="button" data-toggle="modal" data-target="#unggah">Unggah Berkas</button> -->
						</div>
						<div class="col-sm-6 ml-md-5">
							<div id="view-status-document">
								<div id="terdata">
									<div class="form-group">
										<label>Status Dokumen</label>
										<p>kamu sudah mengunggah dokumen pada <a class="view-link" target="_blank" href="">link.</a></p>
									</div>
									<span class=" click text-info" id="btn-pengajuan">Ajukan Validasi Dokumen !</span>
								</div>
								<div id="diajukan" style="display: none;">
									<div class="form-group">
										<label>Status Dokumen</label>
										<p>Dokumen ini sedang <span class="badge badge-secondary">Diajukan</span>. untuk sementara <a class="view-link" target="_blank" href="">dokumen ini </a> tidak bisa diubah.</p>
									</div>
								</div>
								<div id="tervalidasi" style="display: none;">
									<div class="d-block mt-4">
										<span> <span class="h6">Selamat,</span> dokumen ini sudah <div class="badge badge-info">Tervalidasi</div>. <br> dokumen ini tidak bisa diubah lagi.</span>
										<a class="view-link" target="_blank" href="">lihat dokumen.</a>
									</div>
								</div>
								<div id="revisi" style="display: none;">
									<div class="d-block mt-4">
										<span> <span class="h6">Sabar ya,</span> dokumen ini berstatus <div class="badge badge-warning">Revisi</div>. <br> <b>Note : </b> <span id="view-note"></span>.</span>
										<a class="view-link" target="_blank" href="">lihat dokumen.</a>
										<br>
										<span class="click text-info" id="btn-pengajuan2">Ajukan Lagi Validasi Dokumen !</span>
									</div>
								</div>
								<!-- <br> -->
								<hr>
								<?php
								if ($this->session->status == 'penanggung jawab') {
								?>
									<div id="validator">
										<p class="h6 mb-3 click" onclick="formStatus()"> <u>Formulir Status Dokumen</u></p>
										<div id="formStatus" style="display: none;">
											<div class="form-group">
												<input class="form-control" type="text" id="view-status" hidden readonly>
												<label>Status</label>
												<select id="add-status" class="form-control" name="status">
													<option value="terdata">Terdata</option>
													<option value="revisi">Revisi</option>
													<option value="tervalidasi">Tervalidasi</option>
												</select>
											</div>
											<div class="form-group">
												<label for="add-note">Catatan</label>
												<textarea id="add-note" class="form-control" name="note" rows="3"></textarea>
											</div>
											<div class="d-flex justify-content-end">
												<button class="btn btn-primary" id="btn-status" type="button">Simpan Status Dokumen</button>
											</div>
										</div>
									</div>
								<?php
								}
								?>
							</div>
							<div id="view-history-document" class="tickets-list overflow-auto" style="display: none;height: 60vh;">
							</div>
						</div>
						<div class="col">
							<div class="d-flex justify-content-center h-100">
								<div class="d-flex align-items-center">
									<button class="btn btn-default rounded-circle" type="button" id="btn-history"><i class="fas fa-history" style="font-size: 2.5em;"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" id="btn-hapus">Hapus</button>
						<button type="button" class="btn" id="btn-save">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	let showHistory = false
	let standar = `<?= $standar ?>`,
		competency = `<?= $competency ?>`,
		competency_id = `<?= $competency_id ?>`,
		standar_id = `<?= $role_id ?>`
	$(document).ready(function() {

		$('#view-upload').change(function() {
			let filename = document.getElementById('view-upload').files[0].name
			$('label.custom-file-label').html(filename)
		})
		$('#add-upload').change(function() {
			let filename = document.getElementById('add-upload').files[0].name
			$('label.custom-file-label').html(filename)
		})

		$('#btn-add').click(async (e) => {
			let formData = new FormData()
			formData.append('gdrive', document.getElementById('add-upload').files[0])
			formData.append('competency_id', <?= $competency_id ?>)
			formData.append('judul', $('#add-title').val())
			formData.append('year', $('#add-year').val())
			formData.append('location', $('#add-location').val())
			formData.append('folderName', '<?= $competency ?>')
			formData.append('standar', standar)
			formData.append('standar_id', standar_id)
			formData.append('competency', competency)
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
						swal('Berhasil !', 'data dokumen berhasil ditambahkan', 'success')
						$('#add').modal('hide')
						$('#table').DataTable().ajax.reload()
						$('#form-add input').val('')
						$('label.custom-file-label').html('Cari file')
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

		$('#btn-save').click(async (e) => {
			let formData = new FormData()
			formData.append('gdrive', document.getElementById('view-upload').files[0])
			formData.append('competency_id', <?= $competency_id ?>)
			formData.append('id', $('#view-id').val())
			formData.append('judul', $('#view-title').val())
			formData.append('year', $('#view-year').val())
			formData.append('location', $('#view-location').val())
			formData.append('folderName', '<?= $competency ?>')
			await $('#progress-upload').fadeIn()
			await $.ajax({
				type: "POST",
				url: api + 'document/update',
				data: formData,
				processData: false,
				contentType: false,
				success: function(res) {
					$('#progress-upload').fadeOut()
					if (!res.error) {
						swal('Berhasil !', res.message, 'success')
						$('#view').modal('hide')
						$('#table').DataTable().ajax.reload()
						$('#form-view input').val('')
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

		$('#btn-history').click(function(e) {
			if (showHistory) {
				$('#view-history-document').slideToggle()
				$('#view-status-document').slideToggle('slow')
				$('#btn-history').html(`<i class="fas fa-history" style="font-size: 2.5em;"></i>`)
				showHistory = false
			} else {
				$('#view-status-document').slideToggle()
				$('#view-history-document').slideToggle('slow')
				$('#btn-history').html(`<i class="far fa-times-circle" style="font-size: 2.5em;"></i>`)
				showHistory = true
			}
		})

		$('#btn-status').click(function(e) {
			const data = {
				id: $('#view-id').val(),
				status: $('#add-status').val(),
				note: $('#add-note').val(),
				title: $('#view-title').val()
			}
			konfirm(`mengganti status dokumen menjadi ` + $('#add-status').val()).then((yes) => {
				if (yes) {
					const req = requestPost(api + 'document/status', data)
					if (!req.error) {
						$('#add-note').val('')
						statusDocument($('#add-status').val())
						$('#table').DataTable().ajax.reload()
					}
				}
			})
		})

		$('#btn-hapus').click(function(e) {
			e.preventDefault();
			konfirm('menghapus dokumen ini dari daftar dokumen akreditasi.').then((yes) => {
				if (yes) {
					const req = requestPost(api + 'document/delete', {
						id: $('#view-id').val(),
						title: $('#view-title').val()
					})
					if (!req.error) {
						$('#table').DataTable().ajax.reload()
						$('#view').modal('hide')
					}
				}
			})
		});

		$('#btn-pengajuan, #btn-pengajuan2').click(function(e) {
			konfirm('mengajukan dokumen ini untuk divalidasi.').then((yes) => {
				if (yes) {
					const req = requestPost(api + 'document/pengajuan', {
						id: $('#view-id').val(),
						title: $('#view-title').val(),
						standar: standar,
						standar_id: standar_id,
						competency: competency,
						competency_id: competency_id,
					})
					if (!req.error) {
						statusDocument('diajukan')
						$('#table').DataTable().ajax.reload()
					}
				}
			})
		})

		$('#table').DataTable({
			ajax: api + 'document/get/<?= $competency_id ?>',
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
			footerCallback: function(row, data, start, end, display) {
				let all = data.length;
				let valid = 0;
				data.forEach(element => {
					if (element.status == 'tervalidasi')
						++valid;
				});
				$('#persentase').html(`${parseInt (valid==0?valid: valid/all *100)} %`)
			},
			order: [
				[4, 'asc']
			],
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
		})

		$('#table tbody').on('click', '.btn-view', function() {
			var data = $(`#table`).DataTable().row($(this).parents('tr')).data()
			for (key in data) {
				$(`#view-${key}`).val(data[key])
			}
			$('#view-note').text(data.note)
			$('label.view-l').html('<span class="text-success">data dokumen<span/>')
			$('.view-link').attr('href', data.link)
			printHistory(data.id)
			statusDocument(data.status)
			$('#view').modal('show')
		})
	});

	const formStatus = () => $('#formStatus').toggle()

	const status = (params) => {
		if (params == 'tervalidasi')
			return `<div class="badge badge-info w-100">Tervalidasi</div>`;
		else if (params == 'terdata')
			return `<div class="badge badge-default w-100">Terdata</div>`;
		else if (params == 'diajukan')
			return `<div class="badge badge-secondary w-100">Diajukan</div>`;
		else if (params == 'revisi')
			return `<div class="badge badge-warning w-100">Revisi</div>`;
		else
			return `<div class="badge badge-light w-100">Tidak sesuai kondisi</div>`;
	}

	const statusDocument = (status) => {
		$('#btn-save, #btn-hapus').prop('disabled', true)
		$('#terdata, #diajukan, #tervalidasi, #revisi, #formStatus').hide()
		if (status == 'diajukan') {
			$('#formStatus, #diajukan').show()
			$('#form-view input').prop("disabled", true)
		} else if (status == 'tervalidasi') {
			$('#form-view input').prop("disabled", true)
			$('#tervalidasi').show()
		} else if (status == 'revisi') {
			$('#btn-save, #form-view input').prop('disabled', false)
			$('#revisi').show()
		} else {
			$('#btn-save, #form-view input, #btn-hapus').prop('disabled', false)
			$('#terdata').show()
		}

	}


	const printHistory = (id) => {
		let hist = ""
		const req = requestGet(api + 'history/get/' + id)
		req.data.forEach(element => {
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
		$('#view-history-document').html(hist)
	}
</script>
