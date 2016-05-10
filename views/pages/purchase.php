<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">

			<div class="well">
				<h5>FOODIE - BELI BAHAN MAKANAN</h5>
				<form class="form-horizontal">
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
							</tr>
						</thead>
						<tbody>
							<?php for($i = 0; $i < 3; $i++): ?>
							<tr>
								<td>
									<select class="selected-2 form-control mini">
									  <option value="AL">Ayam</option>
									  <option value="WY">Kambing</option>
									</select>
								</td>
								<td><input type="number" class="form-control mini"></td>
								<td>
									<select class="selected-2 form-control mini">
									  <option value="AL">kg</option>
									  <option value="WY">lbs</option>
									</select>
								</td>
								<td><input type="number" class="form-control mini"></td>
								<td><input type="number" class="form-control mini" disabled></td>
							</tr>
						<?php endfor; ?>

							<tr>
								<td><button class="btn btn-info btn-sm">Add More</button></td>
							</tr>

						</tbody>
					</table>

					<div class="form-group">
						<div class="col-sm-offset-10">
							<button type="submit" class="btn btn-primary">Purchase</button>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(".selected-2").select2();
</script>
