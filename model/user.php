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
			$user->email = "adam.jordan@ui.ac.id";
			$user->name  = "Adam Jordan";
			$user->address = "Jakarta Kota";
			$user->role = "MG";
			$user->job  = "Manager";
			return $user;
		}
	}
?>