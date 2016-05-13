<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">

			<div class="well">
				<h5>FOODIE - BELI BAHAN MAKANAN</h5>
				<div class="form-horizontal">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Nomor Nota</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputEmail3" placeholder="Nomor Nota">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Supplier</label>
						<div class="col-sm-10">
							<select class="selected-2 form-control mini">
						    	<option value="AL">PD makmur sentosa</option>
								<option value="WY">Fasilkom UI</option>
							</select>
						</div>
					</div>
					
					<table class="table table-mini">
						<thead>
							<tr>
								<td>Nama Bahan</td>
								<td>Harga Satuan</td>
								<td>Satuan</td>
								<td>Jumlah</td>
								<td>Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody id="purchase_row_container"></tbody>
					</table>
					<button id="btn_more" class="btn btn-info btn-sm">Add More</button>

					<div class="form-group">
						<div class="col-sm-offset-10">
							<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Purchase</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Confirm Purchase</h4>
      </div>
      <div class="modal-body">

      		<div class="row">
      			<div class="col-md-5 col-md-offset-6">
      				<div class="row">
      					<div class="col-sm-6">
		      				<p class="small text-right">Nomor Nota: </p>
		      				<p class="small text-right">Supplier: </p>
      					</div>
      					<div class="col-sm-6">
		      				<p class="small text-right">12345</p>
		      				<p class="small text-right">Fasilkom UI</p>
      					</div>
      				</div>
      			</div>
      		</div>

			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-striped table-mini">
						<thead>
							<tr>
								<td>Nama Bahan</td>
								<td>Harga Satuan</td>
								<td>Satuan</td>
								<td>Jumlah</td>
								<td>Total</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Ayam</td>
								<td>1000</td>
								<td>kg</td>
								<td>3</td>
								<td>3000</td>
							</tr>
							<tr>
								<td>Ayam</td>
								<td>1000</td>
								<td>kg</td>
								<td>3</td>
								<td>3000</td>
							</tr>
							<tr>
								<td>Ayam</td>
								<td>1000</td>
								<td>kg</td>
								<td>3</td>
								<td>3000</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
	var num_rows = 0; 
	for (var i = 0; i < 3; i++) {
		insert_row(num_rows);
		num_rows += 1;		
	}

	$(".selected-2").select2();

	$("#btn_more").click(function() {
		insert_row(num_rows);
		num_rows += 1;
	});

	function insert_row(i) {		
		$(`

			<tr id="row_bahan_` + i + `">
				<td>
					<select class="selected-2 form-control mini">
					  <option value="AL">Ayam</option>
					  <option value="WY">Kambing</option>
					</select>
				</td>
				<td><input id="row_hargasatuan_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" class="form-control mini"></td>
				<td>
					<select class="selected-2 form-control mini">
					  <option value="AL">kg</option>
					  <option value="WY">lbs</option>
					</select>
				</td>
				<td><input id="row_jumlah_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" class="form-control mini"></td>
				<td><input id="row_total_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" class="form-control mini nodisable" disabled></td>
				<td>
					<button onclick="delete_row(` + i + `)"
					 type="button" class="btn btn-danger btn-xs">Delete</button>
				</td>
			</tr>
	
			`).hide().appendTo("#purchase_row_container").fadeIn();

		$(".selected-2").select2();		
	}

	function delete_row(i) {
		$('#row_bahan_' + i).fadeOut(300, function() { $(this).remove(); });
	}

	function calculate_total(i) {
		$('#row_total_' + i).val($('#row_hargasatuan_' + i).val() * $('#row_jumlah_' + i).val());
	}
</script>
