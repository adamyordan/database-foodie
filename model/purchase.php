<?php
	class Purchase {

		public $no;
		public $time;
		public $supplier;
		public $staff;

		public static function find($no) {
			$result = DB::query("SELECT * FROM PEMBELIAN WHERE NomorNota='$no'");
			if($result == false || $result->rowCount() == 0) {
				return null;
			} else {
				$row = $result->fetchAll()[0];
				$purchase = new Purchase();
				$purchase->no = $row['nomornota'];
				$purchase->time = $row['waktu'];
				$purchase->supplier = $row['namasupplier'];
				$purchase->supplier = $row['emailstaf'];
				return $purchase;
			}
		}

		public static function all()
		{
			$result = DB::query("SELECT * FROM PEMBELIAN ORDER BY nomornota DESC");
			if (!$result || $result->rowCount() == 0) {
				return null;
			}
			else {
				$purchases = array();
				foreach ($result->fetchAll() as $row) {
					$purchase = new Purchase();
					$purchase->no = $row['nomornota'];
					$purchase->time = $row['waktu'];
					$purchase->supplier = $row['namasupplier'];
					$staffEmail = $row['emailstaf'];
					
					$staffData = DB::query("SELECT * FROM USERS WHERE email='$staffEmail'");
					
					forEach ($staffData->fetchAll() as $rowTemp) {
						$purchase->staff = $rowTemp['nama'];
					}
					
					array_push($purchases,$purchase);
				}
				return $purchases;
			}
		}
		
		public static function sort($group, $sort)
		{
			$result = DB::query("SELECT * FROM PEMBELIAN ORDER BY $group $sort");
			if ($result == false || $result->rowCount() == 0) {
				return null;
			}
			else {
				$purchases = array();
				foreach ($result->fetchAll() as $row) {
					$purchase = new Purchase();
					$purchase->no = $row['nomornota'];
					$purchase->time = $row['waktu'];
					$purchase->supplier = $row['namasupplier'];
					$staffEmail = $row['emailstaf'];
					
					$staffData = DB::query("SELECT * FROM USERS WHERE email='$staffEmail'");
					
					forEach ($staffData->fetchAll() as $rowTemp) {
						$purchase->staff = $rowTemp['nama'];
					}
					
					array_push($purchases,$purchase);
				}
				return $purchases;
			}
		}
		
		public static function sortOnDate($group, $sort, $date)
		{
			$result = DB::query("SELECT * FROM PEMBELIAN WHERE WAKTU::DATE='$date' ORDER BY $group $sort");
			if ($result == false || $result->rowCount() == 0) {
				return null;
			}
			else {
				$purchases = array();
				foreach ($result->fetchAll() as $row) {
					$purchase = new Purchase();
					$purchase->no = $row['nomornota'];
					$purchase->time = $row['waktu'];
					$purchase->supplier = $row['namasupplier'];
					$staffEmail = $row['emailstaf'];
					
					$staffData = DB::query("SELECT * FROM USERS WHERE email='$staffEmail'");
					
					forEach ($staffData->fetchAll() as $rowTemp) {
						$purchase->staff = $rowTemp['nama'];
					}
					
					array_push($purchases,$purchase);
				}
				return $purchases;
			}
		}
		
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

		public static function getLatest($limit, $offset) {
			$result = DB::query("SELECT * FROM PEMBELIAN ORDER BY waktu DESC OFFSET $offset LIMIT $limit");
			if($result == false || $result->rowCount() <= 0) {
				return null;
			} else {
				$purchases = array();
				foreach ($result->fetchAll() as $row) {
					$purchase = new Purchase();
					$purchase->no = $row['nomornota'];
					$purchase->time = $row['waktu'];
					$purchase->supplier = $row['namasupplier'];
					$purchase->staff = $row['emailstaf'];				
					array_push($purchases,$purchase);
				}
				return $purchases;
			}
		}
		
		public static function getWithinPeriod($startDate, $endDate)
		{
			$result = DB::query("SELECT * FROM PEMBELIAN AS P WHERE (((P.WAKTU)::DATE) >= '$startDate') AND (((P.WAKTU)::DATE) <= '$endDate') ORDER BY P.WAKTU");
			
			if (!$result || $result->rowCount() == 0) {
				return null;
			}
			else {
				$purchases = array();
				foreach ($result->fetchAll() as $row) {
					$purchase = new Purchase();
					$purchase->no = $row['nomornota'];
					$purchase->time = $row['waktu'];
					$purchase->supplier = $row['namasupplier'];
					$staffEmail = $row['emailstaf'];
					
					$staffData = DB::query("SELECT * FROM USERS WHERE email='$staffEmail'");
					
					forEach ($staffData->fetchAll() as $rowTemp) {
						$purchase->staff = $rowTemp['nama'];
					}
					
					array_push($purchases,$purchase);
				}
				return $purchases;
			}
		}
	}
?>