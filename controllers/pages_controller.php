<?php
	require_once('model/supplier.php');
	require_once('model/material.php');
	require_once('model/order.php');
	require_once('model/daily-order.php');

	class PagesController {

		public static function home() {
			if(!empty($_SESSION['login_user'])){
				header('Location: index.php?p=look');
			}
			View::render('pages/home',[]);
		}

		public static function look() {
			$user = self::checkAuth();
			View::render('pages/look', ['user' => $user]);
		}

		public static function purchase() {
			$user = self::checkAuth();
			$suppliers = Supplier::all();
			$materials = Material::all();
			View::render('pages/purchase', [
				'user' => $user,
				'suppliers' => $suppliers,
				'materials' => $materials
				]);
		}

		public static function error() {
			View::render('pages/error',[]);
		}

		public static function order() {
			$user = self::checkAuth();
			$orders = Order::orderList();
			View::render('pages/order',[
				'user' => $user,
				'orders' => $orders
				]);
		}
		
		public static function purchaseList() {
			$user = self::checkAuth();
			View::render('pages/purchaseList',['user' => $user]);
		}

		public static function orderDetail() {
			$user = self::checkAuth();
			View::render('pages/order-detail',['user' => $user]);
		}

		public static function menu() {
			$user = self::checkAuth();
			View::render('pages/menu',['user' => $user]);
		}

		public static function menuDetail() {
			$user = self::checkAuth();
			View::render('pages/menu-detail',['user' => $user]);
		}		
		
		public static function purchaseDetail() {
			$user = self::checkAuth();
			View::render('pages/purchase-detail',['user' => $user]);
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
