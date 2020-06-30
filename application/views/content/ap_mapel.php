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
<div id="add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<form id="form-add" class="form-add">
				<div class="modal-body" id="form-data">
					<div class="row">
						<div class="col-md-4">
						</div>
						<div class=" col-md-8">
							<div class="form-group">
								<label for="add-mapel">Mata Pelajaran</label>
								<input id="add-mapel" class="form-control" type="text" name="mapel">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Batal</button>
					<button class="btn btn-primary" id="btn-save" type="submit">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div id="view" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah <?= $title ?></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<form id="form-view" class="form-view">
				<div class="modal-body" id="form-data">
					<div class="row">
						<div class="col-md-4">
						</div>
						<div class=" col-md-8">
							<div class="form-group">
								<label for="view-mapel">Mata Pelajaran</label>
								<input id="view-id" class="form-control" type="number" name="id" hidden readonly>
								<input id="view-mapel" class="form-control" type="text" name="mapel">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Batal</button>
					<button class="btn btn-primary" id="btn-save" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#table').DataTable({
			ajax: api + 'mapel/get',
			columns: [{
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					},
					className: "text-center"
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
			$('#view').modal('show')
		})

		$(`#table tbody`).on('click', '.btn-delete', function() {
			var data = $(`#table`).DataTable().row($(this).parents('tr')).data()
			konfirm(`Apakah yakin untuk menghapus ${data.mapel} ?`).then((isDelete) => {
				if (isDelete) {
					const res = requestPost(api + 'mapel/delete', {
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
			const res = requestPost(api + 'mapel/create', data)
			if (!res.error) {
				$('#form-add input').val('')
				$('#add').modal('hide')
				$('#table').dataTable().api().ajax.reload()
			}
		});

		$('#form-view').submit(function(e) {
			e.preventDefault();
			let data = $('#form-view').serialize()
			const res = requestPost(api + 'mapel/update', data)
			if (!res.error) {
				$('#form-view input').val('')
				$('#view').modal('hide')
				$('#table').dataTable().api().ajax.reload()
			}
		});
	})
</script>
