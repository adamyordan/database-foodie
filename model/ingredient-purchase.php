<?php
	class IngredientPurchase
	{
		public $namabahanbaku;
		public $notapembelian;
		public $jumlahpembelian;
		public $satuanpembelian;
		public $hargasatuan;
		public $total;
		
		public static function findDetail($notapembelian)
		{
			$result = DB::query("SELECT * FROM PEMBELIAN_BAHAN_BAKU WHERE notapembelian='$notapembelian'");
			
			if ($result == false || $result->rowCount() <= 0) {
				return null;
			}
			else {
				$ingredientpurchases = array();
				$total = 0;
				
				foreach ($result->fetchAll() as $row) {
					$ingredientpurchase = new IngredientPurchase();
					$ingredientpurchase->namabahanbaku = $row['namabahanbaku'];
					$ingredientpurchase->notapembelian = $row['notapembelian'];
					$ingredientpurchase->jumlahpembelian = $row['jumlahpembelian'];
					$ingredientpurchase->satuanpembelian = $row['satuanpembelian'];
					$ingredientpurchase->hargasatuan = $row['hargasatuan'];
					$ingredientpurchase->total = $ingredientpurchase->jumlahpembelian * $ingredientpurchase->hargasatuan;
					
					$total += $ingredientpurchase->total;
					
					array_push($ingredientpurchases,$ingredientpurchase);
				}
				
				$return = new stdClass();
				$return->ingredientpurchases = $ingredientpurchases;
				$return->total = $total;
				
				return $return;
			}
		}
	}
?>