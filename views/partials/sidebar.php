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
				<a href="?p=look" class="list-group-item">Home</a>
<<<<<<< HEAD
				<?php if ($data['user']->job == "Chef" 
						   || $data['user']->job == "Kasir" 
						   || $data['user']->job == "Manager") : ?>
					<a href="#" class="list-group-item">Menu</a>
=======
				<?php if ($job == "Chef" || $job == "Kasir") : ?>
					<a href="?p=menu" class="list-group-item">Menu</a>
>>>>>>> 295984ef345f7557f3f6a7128c7f3ca0cc0b207a
				<?php endif;?>
				
				<?php if ($data['user']->job == "Kasir" || $data['user']->job == "Manager") : ?>
					<a href="?p=order" class="list-group-item">Pemesanan</a>
				<?php endif;?>
				
				<?php if ($data['user']->job == "Staf" || $data['user']->job == "Manager") : ?>
					<a href="?p=purchaselist" class="list-group-item">Bahan Makanan</a>
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

<script>
	$('#btn_logout').click(function() {

        $.get(
            "?p=api_logout",
            {},
            function(data) {
            	if(data.status == "ok") {
	                window.location.href = "index.php";
            	}
            },
            "json"
        );

	});
</script>