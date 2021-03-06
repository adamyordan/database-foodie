<?php
	// call model daily-order
	require_once('model/daily-order.php');
	require_once('model/order.php');

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

		public static function sort () {
			$ok = true;
			if (!isset($_POST['sort1']) || !isset($_POST['sort2']) || !isset($_POST['sort3']) ) {
				$ok = false;
			} else {
				$sort1 = $_POST['sort1'];
				$sort2 = $_POST['sort2'];
				$sort3 = $_POST['sort3'];
				$detail = Order::sort($sort1,$sort2,$sort3);

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