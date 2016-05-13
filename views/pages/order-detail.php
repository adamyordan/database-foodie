<script src ="resources"></script>
<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">
	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<h5>Foodie - Detail Pemesanan Makanan</h5>
				<div class="row">
					<div class="col-md-6">
						 <small>Nomor Nota : ABC777</small><br>
						 <small>Waktu Pesan : <?php echo date('d/m/Y H:i:s');?> </small><br>
						 <small>Waktu Bayar : <?php echo date('d/m/Y H:i:s');?> </small><br>
					</div>

					<div class="col-md-6">
						 <small>Total 		: 60,000</small><br>
						 <small>Kasir 		: Anto</small><br>
						 <small>Mode Bayar 	: Tunai</small><br>
					</div>
					<table class="table table-mini">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Menu</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody> 
							<?php for($i = 1; $i <= 1; $i+=2): ?>
							<tr> 
								<td scope="row"><?php echo $i; ?></th> 
								<td>Ayam Goreng</td> 
								<td>20,000</td> 
								<td>3</td> 
								<td>60,000</td> 
							</tr> 
							<?php endfor; ?>
						</tbody> 
					</table>
				</div>
			</div>
		</div>
	</div>
</div>