<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">

			<div class="well">
				<h5>Pembelian Baru</h5>
				<div class="form-horizontal">
					<div class="form-group">
						<label for="no_nota" class="col-sm-2 control-label">Nomor Nota</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="no_nota" placeholder="Nomor Nota">
						</div>
					</div>
					<div class="form-group">
						<label for="supplier" class="col-sm-2 control-label">Supplier</label>
						<div class="col-sm-10">
							<select class="selected-2 form-control mini" name="supplier">
								<?php foreach($data['suppliers'] as $supplier):
									echo "<option value='$supplier->name'> $supplier->name </option>"; 
									endforeach;
								?>
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
							<button class="btn btn-primary" id="btn_purchase">Purchase#</button>
							<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Purchase</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>



<script type="text/javascript">
	var num_rows = 0; 
	for (var i = 0; i < 1; i++) {
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
					<select class="selected-2 form-control mini" name="mname[]">
						<?php foreach($data['materials'] as $material): ?>
							<option> <?php echo $material->name; ?> </option>
						<?php endforeach; ?>
					</select>
				</td>
				<td><input id="row_hargasatuan_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini" name="mprice[]"></td>
				<td>
					<select class="selected-2 form-control mini" name="munit[]">
					  <option value="AL">kg</option>
					  <option value="WY">lbs</option>
					</select>
				</td>
				<td><input id="row_jumlah_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini" name="mqty[]"></td>
				<td><input id="row_total_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini nodisable" disabled name="mtotal[]"></td>
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

	$('#btn_purchase').click(function() {
        $.post(
            "?p=api_purchase",
            {
            	"no_nota" : $("[name='no_nota']").val(),
            	"supplier" : $("[name='supplier']").val(),
            	"staf" : "adam",
            	"mname" : $("[name='mname[]']").map(function() {return $(this).val();}).get(),
            	"mprice" : $("[name='mprice[]']").map(function() {return $(this).val();}).get(),
            	"munit" : $("[name='munit[]']").map(function() {return $(this).val();}).get(),
            	"mqty" : $("[name='mqty[]']").map(function() {return $(this).val();}).get(),
            	"mtotal" : $("[name='mtotal[]']").map(function() {return $(this).val();}).get(),
            },
            function(data) {
                alert(data.status);
            },
            "json"
        );
	})
</script>
