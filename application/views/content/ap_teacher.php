<div class="main-content">
	<section class="section">
		<div class="section-header d-block justify-content-start align-items-center">
			<h1 class="pt-2 pb-2 mt-0 ml-3"><?= $title ?></h1>
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
											<th class="text-center" width="10%">No.</th>
											<th>Nama</th>
											<th>Mapel</th>
											<th width="20%">Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="add">
	<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Menambahkan <?= $title ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<form id="form-add" name="form-add" method="post">
				<div class="modal-body row" id="form-data">
					<div class="col-sm-4 border-right">
						<div class="form-group">
							<label for="add-mapel">Mata Pelajaran</label>
							<select class="custom-select" id="add-mapel" name="mapel_id">
							</select>
						</div>
						<div class="form-group">
							<label for="add-nip">Nip</label>
							<input id="add-nip" class="form-control" type="number" name="nip" min="0">
						</div>
						<div class="form-group">
							<label for="add-last_ed">Pendidikan Terakhir</label>
							<select class="custom-select" id="add-last_ed" name="last_ed">
								<option value="SMA/MA">SMA/MA</option>
								<option value="D1">D1</option>
								<option value="D2">D2</option>
								<option value="D3">D3</option>
								<option value="S1/D4">S1/D4</option>
								<option value="S2">S2</option>
								<option value="S3">S3</option>
							</select>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="form-group">
							<label for="add-teacher_name">Nama Lengkap</label>
							<input type="text" class="form-control" id="add-teacher_name" name="teacher_name">
						</div>
						<div class="form-group">
							<label for="add-address">Alamat Lengkap</label>
							<input id="add-address" class="form-control" type="text" name="address">
						</div>
						<div class="row">
							<div class="form-group col">
								<label for="add-phone">Nomor Telepon</label>
								<input id="add-phone" class="form-control" type="number" name="phone">
							</div>
							<div class="form-group col">
								<label for="add-email">E-mail</label>
								<input id="add-email" class="form-control" type="email" name="email">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-default" data-dismiss="modal">Batal</button>
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
				<h5 class="modal-title" id="exampleModalLabel">Detail <?= $title ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<form id="form-view" name="form-view" method="post">
				<input type="number" id="view-id" name="id" readonly hidden>
				<div class="modal-body row" id="form-data">
					<div class="col-sm-4 border-right">
						<div class="form-group">
							<label for="view-mapel">Mata Pelajaran</label>
							<select class="custom-select" id="view-mapel" name="mapel_id">
							</select>
						</div>
						<div class="form-group">
							<label for="view-nip">Nip</label>
							<input id="view-nip" class="form-control" type="number" name="nip" min="0">
						</div>
						<div class="form-group">
							<label for="view-last_ed">Pendidikan Terakhir</label>
							<select class="custom-select" id="view-last_ed" name="last_ed">
								<option value="SMA/MA">SMA/MA</option>
								<option value="D1">D1</option>
								<option value="D2">D2</option>
								<option value="D3">D3</option>
								<option value="S1/D4">S1/D4</option>
								<option value="S2">S2</option>
								<option value="S3">S3</option>
							</select>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="form-group">
							<label for="view-teacher_name">Nama Lengkap</label>
							<input type="text" class="form-control" id="view-teacher_name" name="teacher_name">
						</div>
						<div class="form-group">
							<label for="view-address">Alamat Lengkap</label>
							<input id="view-address" class="form-control" type="text" name="address">
						</div>
						<div class="row">
							<div class="form-group col">
								<label for="view-phone">Nomor Telepon</label>
								<input id="view-phone" class="form-control" type="number" name="phone">
							</div>
							<div class="form-group col">
								<label for="view-email">Email</label>
								<input id="view-email" class="form-control" type="email" name="email">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-info">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		getMapel()
		$('#table').DataTable({
			ajax: api + 'teacher/get',
			columns: [{
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					},
					className: "text-center"
				}, {
					data: "teacher_name"
				}, {
					data: "mapel"
				},
				{
					render: function(data, type, JsonResultRow, meta) {
						return `<button class="btn btn-light btn-delete mr-1"><i class="fas fa-trash"></i></button>
						<button class="btn btn-primary btn-view"><i class="fa fa-eye"></i> Detail </button>`
					}
				}
			]
		})
		$('#table tbody').on('click', '.btn-view', function() {
			var data = $(`#table`).DataTable().row($(this).parents('tr')).data()
			for (key in data) {
				$(`#view-${key}`).val(data[key])
			}
			$('#view-mapel').val(data.mapel_id)
			$('#view').modal('show')
		})

		$(`#table tbody`).on('click', '.btn-delete', function() {
			var data = $(`#table`).DataTable().row($(this).parents('tr')).data()
			confirm(`Apakah yakin untuk menghapus ${data.mapel} ?`).then((isDelete) => {
				if (isDelete) {
					const res = requestPost(api + 'teacher/delete', {
						id: data.id
					})
					if (!res.error)
						$(`#table`).dataTable().api().ajax.reload()
				}
			})
		})

		$('#form-add').submit(function(e) {
			e.preventDefault();
			let data = $('#form-add').serialize()
			const res = requestPost(api + 'teacher/create', data)
			if (!res.error) {
				$('#form-add input').val('')
				$('#add').modal('hide')
				$('#table').dataTable().api().ajax.reload()
			}
		});

		$('#form-view').submit(function(e) {
			e.preventDefault();
			let data = $('#form-view').serialize()
			const res = requestPost(api + 'teacher/update', data)
			if (!res.error) {
				$('#form-view input').val('')
				$('#view').modal('hide')
				$('#table').dataTable().api().ajax.reload()
			}
		});
	})

	const getMapel = () => {
		const response = requestGet(api + 'mapel/get')
		if (!response.error) {
			(response.data).forEach(data => {
				$('#add-mapel, #view-mapel').append('<option value="' + data.id + '">' + data.mapel + '</option>');
			});
		}
	}
</script>
