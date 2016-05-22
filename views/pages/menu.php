
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
						<br>
						<?php if (empty($_POST['date']) === false){ ?>
						<small>Tanggal : <input name="date" type="text" class="datePicker" value="<?php echo $_POST['date']; ?>"></small>
						<?php } else { ?>
						<small>Tanggal : <input name="date" type="text" class="datePicker" value="<?php echo date('d/m/Y'); ?>"></small>
						<?php } ?>
						<input type="submit">
					</form>
				 
				<?php $count = 1; $page = 1;?>
				<?php foreach ($data['dmenus'] as $dmenu ) : ?>
				<?php if ($count == 1 || $count % 15 == 1) : ?>				
				<table class="table table-mini page <?php echo $count == 1 ? "page-active" : "" ?> page<?php echo $page++;?>">					
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
				<?php endif; ?>						
						<tr>
							<td> <?php echo $count; ?> </td> 
							<td> <?php echo $dmenu->name; ?> </td>
							<td> <?php echo $dmenu->description; ?> </td>
							<td> <?php echo $dmenu->price; ?> </td>
							<td> <?php echo $dmenu->amount; ?> </td>
							<td> <?php echo $dmenu->category; ?> </td>
							<td><a href="?p=menuDetail&name=<?php echo $dmenu->name . "&time=" . $dmenu->time;?>">Lihat</a></td>
						</tr>
				<?php if ($count++ % 15 == 0 || $count > sizeof($data['dmenus']) ) : ?>
					</tbody>
				</table>
				<?php endif; ?>
				<?php endforeach; ?>

					<div class="pagination">
						<?php for ($a = 1; $a < sizeof($data['dmenus']) ; $a += 15) : ?>
						<li <?php echo $a == 1 ? 'class="active"':''; ?>><a class="pageNum"><?php echo floor (($a/15) + 1); ?></a></li>
		    			<?php endfor; ?>
					</div>
								
			</div>
		</div>
	</div>
</div>