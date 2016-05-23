<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Basis Data</title>

	<link rel="stylesheet" type="text/css" href="resources/css/vendor/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="resources/css/vendor/flat-ui.css">
	<link rel="stylesheet" type="text/css" href="resources/css/vendor/select2.min.css">
	<link rel="stylesheet" type="text/css" href="resources/css/vendor/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="resources/css/vendor/sweetalert2.min.css">
	<link rel="stylesheet" type="text/css" href="resources/css/core.css">
	<link rel="stylesheet" type="text/css" href="resources/css/order.css">
	
    <script type="text/javascript" src="resources/js/vendor/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="resources/js/vendor/jquery-ui.js"></script>
    <script type="text/javascript" src="resources/js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="resources/js/vendor/select2.min.js"></script> 
	<script type="text/javascript" src="resources/js/vendor/sweetalert2.min.js"></script>
	<script type="text/javascript" src="resources/js/core.js"></script>
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