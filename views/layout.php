<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Basis Data</title>
	<link rel="stylesheet" type="text/css" 
		href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/css/flat-ui.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="resources/css/core.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
</head>
<body>

	<?php require_once('views/partials/navbar.php'); ?>


	<div class="container-fluid-main">
		
	<main>
		<div class="container">

			<div class="row">
				<?php require_once($data['__content__']); ?>
			</div>

		</div>
	</main>

	</div>


	
</body>
</html>