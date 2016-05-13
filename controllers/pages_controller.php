<?php
	class PagesController {

		public static function home() {
			View::render('pages/home');
		}

		public static function look() {
			$user = self::checkAuth();
			View::render('pages/look', ['user' => $user]);
		}

		public static function purchase() {
			$user = self::checkAuth();
			View::render('pages/purchase', ['user' => $user]);
		}

		public static function error() {
			View::render('pages/error',[]);
		}

		public static function order() {
			$user = self::checkAuth();
			View::render('pages/order',['user' => $user]);
		}
		
		public static function purchaseList() {
			$user = self::checkAuth();
			View::render('pages/purchaseList',['user' => $user]);
		}

		public static function orderDetail() {
			$user = self::checkAuth();
			View::render('pages/order-detail',['user' => $user]);
		}

		// non route methods
		private static function checkAuth() {
			if(empty($_SESSION['login_user'])){
				header('Location: index.php');
			}
			$login_user_email = $_SESSION['login_user'];
			return User::find($login_user_email);			
		}

	}
?>
