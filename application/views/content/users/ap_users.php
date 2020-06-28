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
											<th>Kontak</th>
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
				<h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<form id="form-add" class="form-add">
				<div class="modal-body" id="form-data">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="add-full_name">Nama Lengkap</label>
								<input id="add-full_name" class="form-control" type="text" name="full_name" required>
							</div>
							<div class="form-group">
								<label for="add-access">Hak Akses</label>
								<div class="row container" id="add-access">
								</div>
							</div>
						</div>
						<div class=" col-md-8">
							<div class="row">
								<div class="form-group col">
									<label for="add-password">Password</label>
									<input id="add-password" class="form-control" type="password" name="password">
								</div>
								<div class="form-group col">
									<label for="add-password_confirmation">Password Konfirmasi</label>
									<input id="add-password_confirmation" class="form-control" type="password" name="password_confirmation">
								</div>
							</div>
							<div class="row">
								<div class="form-group col">
									<label for="add-phone">Kontak</label>
									<input id="add-phone" class="form-control" type="number" name="phone">
								</div>
								<div class="form-group col">
									<label for="add-email">Email</label>
									<input id="add-email" class="form-control" type="email" name="email">
								</div>
							</div>
							<div class="form-group">
								<label for="add-address">Alamat</label>
								<textarea id="add-address" class="form-control" name="address" rows="3"></textarea>
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

<script>
	$(document).ready(function() {
		const users = requestGet(api + 'role/get')
		access(users.data)

		$('#table').DataTable({
			"ajax": base_url + 'account/users/get',
			"columns": [{
					"render": function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					},
					className: "text-center"
				}, {
					"data": "full_name"
				}, {
					"data": "phone"
				},
				{
					"render": function(data, type, JsonResultRow, meta) {
						return `<button class="btn btn-light btn-delete mr-1"><i class="fas fa-trash"></i></button>
						<button class="btn btn-primary btn-view"><i class="fa fa-eye"></i> Detail </button>`
					}
				}
			]
		})

		$(`#table tbody`).on('click', '.btn-delete', function() {
			var data = $(`#table`).DataTable().row($(this).parents('tr')).data()
			confirm(`Apakah yakin untuk menghapus ${data.full_name} sebagai pengguna?`).then((isDelete) => {
				if (isDelete) {
					const res = requestPost(base_url + 'account/users/delete', {
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
			const res = requestPost(base_url + 'account/register', data)
			if (!res.error) {
				$('#form-add input[name*=access]').prop('checked', false)
				$('#form-add input').val('')
				$('#add').modal('hide')
				$('#table').dataTable().api().ajax.reload()
			}
		});
	})

	const access = (users) => {
		let checkbox = ""
		users.forEach(element => {
			checkbox += `<div class="custom-control custom-checkbox col-6"><input type="checkbox" class="custom-control-input" name="access[]" id="${element.id}" value="${element.id}"><label class="custom-control-label" for="${element.id}"> ${element.role}</label></div>`;
		})
		$('#add-access').append(checkbox)
	}
</script>
