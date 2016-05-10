<?php
	class PagesController {

		public static function home() {
			$first_name = 'Jon';
			$last_name = 'Snow';
			View::render('pages/home', [
				'first_name' => $first_name,
				'last_name'  => $last_name
				]);
		}

		public static function look() {
			View::render('pages/look', []);
		}

		public static function purchase() {
			View::render('pages/purchase', []);
		}

		public static function error() {
			View::render('pages/error');
		}

	}
?>