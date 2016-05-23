<?php
	require_once('model/ingredient-purchase.php');
	require_once('model/purchase.php');

	class PurchaseController {
		
		public static function purchaseDetails() {
			$ok = true;
			if (!isset($_POST['notapembelian'])) {
				$ok = false;
			} else {
				$notapembelian = $_POST['notapembelian'];
				$detail = IngredientPurchase::findDetail($notapembelian);
				
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
		
		public static function purchaseWithinPeriod()
		{
			$ok = true;
			if (!isset($_POST['startDate']) || !isset($_POST['endDate'])) {
				$ok = false;
			} else {
				$startDate = $_POST['startDate'];
				$endDate = $_POST['endDate'];
				$detail = Purchase::getWithinPeriod($startDate,$endDate);
				
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
			if (!isset($_POST['sort1']) || !isset($_POST['sort2']) || !isset($_POST['date'])) {
				$ok = false;
			} else {
				$sort1 = $_POST['sort1'];
				$sort2 = $_POST['sort2'];
				$yyyy  = $_POST['date'][2];
				$dd    = $_POST['date'][1];
				$mm    = $_POST['date'][0];
				$detail = Purchase::sortOnDate($sort1,$sort2, $yyyy.'-'.$mm.'-'.$dd);
				
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