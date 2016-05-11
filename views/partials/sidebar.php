<?php 
	$name = "Adam";
	$job = "Kasir";
?>
<div class="row">
	<div class="col-md-12">
		<div class="well">
			
			<ul class="list-group">
				<li class="list-group-item">
					Hi, <?php echo $name; ?> <br><small>you are a <?php echo $job; ?></small>
				</li>
			</ul>

			<div class="list-group">
				<a href="?p=look" class="list-group-item">Home</a>
				<?php if ($job == "Chef" || $job == "Kasir") : ?>
					<a href="#" class="list-group-item">Menu</a>
				<?php endif;?>
				
				<?php if ($job == "Kasir") : ?>
					<a href="?p=order" class="list-group-item">Pemesanan</a>
				<?php endif;?>
				
				<?php if ($job == "Staf") : ?>
					<a href="#" class="list-group-item">Bahan Makanan</a>
				<?php endif;?>
				
				<?php if ($job == "Staf") : ?>
					<a href="?p=purchase" class="list-group-item">Beli Bahan Makanan</a>
				<?php endif;?>
			</div>

			<div class="list-group">
				<a href="?p=home" class="list-group-item">Logout</a>
			</div>
		</div>
	</div>
</div>