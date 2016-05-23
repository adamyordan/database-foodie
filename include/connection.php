<?php
	class DB {
		private static $instance = NULL;

		private function __construct() {}

		private function __clone() {}

		public static function getInstance() {
			if (!isset(self::$instance)) {
				// $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				self::$instance = new PDO("pgsql:dbname=" . DBNAME . ";host=" . DBHOST . ";port=" . DBPORT, DBUSER, DBPASS); 		
				$result = self::$instance->exec('SET search_path TO foodie');
			}
			return self::$instance;
		}

		public static function query($q) {
			return self::getInstance()->query($q);
		}
	}
?>