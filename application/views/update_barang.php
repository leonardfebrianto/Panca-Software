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
							<label class="col-lg-3">Stok</label>
							<div class="col-lg-9">
								<input type="text" name="stokx" class="col-lg-12 form-control" value="<?php echo $data2->stok;?>" readonly/>
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
					<?php } ?>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="box-body">
					<form class="form-horizontal" method="post" action="<?php echo site_url('Welcome/doupdate_history_barang');?>">
						<div class="box-header with-border">
							<div class="col-lg-12">
								<h4>Tambah Stok</h4>
							</div>
						</div>
						<br />
						<div class="col-lg-6 form-group">
							<input type="hidden" value="<?php echo $data2->kode_barang;?>" name="id_barang" />
							<input type="hidden" value="<?php echo $data2->stok;?>" name="stok" />
							<label class="col-lg-3">Toko</label>
							<div class="col-lg-9">
								<select name="kode_supplier" id="kode_supplier" required class="col-lg-12 form-control">
										<option value="" selected disabled>--Pilih Supplier--</option>
								<?php foreach($data_supplier as $value){ ?>
										<option value="<?php echo $value->kode_supplier;?>"><?php echo $value->toko_supplier;?></option>
								<?php } ?>
									</select>
							</div>
							<br /><br /><br />
							<label class="col-lg-3">Jumlah Barang</label>
							<div class="col-lg-9">
								<input type="number" name="jumlah_barang" class="col-lg-12 form-control" value=""/>
							</div>
							<br /><br /><br />
							<label class="col-lg-3">Harga Modal</label>
							<div class="col-lg-9">
								<input type="number" name="harga_modal" class="col-lg-12 form-control" value=""/>
							</div>
							<br /><br /><br />
						</div>
						<div class="col-lg-6">
							<label class="col-lg-3">Tanggal Masuk</label>
							<div class="col-lg-9">
								<input type="date" name="tanggal_masuk" required value="<?php echo date('Y-m-d');?>" class="col-lg-12 form-control" />
							</div>
							<br /><br /><br />
							<label class="col-lg-3">Ongkir</label>
							<div class="col-lg-9">
								<input type="number" name="ongkir" class="col-lg-12 form-control" value=""/>
							</div>
							<br /><br /><br />
							<div class="col-lg-8">
							</div>
							<div class="col-lg-4 text-right">
								<button class="btn btn-info" name="action" value="simpan">Tambah <i class="fa fa-arrow-circle-right" style="margin-left:10px;"></i></button> 
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="box-body">
						<div class="box-header with-border">
							<div class="col-lg-12">
								<h4>History Stok</h4>
							</div>
						</div>
						<br />
						<table id="tablejobfile" class="table table-bordered table-striped col-md-12">
							<thead>
								<tr>
									<th width="5px">No</th>
									<th>Toko</th>
									<th>Tanggal Masuk</th>
									<th>Jumlah Barang</th>
									<th>Harga Modal</th>
									<th>Ongkir</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="tbody">
							<?php 
								$i = 0;
								foreach($data_stok as $value3)
								{
									$i++;
							?>
								<tr>
									<td><?php echo $i;?></td>
									<td><?php echo $value3->toko_supplier;?></td>
									<td><?php echo $value3->tanggal_masuk;?></td>
									<td><?php echo $value3->jumlah_barang;?></td>
									<td><?php echo $value3->harga_modal;?></td>
									<td><?php echo $value3->ongkir;?></td>
								</tr>
							<?php
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="box-body">
						<div class="box-header with-border">
							<div class="col-lg-12">
								<h4>History Transaksi</h4>
							</div>
						</div>
						<br />
						<table id="tablejobfile" class="table table-bordered table-striped col-md-12">
							<thead>
								<tr>
									<th width="5px">No</th>
									<th>Marketplace</th>
									<th>No. Transaksi</th>
									<th>Jumlah Barang</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody id="tbody">
							<?php 
								$i = 0;
								foreach($data_transaksi as $value4)
								{
									$i++;
							?>
								<tr>
									<td><?php echo $i;?></td>
									<td><?php echo $value4->id_transaksi;?></td>
									<td><?php echo $value4->marketplace;?></td>
									<td><?php echo $value4->nota_transaksi;?></td>
									<td><?php echo $value4->jumlah_barang;?></td>
									<td><?php echo $value4->tanggal_barang;?></td>
								</tr>
							<?php
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>