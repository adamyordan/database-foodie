<?php
	class Material {

		public $name;
		public $unit;
		public $stock;

		private function __clone() {}

		private function __construct() {}

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
	}
?>