<div class="col-lg-11">
	<h3>Transaksi</h3>
</div>
<br />
<br />
<br />
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<form class="form-horizontal" method="post" action="<?php echo site_url('welcome/save_transaksi');?>">
					<div class="col-lg-6">
						<h4>Penjualan</h4>
					</div>
					<div class="col-lg-6 text-right">
						<button class="btn btn-danger">Simpan <i class="fa fa-arrow-circle-right" style="margin-left:10px;"></i></button> 
					</div>
				</div>
				<div class="box-body">
						<div class="col-lg-6 form-group">
							<label class="col-lg-3">Tanggal</label>
							<div class="col-lg-9">
								<input type="date" name="tanggal" required value="<?php echo date('Y-m-d');?>" class="col-lg-12 form-control" />
							</div>
							<br /><br /><br />
							<label class="col-lg-3">Pelanggan</label>
							<div class="col-lg-9">
								<select name="pelanggan" id="pelanggan" required class="col-lg-12 form-control">
									<option value="" selected disabled>--Pilih Pelanggan--</option>
							<?php foreach($data2 as $value){ ?>
									<option value="<?php echo $value->kode_pelanggan;?>"><?php echo $value->toko_pelanggan;?></option>
							<?php } ?>
								</select>
							</div>
							<br /><br /><br />
							
						</div>
						<div class="col-lg-6">
							<label class="col-lg-3">Nota</label>
							<div class="col-lg-9">
								<input type="text" name="nota" required class="col-lg-12 form-control" />
							</div>
							<br /><br /><br />
							<label class="col-lg-3">Diskon</label>
							<div class="col-lg-9">
								<input type="text" name="diskon" class="col-lg-12 form-control" />
							</div>
						</div>
						<?php if ($this->session->flashdata('error') != ''){?>
						<div class="col-lg-12 alert alert-danger">
							<?php  echo json_encode($this->session->flashdata('error')); ?>
						</div> <?php }?>
						<div class="col-lg-12">
							<div class="text-right">
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">Add Item</button>
							</div>
						</form>
							<br />
							<table id="tablejobfile" class="table table-bordered table-striped col-md-12">
								<thead>
									<tr>
										<th>Tipe Barang</th>
										<th>Quantity</th>
										<th>Harga Modal</th>
										<th>Harga Jual</th>
										<th>Total Modal</th>
										<th>Total Jual</th>
										<th>Profit</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="tbody">
									<?php 
									$total_profit = 0;
									function number_formatted($number,$separator=",",$currency='Rp.'){
	
										$num  =	number_format ($number , 2 , '.' , $separator);

										if($currency)
											return $currency." ".$num;
										else
											return $num; 	
									}
									foreach($data3 as $value){ 
									?>
									<tr>
										<td><?php echo $value->nama_barang;?></td>
										<td><?php echo $value->quantity;?></td>
										<td><?php echo number_formatted($value->harga_modal);?></td>
										<td><?php echo number_formatted($value->harga_jual);?></td>
										<td><?php $total_modal = $value->harga_modal * $value->quantity; echo number_formatted($total_modal);?></td>
										<td><?php $total_jual = $value->harga_jual * $value->quantity; echo number_formatted($total_jual);?></td>
										<td><?php echo number_formatted($value->total_profit);?></td>
										<td><a href="<?php echo site_url()?>/welcome/delete_transaksi_temp/<?php echo $value->id;?>" ><i style="color:red;" class="glyphicon glyphicon-remove"></i></a></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-default">
  	<div class="modal-dialog">
    	<form method="post" action="<?php echo site_url('welcome/save_transaksi_temp');?>">
	    	<div class="modal-content">
	      		<div class="modal-header">
	       			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title">Default Modal</h4>
	      		</div>
		      	<div class="modal-body">
		       		<label class="col-lg-3">Tipe Barang</label>
					<div class="col-lg-9">
						<select name="tipe_barang" id="barang" class="col-lg-12 form-control">
							<option value="" selected readonly>--Pilih Barang--</option>
					<?php foreach($data as $data3){ ?>
							<option value="<?php echo $data3->kode_barang;?>"><?php echo $data3->nama_barang?></option>
					<?php } ?>
						</select>
					</div>
					<br /><br /><br />
					<label class="col-lg-3">Quantity</label>
					<div class="col-lg-9">
						<input type="number" id="quantity" name="quantity" class="col-lg-12 form-control" />
					</div>
					<br /><br /><br />
			       <label class="col-lg-3">Harga Modal</label>
					<div class="col-lg-9">
						<input type="number" name="harga_modal" id="harga_modal" class="col-lg-12 form-control" readonly />
					</div>
					<br /><br /><br />
					<label class="col-lg-3">Harga Jual</label>
					<div class="col-lg-9">
						<input type="number" id="harga_jual" name="harga_jual" class="col-lg-12 form-control" />
					</div>
					<br /><br /><br />
					<label class="col-lg-3">Total Modal</label>
					<div class="col-lg-9">
						<input type="number" id="total_modal" name="total_modal" class="col-lg-12 form-control" readonly/>
					</div>
					<br /><br /><br />
					<label class="col-lg-3">Total Jual</label>
					<div class="col-lg-9">
						<input type="number" id="total_jual" name="total_jual" class="col-lg-12 form-control" readonly />
					</div>
					<br /><br /><br />
					<label class="col-lg-3">Profit</label>
					<div class="col-lg-9">
						<input type="number" id="profit" name="profit" class="col-lg-12 form-control" readonly />
					</div>
		     	</div>
		      	<div class="modal-footer">
					<br /><br />
		        	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        	<button type="submit" class="btn btn-primary">Add Item</button>
		      	</div>
	    	</div>
   	 	</form>
    <!-- /.modal-content -->
  	</div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#barang').change(function(){
		var barang = document.getElementById('barang').value;
		$.ajax
		(
			{
				type:"post",
				url: "<?php echo site_url(); ?>/welcome/ajax_barang",
				data:{ barang:barang},
				success:function(response)
				{
					var json = JSON.parse(response);
					document.getElementById('harga_modal').value = json[0]['harga_barang'];
					var beli = parseInt($('#harga_modal').val()) || 0;
					var jual = parseInt($('#harga_jual').val()) || 0;
					var quantity = parseInt($('#quantity').val()) || 0;
					
					var total_jual = (jual * quantity);
					var total_beli = (beli * quantity);
					var profit = total_jual - total_beli;
					$('#total_jual').val(total_jual);
					$('#total_beli').val(total_beli);
					$('#profit').val(profit);
				}
			}
		);
	});
	
	$("#harga_jual").keyup(function()
	{
		var beli = parseInt($('#harga_modal').val()) || 0;
		var jual = parseInt($('#harga_jual').val()) || 0;
		var quantity = parseInt($('#quantity').val()) || 0;
		
		var total_jual = (jual * quantity);
		var total_beli = (beli * quantity);
		var profit = total_jual - total_beli;
		$('#total_jual').val(total_jual);
		$('#total_beli').val(total_beli);
		$('#profit').val(profit);
	});
	
	$("#quantity").keyup(function()
	{
		var beli = parseInt($('#harga_modal').val()) || 0;
		var jual = parseInt($('#harga_jual').val()) || 0;
		var quantity = parseInt($('#quantity').val()) || 0;
		
		var total_modal = (beli * quantity);
		var total_jual = (jual * quantity);
		var profit = total_jual - total_modal;

		$('#total_modal').val(total_modal);
		$('#total_jual').val(total_jual);
		$('#profit').val(profit);
	});
});
</script>