<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">

			<div class="well">


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
			</div>
		</div>
	</div>
</div>