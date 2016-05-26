<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">

			<div class="well">
				<h5>Pembelian Baru</h5>
				<div class="form-horizontal">
					<div class="form-group" id="formgroup-no_nota">
						<label for="no_nota" class="col-sm-2 control-label">Nomor Nota</label>
						<div class="col-xs-12 col-md-4">
							<input type="text" class="form-control" name="no_nota" placeholder="Nomor Nota" maxlength="6">
						</div>
					</div>
					<div class="form-group">
						<label for="supplier" class="col-sm-2 control-label">Supplier</label>
						<div class="col-sm-10 col-md-4">
							<select class="selected-2 form-control mini" name="supplier">
								<?php foreach($data['suppliers'] as $supplier):
									echo "<option value='$supplier'> $supplier </option>"; 
									endforeach;
								?>
							</select>
						</div>
					</div>
					
					<div class="table-responsive">
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
							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"><p>Grand Total :</p></td>
									<td><b><p id="grandtotal">0</p></b></td>
								</tr>
							</tfoot>
						</table>
					</div>

					<div class="row">
						<div class="col-xs-6">
							<button id="btn_more" class="btn btn-info btn-sm btn-block">Add More</button>
						</div>
						<div class="col-xs-6">
							<button class="btn btn-primary btn-block" id="btn_purchase2">Purchase</button>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	function getRowTemplate(i) {
		return `
		<tr id="row_bahan_` + i + `">
			<td>
				<select class="selected-2 form-control mini" name="mname[]">
					<?php foreach($data['materials'] as $material): 
						echo "<option value='$material'> $material </option>";
					endforeach; ?>
				</select>
			</td>
			<td><input id="row_hargasatuan_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini" name="mprice[]"></td>
			<td>
				<select class="selected-2 form-control mini" name="munit[]">
					<?php foreach($data['units'] as $unit): 
						echo "<option value='$unit'> $unit </option>";
					endforeach; ?>
				</select>
			</td>
			<td><input id="row_jumlah_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini" name="mqty[]"></td>
			<td><input id="row_total_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini nodisable" disabled name="mtotal[]"></td>
			<td>
				<button onclick="delete_row(` + i + `)"
				 type="button" class="btn btn-danger btn-xs">Delete</button>
			</td>
		</tr>
		`;
	}
</script>
<script type="text/javascript" src="resources/js/newpurchase.js"></script>
