<script src ="resources"></script>
<div class="col-md-3">
	<?php require_once('views/partials/sidebar.php'); ?>
</div>
<div class="col-md-9">
	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<h5><?php  echo $data['menudt']->name; ?></h5>
				<div class="row">
					<div class="col-md-6">						
						
						<h3> <?php echo $data['menudt']->picture; ?></h3>

					</div>
					<div class="col-md-6">
						<small>Harga	: <?php echo $data['menudt']->price; ?></small><br>
						<small>Tersedia	: <?php echo $data['menudt']->amount; ?></small><br>
						<small>Kategori	: <?php echo $data['menudt']->category; ?></small><br>
						<small><?php echo $data['menudt']->description; ?></small><br>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>