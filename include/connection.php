<?php
	class DB {
		private static $instance = NULL;
		private static $dbname   = "postgres";
		private static $dbhost   = "localhost";
		private static $dbport   = "5432";
		private static $dbuser   = "postgres";
		private static $dbpass   = "root";

		private function __construct() {}

		private function __clone() {}

		public static function getInstance() {
			if (!isset(self::$instance)) {
				// $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				self::$instance = new PDO("pgsql:dbname=" . self::$dbname . ";host=" . self::$dbhost . ";port=" . self::$dbport, self::$dbuser, self::$dbpass); 		
				$result = self::$instance->exec('SET search_path TO foodie');
				// if ( ! $result) {
				//     die('Failed to set schema');
				// }
			}
			return self::$instance;
		}

		public static function query($q) {
			return self::getInstance()->query($q);
		}
	}
?>