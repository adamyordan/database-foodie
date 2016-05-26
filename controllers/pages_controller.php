<?php
	require_once('model/supplier.php');
	require_once('model/material.php');
	require_once('model/menu.php');
	require_once('model/unit.php');
	require_once('model/order.php');
	require_once('model/daily-order.php');

	class PagesController {

		/** Region pages available for general user */

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

		/* Region pages available for chef and kasir */

		public static function menu() {
			$user = self::checkAuth();
			self::checkRole($user, ["Chef", "Kasir", "Manager"]);

			if (empty($_POST['date']) === false){
				$var = $_POST['date'];
				$tgl = str_replace('/', '-', $var);
				$date = date('Y-m-d', strtotime($tgl));

				$group = $_POST['group'];
				$sort = $_POST['sort'];
				$dmenus = Menu::daily_menu($date, $group, $sort);
			
				$menus = Menu::all();
				
				View::render('pages/menu/index',[
					'user' => $user, 
					'menus' => $menus,
					'dmenus' => $dmenus
					]);
			} else {
				$menus = Menu::all();
				$dmenus = Menu::all();
				
				View::render('pages/menu/index',[
					'user' => $user, 
					'menus' => $menus,					
					'dmenus' => $dmenus
					]);
			}
		}

		public static function menuDetail() {
			$user = self::checkAuth();
			self::checkRole($user, ["Chef", "Kasir", "Manager"]);
			$name = urldecode ($_GET['name']);			
			$menudt = Menu::menu_detail($name);
			View::render('pages/menu/detail',[
				'user' => $user,
				'menudt' => $menudt
				]);

		}

		/* Region pages available for kasir */

		public static function order() {
			$user = self::checkAuth();
			self::checkRole($user, ["Kasir", "Manager"]);
			$orders = Order::orderList();
			View::render('pages/order/index',[
				'user' => $user,
				'orders' => $orders
				]);
		}


		/* Region pages available for staf */

		public static function purchaseList() {
			$user = self::checkAuth();
			self::checkRole($user, ["Staf", "Manager"]);
			$purchases = Purchase::all();
			View::render('pages/purchase/index',[
				'user' => $user,
				'purchases' => $purchases
			]);
		}

		public static function purchase() {
			$user = self::checkAuth();
			self::checkRole($user, ["Staf", "Manager"]);
			$suppliers = Supplier::lists();
			$materials = Material::lists();
			$units     = Unit::lists();
			View::render('pages/newpurchase/index', [
				'user'      => $user,
				'suppliers' => $suppliers,
				'materials' => $materials,
				'units'     => $units
				]);
		}		
		
		
		/* Non Route function */

		private static function checkAuth() {
			if(empty($_SESSION['login_user'])){
				header('Location: index.php?p=login');
			}
			$login_user_email = $_SESSION['login_user'];
			return User::find($login_user_email);			
		}

		private static function checkRole($user, $roles) {
			foreach ($roles as $role) {
				if ($user->job == $role) return;
			}
			header('Location: index.php?p=home');
		}


	}
?>
