<div class="col-lg-11"><h3>Tipe Barang</h2></div>
<div class="col-lg-1 text-right">
	<a href="<?php echo site_url('welcome/tambah_pelanggan');?>"> 
		<button class="btn btn-danger text-right" style="margin-top:15px;"><i class="fa fa-fw fa-plus"></i></button>
	</a>
</div>
<br />
<br />
<br />

<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4>Pelanggan</h4>
				</div>
				<div class="box-body">
					<form class="form-horizontal" method="post" action="<?php echo site_url('welcome/doupdate_pelanggan');?>">
						<?php foreach($data as $data2){ ?>
						<div class="col-lg-6 form-group">
							<input type="hidden" name="kode_pelanggan" value="<?php echo $data2->kode_pelanggan;?>" />
							<label class="col-lg-3">Nama Toko</label>
							<div class="col-lg-9">
								<input type="text" name="toko_pelanggan" class="col-lg-12 form-control" value="<?php echo $data2->toko_pelanggan;?>" />
							</div>
							<br /><br /><br />
							<label class="col-lg-3">Nama PIC</label>
							<div class="col-lg-9">
								<input type="text" name="pic_pelanggan" class="col-lg-12 form-control" value="<?php echo $data2->pic_pelanggan;?>" />
							</div>
							<br /><br /><br />
						</div>
						<div class="col-lg-6">
							<label class="col-lg-3">Alamat</label>
							<div class="col-lg-9">
								<input type="text" name="alamat_pelanggan" class="col-lg-12 form-control" value="<?php echo $data2->alamat_pelanggan;?>"/>
							</div>
							<br /><br /><br />
							<label class="col-lg-3">No. Telp</label>
							<div class="col-lg-9">
								<input type="number" name="telp_pelanggan" class="col-lg-12 form-control" value="<?php echo $data2->telp_pelanggan;?>" />
							</div>
							<br /><br /><br />
							<div class="col-lg-8">
							</div>
							<div class="col-lg-4 text-right">
								<button class="btn btn-info" name="action" value="hapus">Simpan <i class="fa fa-arrow-circle-right" style="margin-left:10px;"></i></button> 
								<button class="btn btn-danger" name="action" value="hapus">Hapus <i class="fa fa-arrow-circle-right" style="margin-left:10px;"></i></button> 
							</div>
						</div> <?php } ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>