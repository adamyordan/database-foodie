<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">

			<div class="well">
			<h5>Foodie - List Menu</h5>
				<small>Urutkan Berdasarkan -- [<a>Nama</a>/<a>Harga</a>/<a>Kategori</a>] [<a>Asc</a>/<a>Desc</a>]</small>
					<div>
						<small>Tanggal : <input type="text" class="datePicker" value="<?php echo date('d/m/Y'); ?>"></small>
					</div>

				<table class="table table-mini page page1 page-active">
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
							<td><a href="?p=menuDetail">Lihat</a></td>
						</tr> 
						<tr> 
							<td scope="row"><?php echo $i+1; ?></th> 
							<td>Es Teh Manis</td> 
							<td>Teh manis dingin </td> 
							<td>5,000</td> 
							<td>73</td> 
							<td>Minuman</td> 
							<td><a href="?p=menuDetail">Lihat</a></td>
						</tr>
						<?php endfor; ?>
					</tbody> 
				</table>

				<table class="table table-mini page page2">
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
						<?php for($i = 11; $i <= 20; $i+=2): ?>
						<tr> 
							<td scope="row"><?php echo $i; ?></th> 
							<td>Ricey Rice</td> 
							<td>Nasi dengan lauk nasi</td> 
							<td>2,000</td> 
							<td>20</td> 
							<td>Makanan</td> 
							<td><a href="?p=menuDetail">Lihat</a></td>
						</tr> 
						<tr> 
							<td scope="row"><?php echo $i+1; ?></th> 
							<td>Fried Water</td> 
							<td>air biasa namun cara masaknya digoreng </td> 
							<td>1,000</td> 
							<td>23</td> 
							<td>Minuman</td> 
							<td><a href="?p=menuDetail">Lihat</a></td>
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