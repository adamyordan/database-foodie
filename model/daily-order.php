<?php
	class dailyOrder {
		public $nomornota;
		public $namamenu;
		public $jumlah;
		public $harga;

		public static function findDetail ($nota) {
			$result = DB::query("SELECT * FROM PEMESANAN_MENU_HARIAN where nomornota='$nota'");

			if($result == false || $result->rowCount() <= 0) {
				return null;
			} else {
				$orders = array();
				foreach ($result->fetchAll() as $row) {
					$order = new dailyOrder();
					$order->nomornota = $row['nomornota'];
					$order->namamenu = $row['namamenu'];
					$order->jumlah = $row['jumlah'];

					$temp = DB::query("SELECT * FROM MENU WHERE nama='$order->namamenu'");

					foreach ($temp->fetchAll() as $rowTemp) {
						$order->harga = $rowTemp['harga'];
					}

					array_push($orders, $order);
				}
				return $orders;		
			}

		}
	}
?>