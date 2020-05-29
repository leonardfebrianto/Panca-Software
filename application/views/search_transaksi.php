<div class="col-lg-11">
	<h3>Transaksi</h2>
</div>
<div class="col-lg-1 text-right">
	<a href="<?php echo site_url('welcome/tambah_transaksi');?>"> 
		<button class="btn btn-danger text-right" style="margin-top:15px;"><i class="fa fa-fw fa-plus"></i></button>
	</a>
</div>
<br />
<br />
<br />

<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-body">
					<div class="col-lg-12">
						<form class="form" method="POST" action="<?php echo site_url('welcome/cari_transaksi');?>">
							<div class="form-group col-lg-5">
								<label>Dari Tanggal</label>
								<input class="form-control" name="dari" type="date" />
							</div>
							<div class="form-group col-lg-5">
								<label>Sampai Tanggal</label>
								<input class="form-control" name="sampai" type="date" />
							</div>
							<div class="col-lg-2" style="margin-top:25px;">
								<button class="btn btn-block btn-danger" id="cari">Cari</button>
							</div>
						</form>
					</div><br /><br /><br /><br /><br />
					<div class="col-lg-12 table-responsive" style="margin-top: -10px; font-size: 14px">
						<table id="tablejobfile" class="table table-bordered table-striped col-md-12">
							<thead>
								<tr>
									<th width="5px">Kode</th>
									<th width="5px">Nota</th>
									<th>Tanggal</th>
									<th width="200px">Pelanggan</th>
									<th>Tipe Barang</th>
									<th>Qty</th>
									<th>Harga Modal</th>
									<th>Harga Jual</th>
									<th>Total Modal</th>
									<th>Total Jual</th>
									<th>Diskon</th>
									<th>Profit</th>
									<th>Total Profit</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="tbody">
							<?php 
							function number_formatted($number,$separator=",",$currency='Rp.'){
	
								$num  =	number_format ($number , 2 , '.' , $separator);

								if($currency)
									return $currency." ".$num;
								else
									return $num; 	
							}

							$total_profit = 0; 
							$total_profit_transaksi = 0;
							$total_omset_transaksi = 0;
							foreach($data as $data_transaksi){ 
							//$total_profit = $total_profit + $data_transaksi->total_profit;
							$total_modal2 = 0; 
							$total_profit2 = 0; 
							$total_jual2 = 0; 
							?>
								<tr>
									<td><a href="<?php echo site_url()?>/welcome/update_transaksi/<?php echo $data_transaksi->kode_transaksi; ?>"><?php echo $data_transaksi->kode_transaksi;?></a></td>
									<td><?php echo $data_transaksi->nota_transaksi;?></td>
									<td><?php echo $data_transaksi->tanggal;?></td>
									<td><?php echo $data_transaksi->toko_pelanggan;?></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><?php echo number_formatted($data_transaksi->diskon);?></td>
									<?php 
									$child = $controller->list_transaksi_child($data_transaksi->kode_transaksi);
									foreach ($child['child'] as $total) {
										$modal = $total->quantity * $total->harga_modal;
										$total_modal2 = $total_modal2 + $modal;

										$jual = $total->quantity * $total->harga_jual;
										$total_jual2 = $total_jual2 + $jual;
									}
										$total_profit2 = $total_jual2 - $total_modal2;
										$total_profit_nett = $total_profit2 - $data_transaksi->diskon;
										$total_profit_transaksi = $total_profit_transaksi + $total_profit_nett;
										$total_omset_transaksi = $total_omset_transaksi + $total_jual2;
										?>
									<td></td>
									<td><?php echo number_formatted($total_jual2);?></td>
									<td><?php echo number_formatted($total_profit_nett);?></td>
									<td><center><a href="<?php echo site_url('welcome/delete_transaksi/'. $data_transaksi->kode_transaksi);?>"><i style="color:red;" class="glyphicon glyphicon-remove"></i></a></center></td>
								</tr>
								<tr>
									<?php 
									$child2 = $controller->list_transaksi_child($data_transaksi->kode_transaksi);
									foreach ($child2['child'] as $value) {
										?>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><?php echo $value->nama_barang;?></td>
									<td><?php echo $value->quantity;?></td>
									<td><?php echo number_formatted($value->harga_modal);?></td>
									<td><?php echo number_formatted($value->harga_jual);?></td>
									<td><?php $total_modal = $value->quantity * $value->harga_modal; echo number_formatted($total_modal);?></td>
									<td><?php $total_jual =  $value->quantity * $value->harga_jual; echo number_formatted($total_jual);?></td>
									<td></td>
									<td><?php $a = $total_jual - $total_modal; echo number_formatted($a);?></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
									<?php } ?>
									<!--<td><?php echo $data_transaksi->nama_barang;?></td>
									<td><?php echo $data_transaksi->quantity;?></td>
									<td><?php echo $data_transaksi->harga_modal;?></td>
									<td><?php echo $data_transaksi->harga_jual;?></td>
									<td><?php $total_modal = $data_transaksi->harga_modal * $data_transaksi->quantity; echo $total_modal;?></td>
									<td><?php $total_jual = $data_transaksi->harga_jual * $data_transaksi->quantity; echo $total_jual;?></td>
									<td><?php echo $data_transaksi->diskon;?></td>
									<td><?php echo $data_transaksi->total_profit;?></td>
								-->
								<?php } ?>
							</tbody>
							</thead>
						</table>
						<div class="col-lg-8">
						</div>
						<div class="col-lg-4">
							<table class="col-lg-12 text-right">
								<tr>
									<td>Total Omset</td>
									<td width="20px"> </td>
									<td><input type="text" class="form-control" value="<?php echo number_formatted($total_omset_transaksi);?>" readonly /></td>
									<td>Total Profit</td>
									<td width="20px"> </td>
									<td><input type="text" class="form-control" value="<?php echo number_formatted($total_profit_transaksi);?>" readonly /></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url();?>assets/component/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/component/jquery.datatable.js"></script>
<script>
$(document).ready(function() {
	$('#cari').click(function(){
		var a = $('#from').val();
		var b = $('#to').val();
		$.ajax
		(
			{
				type:"post",
				url: "<?php echo site_url(); ?>/welcome/cari_transaksi",
				data:{ 
						dari:a,
						sampai:b
					 },
				success:function(response)
				{
					document.getElementById('tbody').innerHTML = "";
					var json = JSON.parse(response);
					for(i=0;i<json.length;i++)
					{
						//document.getElementById('tbody').innerHTML += "<tr>";
						document.getElementById('tbody').innerHTML += "<td>" + json[i]['nota_transaksi'] + "</td>";
						document.getElementById('tbody').innerHTML += "<td>" + json[i]['tanggal'] + "</td>";
						document.getElementById('tbody').innerHTML += "<td>" + json[i]['nama_toko'] + "</td>";
						document.getElementById('tbody').innerHTML += "<td>" + json[i]['nama_barang'] + "</td>";
						//document.getElementById('tbody').innerHTML += "</tr>";
					}
				}
			}
		);
	});
});
</script>