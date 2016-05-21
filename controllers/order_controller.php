<?php
	// call model daily-order
	require_once('model/daily-order.php');

	class OrderController {
		
		public static function detail () {
			$ok = true;
			if (!isset($_POST['nomornota'])) {
				$ok = false;
			} else {
				$nomornota = $_POST['nomornota'];
				$detail = dailyOrder::findDetail($nomornota);

				if ($detail == null) {
					$ok = false;
				} else {
					$data = new stdClass();
					$data->status = "ok";
					$data->detail   = $detail;
					View::json($data);				
				}
				
			}

			if ($ok == false) {
				$data = new stdClass();
				$data->status = "No Data Exist";
				View::json($data);
			}
		}
	}
?>