<?php
	require_once('model/ingredient-purchase.php');
	require_once('model/purchase.php');

	class PurchaseController {
		
		public static function purchaseDetail() {
			$ok = true;
			if (!isset($_POST['nomornota'])) {
				$ok = false;
			} else {
				$nomornota = $_POST['nomornota'];
				$detail = IngredientPurchase::findDetail($nomornota);

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
		
		public static function purchaseSort() {
			$ok = true;
			if (!isset($_POST['sort1']) || !isset($_POST['sort2']) ) {
				$ok = false;
			} else {
				$sort1 = $_POST['sort1'];
				$sort2 = $_POST['sort2'];
				$detail = Purchase::sort($sort1,$sort2);

				if ($detail == null) {
					$ok = false;
				} else {
					$data = new stdClass();
					$data->status = "ok";
					$data->detail   = $detail;
					View::json($data);				
				}
				
			}

			if (!$ok) {
				$data = new stdClass();
				$data->status = "No Data Exist";
				View::json($data);
			}
		}
	}
?>