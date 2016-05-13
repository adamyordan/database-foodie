<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<h5>Foodie - List Pembelian Bahan</h5>
				<small>Urutkan Berdasarkan -- [<a>Waktu Pesan</a>/<a>Nomor Nota</a>/<a>Kasir</a>] [<a>Asc</a>/<a>Desc</a>]</small>
					<div>
						<small>Tanggal : <input type="text" class="datePicker" value="<?php echo date('d/m/Y'); ?>"></small>
					</div>
				<table class="table table-mini page page1 page-active">
					<thead>
						<tr>
							<th>Nomor Nota</th>
							<th>Waktu</th>
							<th>Supplier</th>
							<th>Staf</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php for ($i = 30; $i >= 16; $i = $i-1): ?>
						<tr>
							<td>XYZ0<?php echo sprintf('%02d',$i)?></td>
							<td>05/05/2016 12:<?php echo sprintf('%02d',$i)?>:00</td>
							<td>Molly Special</td>
							<td>Olivia Domenica</td>
							<td><a href="?p=purchaseDetail">RINCIAN</a></td>
						</tr>
						<?php endfor; ?>
					</tbody>
				</table>
				
				<table class="table table-mini page page2">
					<tr>
						<th>Nomor Nota</th>
						<th>Waktu</th>
						<th>Supplier</th>
						<th>Staf</th>
						<th></th>
					</tr>
					<?php for ($i = 15; $i >= 1; $i = $i-1): ?>
					<tr>
						<td>XYZ0<?php echo sprintf('%02d',$i)?></td>
						<td>05/05/2016 12:<?php echo sprintf('%02d',$i)?>:00</td>
						<td>Hilda Soda</td>
						<td>Faye Molly</td>
						<td><a href="?p=purchaseDetail">RINCIAN</a></td>
					</tr>
					<?php endfor; ?>
				</table>
				
				<div class="pagination">
						<li class="active"><a class="pageNum">1</a></li>
    					<li class=""><a class="pageNum">2</a></li>
				</div>
			</div>
		</div>
	</div>
</div>