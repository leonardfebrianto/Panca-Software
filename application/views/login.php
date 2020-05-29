<!DOCTYPE html>
<html>
<head>
  <title>AdminLTE 2 | General Form Elements</title>
  <link rel="stylesheet" href="<?php echo base_url();?>assets/component/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/component/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/component/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="login">
	<div class="row" style="margin:0;">
		<div class="col-lg-6">
		</div>
		<div class="col-lg-4">
			<div class="card centered">
				<div class="card-body">
					<div class="col-lg-12">
						<center>
							<img src="<?php echo base_url();?>assets/pict/profile.png" class="rounded-circle" width="80px"/> <br /><br />
							<h4><b>CV. PANCA CIPTA MAKMUR</b></h4><br />
							<form class="form form-group" method="POST" action="<?php echo site_url('welcome/login');?>">
								<input class="form-control" type="text" name="username" placeholder="Username" /><br />
								<input class="form-control" type="password" name="password" placeholder="Password" /><br /><br />
								<!--<button class="btn btn-danger btn-block" type="submit">Login</button>-->
								<button class="btn btn-danger btn-block">Login</button>
							</form>
							<?php 
							if($this->session->flashdata('login'))
							{
								?>
								<div class="col-lg-12 alert alert-danger">
									Username atau Password salah
								</div>
								<?php
							}
							?>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/component/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/component/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
</body>
</html>
