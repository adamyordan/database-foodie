<?php
	class Supplier {

		public $name;
		public $email;
		public $address;

		public static function find($name) {
			$result = DB::query("SELECT * FROM SUPPLIER WHERE nama='$name'");
			if($result == false || $result->rowCount() == 0) {
				return null;
			} else {
				$row = $result->fetchAll()[0];
				$supplier = new Supplier();
				$supplier->name = $row['nama'];
				$supplier->email = $row['email'];
				$supplier->address = $row['alamat'];
				return $supplier;
			}
		}

		public static function all() {
			$result = DB::query("SELECT * FROM SUPPLIER");
			if($result == false || $result->rowCount() <= 0) {
				return null;
			} else {
				$suppliers = array();
				foreach ($result->fetchAll() as $row) {
					$supplier = new Supplier();
					$supplier->name = $row['nama'];
					$supplier->email = $row['email'];
					$supplier->address = $row['alamat'];
					array_push($suppliers, $supplier);
				}
				return $suppliers;		
			}
		}
	}
?>