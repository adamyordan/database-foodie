<?php
	class Purchase {

		public $no;
		public $time;
		public $supplier;
		public $staff;

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

		// public static function all() {
		// 	$result = DB::query("SELECT * FROM BAHAN_BAKU");
		// 	if($result == false || $result->rowCount() <= 0) {
		// 		return null;
		// 	} else {
		// 		$materials = array();
		// 		foreach ($result->fetchAll() as $row) {
		// 			$material = new Material();
		// 			$material->name = $row['nama'];
		// 			$material->unit = $row['satuanstok'];
		// 			$material->stock = $row['stok'];
		// 			array_push($materials, $material);
		// 		}
		// 		return $materials;		
		// 	}
		// }

		public static function save($p) {
			$result = DB::query("INSERT INTO PEMBELIAN VALUES ('$p->no', '$p->time', '$p->supplier', '$p->staff')");
			if ($result == false) return "failed in relation PEMBELIAN";

			foreach ($p->details as $d) {
				$query = "INSERT INTO PEMBELIAN_BAHAN_BAKU VALUES ('$d->material', '$p->no', '$d->qty', '$d->unit', '$d->price')";
				$result = DB::query($query);
				if ($result == false) return "failed at $query";
			}

			return "ok";
		}
	}
?>