<?php
	class User {

		public $email;
		public $name;
		public $address;
		public $role;

		private function __clone() {}

		private function __construct() {}

		public static function find($email) {
			$user = new User();
			if ($email == "adam.jordan@ui.ac.id") {
				$user->email = "adam.jordan@ui.ac.id";
				$user->name  = "Adam Jordan";
				$user->address = "Jakarta Kota";
				$user->role = "MG";
				$user->job  = "Manager";
			} else if ($email == "geraldo@ui.ac.id") {
				$user->email = "geraldo@ui.ac.id";
				$user->name  = "Geraldo";
				$user->address = "Jakarta Kota";
				$user->role = "KA";
				$user->job  = "Kasir";
			} else if ($email == "muhammad.zaky@ui.ac.id") {
				$user->email = "muhammad.zaky@ui.ac.id";
				$user->name  = "Muhammad Zaky";
				$user->address = "Jakarta Kota";
				$user->role = "ST";
				$user->job  = "Staf";
			} else if ($email == "falah.prasetyo@ui.ac.id") {
				$user->email = "falah.prasetyo@ui.ac.id";
				$user->name  = "Falah Prasetyo";
				$user->address = "Jakarta Kota";
				$user->role = "CH";
				$user->job  = "Chef";
			} else {
				$user->email = "adam.jordan@ui.ac.id";
				$user->name  = "Adam Jordan";
				$user->address = "Jakarta Kota";
				$user->role = "MG";
				$user->job  = "Manager";				
			}
			return $user;
		}
	}
?>