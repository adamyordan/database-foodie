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
			View::render('pages/error',[]);
		}

		public static function order() {
			View::render('pages/order',[]);
		}
		
		public static function purchaseList() {
			View::render('pages/purchaseList',[]);
		}

		public static function orderDetail() {
			View::render('pages/order-detail',[]);
		}

		public static function menu() {
			View::render('pages/menu',[]);
		}

		public static function menuDetail() {
			View::render('pages/menu-detail',[]);
		}		

	}
?>
