<?php
	/**
	 * User - Model representing user
	 *
	 */
	class User {

		public $email;
		public $name;
		public $address;
		public $password;
		public $role;
		public $job;

		public static function find($email) {
			$result = DB::query("SELECT * FROM USERS WHERE email='$email'");
			if($result == false || $result->rowCount() == 0) {
				return null;
			} else {
				$row = $result->fetchAll()[0];
				$user = new User();
				$user->email = $row['email'];
				$user->name  = $row['nama'];
				$user->address = $row['alamat'];
				$user->password = $row['password'];				
				$user->role = $row['role'];
				if      ($user->role == 'MG') $user->job = "Manager";
				else if ($user->role == 'KS') $user->job = "Kasir";
				else if ($user->role == 'CH') $user->job = "Chef";
				else if ($user->role == 'ST') $user->job = "Staf";
				return $user;
			}
		}

		public static function authenticate($email, $pass) {
			$result = DB::query("SELECT count(*) AS c FROM USERS WHERE email='$email' AND password='$pass'");
			return ($result != false && $result->fetch()['c'] > 0);
		}
	}
?>