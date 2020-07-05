      <!-- Main Content -->

      <div class="main-content">
      	<section class="section">
      		<div class="section-header d-block justify-content-start align-items-center">
      			<h1 class="pt-2 pb-2 mt-0 ml-3"><?= $title ?></h1>
      		</div>
      		<form id="form-view" name="form-view" method="post">
      			<div class="section-body">
      				<div class="row mt-sm-4">
      					<div class="col-12 col-md-12 col-lg-5">
      						<div class="card text-center">
      							<div class="my-3">
      								<img id="view-profil" class="rounded" style="height: 250px; width: 250px; object-fit:cover" src="<?= $this->session->photo == '' ? 'https://4.bp.blogspot.com/-pQD-irIgjU0/V5SSGHNCC7I/AAAAAAAAEsI/2UEF1E1m7LA02zWyJJdHGoUbUDk22-YLgCLcB/s72-w680-c/Song%2BJoong-Ki%2Bsebagai%2BYoo%2BShi-Jin%2B3.png' : base_url() . $this->session->photo ?>" alt="gambar profil">
      							</div>
      							<div class="text-center">
      								<span class="click" onclick="upload()">Ganti Foto Profil</span>
      								<input id="view-status" class="text-capitalize bg-light form-control text-center" type="text" value="<?= $this->session->userdata('status'); ?>" readonly>
      							</div>
      						</div>
      					</div>
      					<div class="col-12 col-md-12 col-lg-7">
      						<div class="card">
      							<div class="card-header">
      								<h4>Edit Profile</h4>
      							</div>
      							<div class="card-body">
      								<div class="form-group">
      									<label for="view-full_name">Nama Lengkap</label>
      									<input name="full_name" id="view-full_name" class="form-control" type="text" value="<?= $this->session->userdata('full_name'); ?>">
      								</div>
      								<div class="form-group">
      									<label for="view-full_name">Username</label>
      									<div class="d-flex justify-content-between">
      										<input name="username" id="view-username" class="form-control col-10" type="text" value="<?= $this->session->userdata('username'); ?>">
      										<button class="btn btn-dark col-1 fas fa-unlock-alt" data-toggle="modal" data-target="#change-password" type="button"></button>
      									</div>
      								</div>
      								<div class="form-group">
      									<label for="view-phone">Phone</label>
      									<input name="phone" id="view-phone" class="form-control" type="number" value="<?= $this->session->userdata('phone'); ?>">
      								</div>

      								<div class="form-group">
      									<label for="view-email">Email</label>
      									<input name="email" id="view-email" class="form-control" type="email" value="<?= $this->session->userdata('email'); ?>">
      								</div>

      								<div class="form-group">
      									<label for="view-address">Alamat</label>
      									<textarea name="address" id="view-address" class="form-control"><?= $this->session->userdata('address'); ?></textarea>
      								</div>
      							</div>
      							<div class="card-footer text-right">
      								<button class="btn btn-primary" id="btn-save" type="submit">Simpan Perubahan</button>
      							</div>
      						</div>
      					</div>
      				</div>
      			</div>
      		</form>
      	</section>
      </div>

      <div id="change-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
      	<div class="modal-dialog modal-dialog-centered" role="document">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="my-modal-title">Ubah Password</h5>
      				<button class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      			</div>
      			<form id="form-password" class="form-password">
      				<div class="modal-body">
      					<div class="form-group">
      						<label for="password-old">Password Lama</label>
      						<input id="password-old" class="form-control" type="password" name="password_old">
      					</div>
      					<div class="form-group">
      						<label for="password-new">Password baru</label>
      						<input id="password-new" class="form-control" type="password" name="password_new">
      					</div>
      					<div class="form-group">
      						<label for="password-confirmation">Password Konfirmasi</label>
      						<input id="password-confirmation" class="form-control" type="password" name="password_confirmation">
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

      <div id="upload" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      	<div class="modal-dialog modal-dialog-centered" role="document">
      		<div class="modal-content">
      			<div class="modal-body">
      				<div class="form-group">
      					<label>Upload Foto Profil</label>
      					<div class="input-group">
      						<div class="custom-file">
      							<!-- <input type="text" class="custom-file-input" id="view-photo" name="photo" hidden readonly> -->
      							<input type="file" class="custom-file-input" id="view-photo" aria-describedby="btn-upload">
      							<label class="custom-file-label" for="view-photo">Cari file</label>
      						</div>
      					</div>
      				</div>
      				<div class="d-flex justify-content-center w-100 ">
      					<img style="display:none" src="" alt="photo profil" id="prev-view-photo" class="w-75 text-center">
      				</div>
      			</div>
      			<div class="modal-footer">
      				<button class="btn btn-default" data-dismiss="modal">Batal</button>
      				<button class="btn btn-primary" type="button" id="btn-upload">Upload</button>
      			</div>
      		</div>
      	</div>
      </div>
      <script>
      	$('#view-photo').change(function() {
      		let filename = document.getElementById('view-photo').files[0].name
      		$('label.custom-file-label').html(filename)
      		$('#prev-view-photo').show()
      	})

      	$("#view-photo").change(function() {
      		readURL(this)
      	})


      	$('#btn-upload').click(async function(e) {
      		if (document.getElementById('view-photo').files[0] == undefined) {
      			$('label.custom-file-label').html('<span class="text-danger">Pilih file terlebih dahulu</span>');
      		} else {
      			let formData = new FormData();
      			formData.append('photo', document.getElementById('view-photo').files[0])
      			const req = requestPost(base_url + 'account/update/photo', formData, true)
      			if (!req.error) {
      				$('#upload').modal('hide')
      				var reader = new FileReader()
      				reader.onload = function(e) {
      					$('#view-profil').attr('src', e.target.result)
      				}
      				reader.readAsDataURL(document.getElementById('view-photo').files[0])
      			}
      		}
      	});

      	const readURL = (input) => {
      		if (input.files && input.files[0]) {
      			var reader = new FileReader()
      			reader.onload = function(e) {
      				$('#prev-view-photo').attr('src', e.target.result)
      			}
      			reader.readAsDataURL(input.files[0])
      		}
      	}
      	const upload = () => $('#upload').modal('show')
      	$('#form-view').submit(function(e) {
      		e.preventDefault()
      		konfirm('melakukan pembaruan biodata diri').then((isSave) => {
      			let data = $('#form-view').serialize()
      			if (isSave)
      				requestPost(base_url + 'account/update', data)
      		})
      	});
      	$('#form-password').submit(function(e) {
      		e.preventDefault();
      		konfirm('mengubah password akun kamu').then((yes) => {
      			const req = requestPost(base_url + 'account/reset_password', $('#form-password').serialize())
      			if (!req.error) {
      				$('#change-password').modal('hide')
      				$('input[type=password]').val('')
      			}
      		})
      	});
      </script>
