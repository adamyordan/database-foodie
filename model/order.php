<?php 
	class Order {

		public $nomornota;
		public $waktubayar;
		public $waktupesan;
		public $total;
		public $emailkasir;
		public $mode;

		private function __clone() {}

		private function __construct() {}

		public static function orderList () {
			$d = date('d');
			$m = date('m');
			$y = date('Y');
			$result = DB::query("SELECT * FROM PEMESANAN where date_part('day',waktupesan) = '$d' and date_part('month',waktupesan) ='$m' and date_part('year',waktupesan) = '$y' ORDER BY nomornota DESC");

			if($result == false || $result->rowCount() <= 0) {
				return null;
			} else {
				$orders = array();
				foreach ($result->fetchAll() as $row) {
					$order = new order();
					$order->nomornota = $row['nomornota'];
					$order->waktubayar = $row['waktubayar'];
					$order->waktupesan = $row['waktupesan'];
					$order->total = $row['total'];
					 
					$kasir = $row['emailkasir'];
					$temp = DB::query("SELECT * FROM USERS WHERE email='$kasir'");

					foreach ($temp->fetchAll() as $rowTemp) {
						$order->emailkasir = $rowTemp['nama'];
					}

					$order->mode = $row['mode'];
					array_push($orders, $order);
				}
				return $orders;		
			}
		}

		public static function sort($group,$sort,$date) {
			$result = DB::query("SELECT * FROM PEMESANAN where date_part('day',waktupesan) = '$date[0]' and date_part('month',waktupesan) ='$date[1]' and date_part('year',waktupesan) = '$date[2]' ORDER BY $group $sort");

			if($result == false || $result->rowCount() <= 0) {
				return null;
			} else {
				$orders = array();
				foreach ($result->fetchAll() as $row) {
					$order = new order();
					$order->nomornota = $row['nomornota'];
					$order->waktubayar = $row['waktubayar'];
					$order->waktupesan = $row['waktupesan'];
					$order->total = $row['total'];
					
					$kasir = $row['emailkasir'];
					$temp = DB::query("SELECT * FROM USERS WHERE email='$kasir'");

					foreach ($temp->fetchAll() as $rowTemp) {
						$order->emailkasir = $rowTemp['nama'];
					}

					$order->mode = $row['mode'];
					array_push($orders, $order);
				}
				return $orders;		
			}
		}

		public static function getLatest($limit, $offset) {
			$result = DB::query("SELECT * FROM PEMESANAN ORDER BY waktupesan DESC OFFSET $offset LIMIT $limit");
			if($result == false || $result->rowCount() <= 0) {
				return null;
			} else {
				$orders = array();
				foreach ($result->fetchAll() as $row) {
					$order = new order();
					$order->nomornota = $row['nomornota'];
					$order->waktubayar = $row['waktubayar'];
					$order->waktupesan = $row['waktupesan'];
					$order->total = $row['total'];
					
					$kasir = $row['emailkasir'];
					$temp = DB::query("SELECT * FROM USERS WHERE email='$kasir'");

					foreach ($temp->fetchAll() as $rowTemp) {
						$order->emailkasir = $rowTemp['nama'];
					}

					$order->mode = $row['mode'];
					array_push($orders, $order);
				}
				return $orders;		
			}	
		}
	}
?>