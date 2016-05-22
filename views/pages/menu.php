
<script type="text/javascript" src="resources/js/menu.js"></script>
<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">

			<div class="well">
			<h5>List Menu</h5>
				<small>Urutkan Berdasarkan :</small>
					<form action="index.php?p=menu" method="POST">
						<select name="group" class="form-control">
							<option val="nama">Nama</option>
							<option val="harga">Harga</option>
							<option val="kategori">Kategori</option>
						</select>
						<select name="sort" class="form-control" val="test">
							<option val="asc">ASC</option>
							<option val="desc">DESC</option>
						</select>
						<?php if (empty($_POST['date']) === false){ ?>
						<small>Tanggal : <input name="date" type="text" class="datePicker" value="<?php echo $_POST['date']; ?>"></small>
						<?php } else { ?>
						<small>Tanggal : <input name="date" type="text" class="datePicker" value="<?php echo date('d/m/Y'); ?>"></small>
						<?php } ?>
						<input type="submit">
					</form>
				<?php if (empty($_POST['date']) === false){ ?>				
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
						<?php  ?>
						<?php if (empty($data['dmenus']) === false){ 
						$number = 1; 
						foreach($data['dmenus'] as $dmenu):?>
							<tr>
							<td> <?php echo $number++; ?> </td> 
							<td> <?php echo $dmenu->name; ?> </td>
							<td> <?php echo $dmenu->description; ?> </td>
							<td> <?php echo $dmenu->price; ?> </td>
							<td> <?php echo $dmenu->amount; ?> </td>
							<td> <?php echo $dmenu->category; ?> </td>
							<td><a href="?p=menuDetail&name=<?php echo $dmenu->name . "&time=" . $dmenu->time;?>">Lihat</a></td>
							</tr>
						<?php endforeach; } ?>
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

				<?php } ?>
			</div>
		</div>
	</div>
</div>