<div class="col-lg-11">
	<h3>User</h3>
</div>
<br />
<br />
<br />
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-lg-12">
						<h4>Admin</h4>
					</div>
				</div>
				<div class="box-body">
					<form class="form-horizontal" method="post" action="<?php echo site_url('welcome/doupdate_admin');?>">
						<?php foreach($data as $data2){ ?>
						<div class="col-lg-6 form-group">
							<label class="col-lg-3">Username</label>
							<div class="col-lg-9">
								<input type="text" name="username" class="col-lg-12 form-control" value="<?php echo $data2->username;?>" />
							</div>
							<br /><br /><br />
							<label class="col-lg-3">Password</label>
							<div class="col-lg-9">
								<input type="password" name="password" class="col-lg-12 form-control" />
							</div>
							<br /><br /><br />
						</div>
						<div class="col-lg-6">
							<label class="col-lg-3">Konfirmasi Password</label>
							<div class="col-lg-9">
								<input type="password" name="konfirmasi_password" class="col-lg-12 form-control" />
							</div>
							<br /><br /><br />
							<div class="col-lg-8">
							</div>
							<div class="col-lg-4 text-right">
								<button class="btn btn-block btn-info">Simpan <i class="fa fa-arrow-circle-right" style="margin-left:10px;"></i></button> 
							</div>
						</div>

						<?php } ?>
					</form>
						<?php if($this->session->flashdata('password')){ ?>
						<div class="col-lg-12 alert alert-danger">
							Password tidak sama
						</div>
						<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>