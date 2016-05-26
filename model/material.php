<?php
	class Material {

		public $name;
		public $unit;
		public $stock;

		public static function find($name) {
			$result = DB::query("SELECT * FROM BAHAN_BAKU WHERE nama='$name'");
			if($result == false || $result->rowCount() == 0) {
				return null;
			} else {
				$row = $result->fetchAll()[0];
				$material = new Material();
				$material->name = $row['nama'];
				$material->unit = $row['satuanstok'];
				$material->stock = $row['stok'];
				return $material;
			}
		}

		public static function all() {
			$result = DB::query("SELECT * FROM BAHAN_BAKU");
			if($result == false || $result->rowCount() <= 0) {
				return null;
			} else {
				$materials = array();
				foreach ($result->fetchAll() as $row) {
					$material = new Material();
					$material->name = $row['nama'];
					$material->unit = $row['satuanstok'];
					$material->stock = $row['stok'];
					array_push($materials, $material);
				}
				return $materials;		
			}
		}

		public static function lists() {
			$result = DB::query("SELECT nama FROM BAHAN_BAKU");
			if($result == false || $result->rowCount() <= 0) {
				return array();
			} else {
				$materials = array();
				foreach ($result->fetchAll() as $row) {
					array_push($materials, $row['nama']);
				}
				return $materials;		
			}
		}

		public static function save($m) {
			$result = DB::query("INSERT INTO BAHAN_BAKU VALUES ('$m->name', '$m->unit', '$m->stock')");
		}
	}
?>