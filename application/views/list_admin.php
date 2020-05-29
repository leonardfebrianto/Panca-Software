<div class="col-lg-11"><h3>List User</h2></div>
<div class="col-lg-1 text-right">
	<a href="<?php echo site_url('welcome/tambah_admin');?>"> 
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
					<div class="col-lg-12 table-responsive" style="margin-top: -10px; font-size: 14px">
						<table id="tablejobfile" class="table table-bordered table-striped col-md-12">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Username</th>
									<th>Password</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($data as $data2){ ?>
								<tr>
									<td><a href="<?php echo site_url()?>/welcome/update_admin/<?php echo $data2->username; ?>"><?php echo $data2->nama;?></a></td>
									<td><?php echo $data2->username;?></td>
									<td>************</td>
								</tr>
								<?php } ?>
							</tbody>
							</thead>
						</table>
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