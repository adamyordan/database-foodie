<?php
	class IngredientPurchase
	{
		public $namabahanbaku;
		public $notapembelian;
		public $jumlahpembelian;
		public $satuanpembelian;
		public $hargasatuan;
		
		public static function findDetail($no)
		{
			$result = DB::query("SELECT * FROM PEMBELIAN_BAHAN_BAKU WHERE notapembelian='$no'");
			
			if ($result == false || $result->rowCount() <= 0) {
				return null;
			}
			else {
				$ingredientpurchases = array();
				
				foreach ($result->fetchAll() as $row) {
					$ingredientpurchase = new IngredientPurchase();
					$ingredientpurchase->namabahanbaku = $row['namabahanbaku'];
					$ingredientpurchase->notapembelian = $row['notapembelian'];
					$ingredientpurchase->jumlahpembelian = $row['jumlahpembelian'];
					$ingredientpurchase->satuanpembelian = $row['satuanpembelian'];
					$ingredientpurchase->hargasatuan = $row['hargasatuan'];
					
					array_push($ingredientpurchases,$ingredientpurchase);
				}
				
				return $ingredientpurchases;
			}
		}
	}
?>