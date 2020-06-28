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
      								<img class="rounded" style="height: 250px; width: 250px; object-fit:cover" src="<?= $this->session->userdata('foto') == '' ? 'https://vignette.wikia.nocookie.net/kdramas/images/a/a2/Ba8834c165874ef091d90cc567909c9c.png/revision/latest/top-crop/width/720/height/900?cb=20190803070125' : $this->session->userdata('foto'); ?>" alt="gambar profil">
      							</div>
      							<div class="">
      								<label for="view-full_name">Nama Lengkap</label>
      								<input name="full_name" id="view-full_name" class="bg-light form-control text-center" type="text" value="<?= $this->session->userdata('full_name'); ?>">
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
      									<label for="view-phone">Phone</label>
      									<input name="phone" id="view-phone" class="form-control" type="number" value="<?= $this->session->userdata('phone'); ?>">
      								</div>

      								<div class="form-group">
      									<label for="view-email">Email</label>
      									<input name="email" id="view-full_name" class="form-control" type="email" value="<?= $this->session->userdata('email'); ?>">
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
      <script>
      	$('#form-view').submit(function(e) {
      		e.preventDefault();
      		let data = $('#form-view').serialize()
      		const req = requestPost(base_url + 'account/update', data)
      	});
      </script>
