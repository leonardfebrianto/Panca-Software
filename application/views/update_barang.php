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
					<div class="col-lg-12">
						<h4>Barang</h4>
					</div>
				</div>
				<div class="box-body">
					<form class="form-horizontal" method="post" action="<?php echo site_url('Welcome/doupdate_barang');?>">
					<?php foreach($data as $data2){ ?>
						<div class="col-lg-6 form-group">
							<input type="hidden" value="<?php echo $data2->kode_barang;?>" name="kode_barang" />
							<label class="col-lg-3">Nama Barang</label>
							<div class="col-lg-9">
								<input type="text" name="nama_barang" class="col-lg-12 form-control" value="<?php echo $data2->nama_barang;?>"/>
							</div>
							<br /><br /><br />
							<input type="hidden" value="<?php echo $data2->kode_barang;?>" name="kode_barang" />
							<label class="col-lg-3">Stok</label>
							<div class="col-lg-9">
								<input type="text" name="stokx" class="col-lg-12 form-control" value="<?php echo $data2->stok;?>"/>
							</div>
							<br /><br /><br />
						</div>
						<div class="col-lg-6">
							<label class="col-lg-3">Harga Modal</label>
							<div class="col-lg-9">
								<input type="number" name="harga_barang" class="col-lg-12 form-control" value="<?php echo $data2->harga_barang;?>"/>
							</div>
							<br /><br /><br />
							<div class="col-lg-8">
							</div>
							<div class="col-lg-4 text-right">
								<button class="btn btn-info" name="action" value="simpan">Simpan <i class="fa fa-arrow-circle-right" style="margin-left:10px;"></i></button> 
								<button class="btn btn-danger" name="action" value="hapus">Hapus <i class="fa fa-arrow-circle-right" style="margin-left:10px;"></i></button> 
							</div>
						</div>
						<div class="col-lg-6 form-group">
							<input type="hidden" value="<?php echo $data2->kode_barang;?>" name="kode_barang" />
							<label class="col-lg-3">Nama Barang</label>
							<div class="col-lg-9">
								<input type="text" name="nama_barang" class="col-lg-12 form-control" value="<?php echo $data2->nama_barang;?>"/>
							</div>
							<br /><br /><br />
							<input type="hidden" value="<?php echo $data2->kode_barang;?>" name="kode_barang" />
							<label class="col-lg-3">Stok</label>
							<div class="col-lg-9">
								<input type="text" name="stokx" class="col-lg-12 form-control" value="<?php echo $data2->stok;?>"/>
							</div>
							<br /><br /><br />
						</div>
						<div class="col-lg-6 form-group">
							<input type="hidden" value="<?php echo $data2->kode_barang;?>" name="kode_barang" />
							<label class="col-lg-3">Nama Barang</label>
							<div class="col-lg-9">
								<input type="text" name="nama_barang" class="col-lg-12 form-control" value="<?php echo $data2->nama_barang;?>"/>
							</div>
							<br /><br /><br />
							<input type="hidden" value="<?php echo $data2->kode_barang;?>" name="kode_barang" />
							<label class="col-lg-3">Stok</label>
							<div class="col-lg-9">
								<input type="text" name="stokx" class="col-lg-12 form-control" value="<?php echo $data2->stok;?>"/>
							</div>
							<br /><br /><br />
						</div>
					<?php } ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>