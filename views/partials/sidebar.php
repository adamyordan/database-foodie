<div class="row">
	<div class="col-md-12">
		<div class="well">
			
			<ul class="list-group">
				<li class="list-group-item">
					Hi, <?php echo $data['user']->name; ?> <br>
					<small>you are a <?php echo $data['user']->job; ?></small>
				</li>
			</ul>

			<div class="list-group">
				<a href="?p=home" class="list-group-item">Home</a>
				<?php if ($data['user']->job == "Chef" || $data['user']->job == "Kasir" || 
					$data['user']->job == "Manager"): ?>
					<a href="?p=menu" class="list-group-item">Menu</a>
				<?php endif;?>
				
				<?php if ($data['user']->job == "Kasir" || $data['user']->job == "Manager") : ?>
					<a href="?p=order" class="list-group-item">Pemesanan</a>
				<?php endif;?>
				
				<?php if ($data['user']->job == "Staf" || $data['user']->job == "Manager") : ?>
					<a href="?p=purchaselist" class="list-group-item">List Pembelian Bahan</a>
				<?php endif;?>
				
				<?php if ($data['user']->job == "Staf" || $data['user']->job == "Manager") : ?>
					<a href="?p=purchase" class="list-group-item">Beli Bahan Makanan</a>
				<?php endif;?>
			</div>

			<div class="list-group">
				<button id="btn_logout" class="list-group-item">Logout</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="resources/js/logout.js"></script>