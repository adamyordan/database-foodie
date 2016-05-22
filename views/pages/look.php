<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">

			<div class="well">

				<?php if ($data['user']->job == "Chef" || $data['user']->job == "Manager"): ?>

				<table class="table table-mini">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Deskripsi</th>
							<th>Harga</th>
							<th>Jumlah tersedia</th>
							<th>Kategori</th>
							<th></th>
						</tr>
					</thead>
					<tbody> 
						<?php for($i = 1; $i <= 10; $i+=2): ?>
						<tr> 
							<td scope="row"><?php echo $i; ?></th> 
							<td>Ayam Bakar</td> 
							<td>Ayam Bakar saus madu dan lalapan</td> 
							<td>20,000</td> 
							<td>32</td> 
							<td>Makanan</td> 
							<td><a href="#">Lihat</a></td>
						</tr> 
						<tr> 
							<td scope="row"><?php echo $i+1; ?></th> 
							<td>Es Teh Manis</td> 
							<td>Teh manis dingin </td> 
							<td>5,000</td> 
							<td>73</td> 
							<td>Minuman</td> 
							<td><a href="#">Lihat</a></td>
						</tr>
						<?php endfor; ?>
					</tbody> 
				</table>

			<?php elseif ($data['user']->job == "Kasir"): ?>

				<table class="table table-mini">
					<thead>
						<tr>
							<th>#</th>
							<th>Nomor Nota</th>
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
							<td>13/05/2016 23:12:25</td> 
							<td>13/05/2016 23:12:25</td> 
							<td>60,000</td> 
							<td>Tunai</td> 
							<td><a href="#">Lihat</a></td>
						</tr> 
						<tr> 
							<td scope="row"><?php echo $i+1; ?></th> 
							<td>ABC779</td> 
							<td>18/05/2016 23:12:25</td> 
							<td>20/05/2016 23:12:25</td> 
							<td>75,000</td> 
							<td>Debit</td> 
							<td><a href="#">Lihat</a></td>
						</tr>
						<?php endfor; ?>
					</tbody> 
				</table>

			<?php elseif ($data['user']->job == "Staf"): ?>

				<h4>Pembelian Bahan</h4>

				<table class="table table-mini">
					<thead>
						<tr>
							<th>#</th>
							<th>Nomor</th>
							<th>Waktu</th>
							<th>Supplier</th>
							<th>Staf</th>
							<th></th>
						</tr>
					</thead>
					<tbody> 
						<?php for($i = 1; $i <= 10; $i++): ?>
						<tr> 
							<td scope="row"><?php echo $i; ?></th> 
							<td>XYZ030</td> 
							<td>05/05/2016 12:30</td> 
							<td>Molly Special</td> 
							<td>Olivia Domenica</td> 
							<td><a href="#">Rincian</a></td>
						</tr> 
						<?php endfor; ?>
					</tbody> 
				</table>

			<?php endif; ?>

			</div>
		</div>
	</div>
</div>