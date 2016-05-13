<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<h5>Foodie - List Pemesanan</h5>
				<small>Urutkan Berdasarkan -- [Waktu Pesan/Nomor Nota/Kasir] [Asc/Desc]</small>
					<div>
						<small>Tanggal : <input type="text" class="datePicker" value="<?php echo date('d/m/Y'); ?>"></small>
					</div>
				<table class="table table-mini page page1 page-active">
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
						<?php for($i = 1; $i <= 15; $i+=2): ?>
						<tr> 
							<td scope="row"><?php echo $i; ?></th> 
							<td>ABC777</td> 
							<td><?php echo date('d/m/Y');?> 15:09</td> 
							<td><?php echo date('d/m/Y');?> 15:09</td> 
							<td>60,000</td> 
							<td>Anto</td> 
							<td>Tunai</td>
							<td><a href="?p=orderDetail">Lihat</a></td>
						</tr> 
						<tr> 
							<td scope="row"><?php echo $i+1; ?></th> 
							<td>ABC756</td> 
							<td><?php echo date('d/m/Y');?> 15:09</td> 
							<td><?php echo date('d/m/Y');?> 15:09</td> 
							<td>130,000</td> 
							<td>Budi</td> 
							<td>Debit</td>
							<td><a href="?p=orderDetail">Lihat</a></td>
						</tr>
						<?php endfor; ?>
					</tbody> 
				</table>

				<table class="table table-mini page page2">
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
						<?php for($i = 16; $i <= 30; $i+=2): ?>
						<tr> 
							<td scope="row"><?php echo $i; ?></th> 
							<td>A1234C</td> 
							<td><?php echo date('d/m/Y');?> 15:09</td> 
							<td><?php echo date('d/m/Y');?> 15:09</td> 
							<td>60,000</td> 
							<td>Anto</td> 
							<td>Tunai</td>
							<td><a href="?p=orderDetail">Lihat</a></td>
						</tr> 
						<tr> 
							<td scope="row"><?php echo $i+1; ?></th> 
							<td>BBBB25</td> 
							<td><?php echo date('d/m/Y');?> 15:09</td> 
							<td><?php echo date('d/m/Y');?> 15:09</td> 
							<td>130,000</td> 
							<td>Budi</td> 
							<td>Debit</td>
							<td><a href="?p=orderDetail">Lihat</a></td>
						</tr>
						<?php endfor; ?>
					</tbody> 
				</table>

				<div class="pagination">
						<li class="active"><a class="pageNum">1</a></li>
    					<li class=""><a class="pageNum">2</a></li>
				</div>
			</div>
		</div>
	</div>
</div>