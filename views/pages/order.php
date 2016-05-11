<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<table class="table table-mini">
					<caption><h5>Foodie - List Pemesanan</h5></caption>
					<thead>
						<tr>
							<th>#</th>
							<th>Nomor Nota</th>
							<th>Waktu Pesan</th>
							<th>Waktu Bayar</th>
							<th>Total</th>
							<th>Kasir</th>
							<th>Mode Bayar</th>
							<th></th>
						</tr>
					</thead>
					<tbody> 
						<?php for($i = 1; $i <= 10; $i+=2): ?>
						<tr> 
							<td scope="row"><?php echo $i; ?></th> 
							<td>ABC777</td> 
							<td>05/05/2016 15:09</td> 
							<td>05/05/2016 15:09</td> 
							<td>60,000</td> 
							<td>Anto</td> 
							<td>Tunai</td>
							<td><a href="#">Lihat</a></td>
						</tr> 
						<tr> 
							<td scope="row"><?php echo $i; ?></th> 
							<td>ABC756</td> 
							<td>05/05/2016 15:09</td> 
							<td>05/05/2016 15:09</td> 
							<td>130,000</td> 
							<td>Budi</td> 
							<td>Debit</td>
							<td><a href="#">Lihat</a></td>
						</tr>
						<?php endfor; ?>
					</tbody> 
				</table>
			</div>
		</div>
	</div>
</div>