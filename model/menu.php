<?php
	class Menu {

		public $name;
		public $time;
		public $amount;
		public $emailC;
		public $description;
		public $price;
		public $category;

		private function __clone() {}

		private function __construct() {}

		// public static function find($name) {
		// 	$result = DB::query("SELECT * FROM BAHAN_BAKU WHERE nama='$name'");
		// 	if($result == false || $result->rowCount() == 0) {
		// 		return null;
		// 	} else {
		// 		$row = $result->fetchAll()[0];
		// 		$material = new Material();
		// 		$material->name = $row['nama'];
		// 		$material->unit = $row['satuanstok'];
		// 		$material->stock = $row['stok'];
		// 		return $material;
		// 	}
		// }

		public static function menu_detail() {
			$result = DB::query("SELECT * FROM MENU_HARIAN MH, MENU M WHERE namamenu = nama ORDER BY namamenu ASC LIMIT 10");
			if($result == false || $result->rowCount() <= 0) {
				 return null;				
			} else {				
				$row = $result->fetchAll()[0];
				$menu = new Menu();
				$menu->name = $row['namamenu'];			
				$menu->time = $row['waktu'];
				$menu->amount = $row['jumlah'];
				$menu->emailC = $row['emailchef'];
				$menu->description = $row['deskripsi'];
				$menu->picture = $row['gambar'];
				$menu->price = $row['harga'];
				$menu->category = $row['kategori'];				
				return $menu;		
			}
		}

		public static function all() {
			$result = DB::query("SELECT * FROM MENU_HARIAN LIMIT 10");
			if($result == false || $result->rowCount() <= 0) {
				return null;
			} else {
				$menus = array();
				foreach ($result->fetchAll() as $row) {
					$menu = new Menu();
					$menu->name = $row['namamenu'];
					$menu->time = $row['waktu'];
					$menu->amount = $row['jumlah'];
					$menu->emailC = $row['emailchef'];
					array_push($menus, $menu);
				}
				return $menus;		
			}
		}

		public static function daily_menu() {
			$result = DB::query("SELECT * FROM MENU_HARIAN MH, MENU M WHERE namamenu = nama ORDER BY namamenu ASC LIMIT 10");
			if($result == false || $result->rowCount() <= 0) {
				 return null;				
			} else {
				$menus = array();
				foreach ($result->fetchAll() as $row) {
					$menu = new Menu();
					$menu->name = $row['namamenu'];			
					$menu->time = $row['waktu'];
					$menu->amount = $row['jumlah'];
					$menu->emailC = $row['emailchef'];
					$menu->description = $row['deskripsi'];
					$menu->price = $row['harga'];
					$menu->category = $row['kategori'];
					array_push($menus, $menu);
				}
				return $menus;		
			}
		}


		

	}
?>