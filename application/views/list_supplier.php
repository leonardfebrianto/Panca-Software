<div class="col-lg-11"><h3>List Supplier</h2></div>
<div class="col-lg-1 text-right">
	<a href="<?php echo site_url('welcome/tambah_supplier');?>"> 
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
						<form class="form" method="POST" action="<?php echo site_url('welcome/cari_supplier');?>">
							<br />
							<div class="form-group col-lg-5">
								<input class="form-control" type="text" name="cari" placeholder="Search.."/>
							</div>
							<div class="col-lg-2">
								<button class="btn btn-block btn-danger">Cari</button>
							</div>
						</form>
					</div><br /><br /><br /><br /><br />
					<div class="col-lg-12 table-responsive" style="margin-top: -10px; font-size: 14px">
						<table id="tablejobfile" class="table table-bordered table-striped col-md-12">
							<thead>
								<tr>
									<th>Nama Toko</th>
									<th>Nama PIC</th>
									<th>No Telp</th>
									<th>Alamat</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($data as $data2){ ?>
								<tr>
									<td><a href="<?php echo site_url()?>/welcome/update_supplier/<?php echo $data2->kode_supplier; ?>"><?php echo $data2->toko_supplier;?></td>
									<td><?php echo $data2->pic_supplier;?></td>
									<td><?php echo $data2->telp_supplier;?></td>
									<td><?php echo $data2->alamat_supplier;?></td>
								</tr>
								<?php } ?>
							</tbody>
							</thead>
						</table>
						<div class="col-lg-6">
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
 $('#tablejobfile').DataTable();
    $(document).ready(function() {
        var table = $('#table_jb').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [
                [2, 'asc']
            ],
            "displayLength": 25,
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
        // Order by the grouping
        $('#table_jb tbody').on('click', 'tr.group', function() {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            } else {
                table.order([2, 'asc']).draw();
            }
        });
	});
</script>