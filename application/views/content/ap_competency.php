<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title ?></h1>
		</div>

		<?php
		if ($this->session->status == 'penanggung jawab') { ?>
			<button class="btn btn-info " data-toggle="modal" data-target="#add" style="position: fixed; bottom: 36px;   right: 20px; padding: 18.5px;z-index: 10;">
				<i class="fa fa-plus"></i>
			</button>
		<?php
		} ?>
	</section>

	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body row up" id="kompetensi">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="view" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Kompetensi <?= $standar ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<form id="form-view" class="form-view">
				<div class="modal-body" id="form-data">
					<div class="row">
						<div class="form-group col-9">
							<label for="view-competency">Kompetensi</label>
							<input id="view-id" class="form-control" type="number" name="id" required readonly hidden>
							<input id="view-competency" class="form-control" type="text" name="competency" placeholder="kompetensi 24">
						</div>
						<div class="form-group col-3">
							<label for="view-bobot">Bobot</label>
							<input id="view-bobot" class="form-control text-center" type="number" name="bobot" placeholder="2">
						</div>
					</div>

					<div class="form-group">
						<label for="view-details">Deskripsi</label>
						<textarea id="view-details" class="form-control" name="details"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default delete" id="btn-delete">Hapus</button>
					<button class="btn btn-primary" id="btn-save" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Kompetensi <?= $standar ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<form id="form-add" class="form-add">
				<div class="modal-body" id="form-data">
					<div class="row">
						<div class="form-group col-9">
							<label for="add-competency">Kompetensi</label>
							<input id="add-role_id" class="form-control" type="number" name="role_id" required readonly hidden value="<?= $role_id ?>">
							<input id="add-competency" class="form-control" type="text" name="competency" placeholder="kompetensi 24">
						</div>
						<div class="form-group col-3">
							<label for="add-bobot">Bobot</label>
							<input id="add-bobot" class="form-control text-center" type="number" name="bobot" placeholder="2">
						</div>
					</div>

					<div class="form-group">
						<label for="add-details">Deskripsi</label>
						<textarea id="add-details" class="form-control" name="details" placeholder="Kesesuaian perangkat pembelajaran dengan ..."></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default " data-dismiss="modal">Batal</button>
					<button class="btn btn-primary" id="btn-add" type="submit">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		printCompetency()

		$('#form-view').submit(function(e) {
			e.preventDefault();
			let data = $('#form-view').serialize()
			konfirm('melakukan perubahan pada ' + $('#view-competency').val()).then((isSave) => {
				if (isSave) {
					const res = requestPost(api + 'competency/update', data)
					if (!res.error) {
						$('#form-view input').val('')
						$('#view').modal('hide')
						printCompetency()
					}
				}
			})
		});
		$('#form-add').submit(function(e) {
			e.preventDefault();
			let data = $('#form-add').serialize()
			const res = requestPost(api + 'competency/create', data)
			if (!res.error) {
				$('#form-add .form-control').val('')
				$('#add').modal('hide')
				printCompetency()
			}
		});
		$('#btn-delete').click(function(e) {
			e.preventDefault();
			const id = $('#view-id').val()
			konfirm('menghapus data ' + $('#view-competency').val() + ' dalam sistem.').then((isDelete) => {
				if (isDelete) {
					requestPost(api + 'competency/delete', {
						id: id
					})
					$('#view').modal('hide')
					printCompetency()
				}
			})
		});
	});
	const printCompetency = () => {
		let div = "";
		const response = requestGet(api + 'report/get?standar=<?= $role_id ?>')
		if (!response.error)
			response.data.forEach(print => {
				let infoCompetency = classText = ''
				if (print.TOTAL == print.TERVALIDASI && print.TOTAL != 0)
					infoCompetency = '<i class="mr-1 fas fa-check"></i>'
				else if (print.TOTAL > 1)
					infoCompetency = '<i class="mr-1 fab fa-telegram-plane"></i>'
				if (print.DIAJUKAN > 0)
					classText = 'text-warning'

				div += `<div class="card col-sm-3  shadow-none ">
							<div class="card-body shadow-sm rounded">
							<?php if ($this->session->status == 'penanggung jawab') { ?>
								<div class="d-flex flex-wrap justify-content-end align-items-center mr-0">
									<i class="fa fa-edit click edit" onclick="view('${print.COMPETENCY_ID}','${print.COMPETENCY}','${print.BOBOT}','${print.DETAILS}')"></i>
								</div>
							<?php } ?>
                                <a href="<?= base_url() . 'admin/akreditasi/' . $slug ?>/${print.COMPETENCY}~${print.COMPETENCY_ID}" class="${classText} text-decoration-none">
                                    <h5 class="card-title">${print.COMPETENCY}</h5>
                                    <hr>
                                    <p class="card-text">${print.DETAILS} (${infoCompetency} <span class="text-dark">${print.BOBOT} pt</span>).</p>
                                </a>
                            </div>
                        </div>`;
			});
		$('#kompetensi').html(div)
	}
	const view = (id, competency, bobot, details) => {
		$('#view-id').val(id)
		$('#view-competency').val(competency)
		$('#view-bobot').val(bobot)
		$('#view-details').val(details)
		$('#view').modal('show')
	}
</script>
