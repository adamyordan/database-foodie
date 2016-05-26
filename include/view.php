<?php
	class View {
		private function __construct() {}

		private function __clone() {}
		
		/**
		 * Render a view .php file
		 */
		public static function render($page, $data) {
			$data['__content__'] = 'views/' . $page . '.php';
			require_once ('views/layout.php');
		}

		/**
		 * Return a data in json format
		 */
		public static function json($data) {
			echo json_encode($data);
		}
	}
?>