<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Basis Data</title>

	<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="resources/css/flat-ui.css">
	<link rel="stylesheet" type="text/css" href="resources/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="resources/css/core.css">
	<link rel="stylesheet" type="text/css" href="resources/css/order.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="resources/css/sweetalert2.min.css">
	
    <script type="text/javascript" src="resources/js/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="resources/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="resources/js/select2.min.js"></script> 
	<script type="text/javascript" src="resources/js/sweetalert2.min.js"></script>
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