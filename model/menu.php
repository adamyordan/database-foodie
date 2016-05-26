<?php
	class Menu {

		public $name;
		public $time;
		public $amount;
		public $emailC;
		public $description;
		public $price;
		public $category;

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

		public static function menu_detail($name, $time) {
			$result = DB::query("SELECT * FROM MENU_HARIAN MH, MENU M WHERE namamenu = nama AND nama = '$name' AND waktu = '$time' ORDER BY namamenu ASC");
			if($result == false || $result->rowCount() <= 0) {
				 return null;				
			} else {				
				$row = $result->fetchAll()[0];
				$menu = new Menu();
				$menu->name = $row['namamenu'];			
				$menu->time = $row['waktu'];
				$menu->amount = $row['jumlahtersedia'];
				$menu->emailC = $row['emailchef'];
				$menu->description = $row['deskripsi'];
				$menu->picture = $row['gambar'];
				$menu->price = $row['harga'];
				$menu->category = $row['kategori'];				
				return $menu;		
			}
		}

		public static function all() {
			$result = DB::query("SELECT * FROM MENU_HARIAN MH, MENU M WHERE namamenu = nama");
			if($result == false || $result->rowCount() <= 0) {
				return null;
			} else {
				$menus = array();
				foreach ($result->fetchAll() as $row) {
					$menu = new Menu();
					$menu->name = $row['namamenu'];
					$menu->time = $row['waktu'];
					$menu->amount = $row['jumlahtersedia'];
					$menu->emailC = $row['emailchef'];
					$menu->description = $row['deskripsi'];
					$menu->price = $row['harga'];
					$menu->category = $row['kategori'];
					array_push($menus, $menu);
				}
				return $menus;		
			}
		}

		public static function daily_menu($date, $group, $sort) {
			$result = DB::query("SELECT DISTINCT MH.namamenu AS nama, MH.waktu, M.jumlahtersedia, MH.emailchef, M.deskripsi, M.harga, K.nama AS kategori FROM MENU_HARIAN MH, MENU M, Kategori K WHERE MH.namamenu = M.nama AND DATE(waktu) = '$date' AND M.kategori = K.kode ORDER BY $group $sort");
			if($result == false || $result->rowCount() <= 0) {
				 return null;				
			} else {
				$menus = array();
				foreach ($result->fetchAll() as $row) {
					$menu = new Menu();
					$menu->name = $row['nama'];			
					$menu->time = $row['waktu'];
					$menu->amount = $row['jumlahtersedia'];
					$menu->emailC = $row['emailchef'];
					$menu->description = $row['deskripsi'];
					$menu->price = $row['harga'];
					$menu->category = $row['kategori'];
					array_push($menus, $menu);
				}
				return $menus;		
			}
		}

		public static function getLatest($limit, $offset) {
			$result = DB::query("SELECT * FROM MENU_HARIAN MH, MENU M WHERE namamenu = nama ORDER BY waktu DESC OFFSET $offset LIMIT $limit");
			if($result == false || $result->rowCount() <= 0) {
				return null;
			} else {
				$menus = array();
				foreach ($result->fetchAll() as $row) {
					$menu = new Menu();
					$menu->name = $row['namamenu'];			
					$menu->time = $row['waktu'];
					$menu->amount = $row['jumlahtersedia'];
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