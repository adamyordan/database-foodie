<?php
	require_once('model/supplier.php');
	require_once('model/material.php');
	require_once('model/menu.php');
	require_once('model/unit.php');
	require_once('model/order.php');
	require_once('model/daily-order.php');

	class PagesController {

		public static function login() {
			if(!empty($_SESSION['login_user'])){
				header('Location: index.php?p=look');
			}
			View::render('pages/login',[]);
		}

		public static function home() {
			$user = self::checkAuth();
			View::render('pages/home', ['user' => $user]);
		}

		public static function error() {
			View::render('pages/error',[]);
		}

		public static function purchase() {
			$user = self::checkAuth();
			$suppliers = Supplier::list();
			$materials = Material::list();
			$units     = Unit::list();
			View::render('pages/newpurchase/index', [
				'user'      => $user,
				'suppliers' => $suppliers,
				'materials' => $materials,
				'units'     => $units
				]);
		}


		public static function order() {
			$user = self::checkAuth();
			$orders = Order::orderList();
			View::render('pages/order/index',[
				'user' => $user,
				'orders' => $orders
				]);
		}

		public static function purchaseList() {
			$user = self::checkAuth();
			$purchases = Purchase::all();
			View::render('pages/purchase/index',[
				'user' => $user,
				'purchases' => $purchases
			]);
		}

		public static function menu() {
			if (empty($_POST['date']) === false){
				$var = $_POST['date'];
				$tgl = str_replace('/', '-', $var);
				$date = date('Y-m-d', strtotime($tgl));

				$group = $_POST['group'];
				$sort = $_POST['sort'];
				$dmenus = Menu::daily_menu($date, $group, $sort);
			
				$menus = Menu::all();
				$user = self::checkAuth();
				
				View::render('pages/menu/index',[
					'user' => $user, 
					'menus' => $menus,
					'dmenus' => $dmenus
					]);
			} else {
				$menus = Menu::all();
				$dmenus = Menu::all();
				$user = self::checkAuth();
				
				View::render('pages/menu/index',[
					'user' => $user, 
					'menus' => $menus,					
					'dmenus' => $dmenus
					]);
			}
		}

		public static function menuDetail() {
			$name = urldecode ($_GET['name']);
			$time = urldecode ($_GET['time']);
			$user = self::checkAuth();
			$menudt = Menu::menu_detail($name, $time);
			View::render('pages/menu/detail',[
				'user' => $user,
				'menudt' => $menudt
				]);

		}		
		
		// non route methods
		private static function checkAuth() {
			if(empty($_SESSION['login_user'])){
				header('Location: index.php?p=login');
			}
			$login_user_email = $_SESSION['login_user'];
			return User::find($login_user_email);			
		}


	}
?>
