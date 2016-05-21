<?php
	class Unit {

		public static function all() {
			$result = DB::query("SELECT distinct satuanawal FROM KONVERSI");
			if($result == false || $result->rowCount() <= 0) {
				return null;
			} else {
				$units = array();
				foreach ($result->fetchAll() as $row) {
					array_push($units, $row['satuanawal']);
				}
				return $units;		
			}
		}

	}
?>