<div class="col-lg-11">
	<h3>Tipe Barang</h3>
</div>
<br />
<br />
<br />
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="col-lg-11">
						<h4>Barang</h4>
					</div>
					<div class="col-lg-1 text-right">
						<div class="col-lg-12">
							<a href="<?php echo site_url('welcome/tambah_barang');?>"> 
								<button class="btn btn-danger text-right" style="margin-top:15px;"><i class="fa fa-fw fa-plus"></i></button>
							</a>
						</div>
					</div>
				</div>
				<div class="box-body">
					<form class="form-horizontal" method="post" action="<?php echo site_url('Welcome/save_barang');?>">
						<div class="col-lg-6 form-group">
							<label class="col-lg-3">Nama Barang</label>
							<div class="col-lg-9">
								<input type="text" name="nama_barang" class="col-lg-12 form-control" />
							</div>
							<br /><br /><br />
							<label class="col-lg-3">Stok</label>
							<div class="col-lg-9">
								<input type="text" name="stok" class="col-lg-12 form-control" />
							</div>
							<br /><br /><br />
						</div>
						<div class="col-lg-6">
							<label class="col-lg-3">Harga Modal</label>
							<div class="col-lg-9">
								<input type="number" name="harga_barang" class="col-lg-12 form-control" />
							</div>
							<br /><br /><br />
							<div class="col-lg-8">
							</div>
							<div class="col-lg-4 text-right">
								<button class="btn btn-block btn-info">Simpan <i class="fa fa-arrow-circle-right" style="margin-left:10px;"></i></button> 
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>