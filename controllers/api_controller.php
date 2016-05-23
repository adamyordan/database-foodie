<?php
	require_once('model/user.php');
	require_once('model/purchase.php');
	require_once('model/order.php');

	class ApiController {

		public static function api_login() {
			$ok = true;
			if (!isset($_POST['email']) || !isset($_POST['password'])) {
				$ok = false;
			} else {
				$email = $_POST['email'];
				$password = $_POST['password'];
				$user = User::find($email);
				if ($user == null || $user->password != $password) {
					$ok = false;
				} else {
					$data = new stdClass();
					$data->status = "ok";
					$data->user   = $user;
					$_SESSION['login_user'] = $user->email;
					View::json($data);				
				}
			}

			if ($ok == false) {
				$data = new stdClass();
				$data->status = "failed";
				View::json($data);
			}
		}

		public static function api_logout() {
			if(isset($_SESSION['login_user'])) {

				$user = $_SESSION['login_user'];

				session_destroy();
				$data = new stdClass();
				$data->status = "ok";
				$data->user   = $user;

				View::json($data);

			} else {
				$data = new stdClass();
				$data->status = "failed";
				$data->error  = "there is no login user";
				View::json($data);
			}
		}

		public static function api_purchase() {
			$no_nota = $_POST['no_nota'];
			$time    = date('Y-m-d H:i:s');
			$supplier = $_POST['supplier'];
			$staff = self::checkAuth()->email;

			$mnames  = $_POST['mname'];
			$mprices = $_POST['mprice'];
			$munits  = $_POST['munit'];
			$mqtys   = $_POST['mqty'];
			$mtotals = $_POST['mtotal'];


			$purchase = new Material();
			$purchase->no = $no_nota;
			$purchase->time = $time;
			$purchase->supplier = $supplier;
			$purchase->staff = $staff;

			$purchase->details = array();

			for($i = 0; $i < count($mnames); $i++) {
				$detail = new stdClass();
				$detail->qty = $mqtys[$i];
				$detail->unit = $munits[$i];
				$detail->price = $mprices[$i];
				$detail->material = $mnames[$i];
				array_push($purchase->details, $detail);
			}

			$status = Purchase::save($purchase);

			$data = new stdClass();
			$data->status = $status;
			$data->purchase = $purchase;

			View::json($data);
		}

		public static function api_purchase_checkno() {
			$no = $_POST['no'];			
			if(Purchase::find($no) != null) {
				$data = new stdClass();
				$data->status = "failed";
			} else {
				$data = new stdClass();
				$data->status = "ok";
			}
			View::json($data);
		}

		public static function api_menu_get() {
			$limit  = isset($_POST['limit'])  ? $_POST['limit']  : 10;
			$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;

			$menus = Menu::getLatest($limit, $offset);

			$data = new stdClass();
			$data->status = "ok";
			$data->menus = $menus;
			View::json($data);
		}

		public static function api_order_get() {
			$limit  = isset($_POST['limit'])  ? $_POST['limit']  : 10;
			$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;

			$orders = Order::getLatest($limit, $offset);

			$data = new stdClass();
			$data->status = "ok";
			$data->orders = $orders;
			View::json($data);
		}

		public static function api_purchase_get() {
			$limit  = isset($_POST['limit'])  ? $_POST['limit']  : 10;
			$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;

			$purchases = Purchase::getLatest($limit, $offset);

			$data = new stdClass();
			$data->status = "ok";
			$data->purchases = $purchases;
			View::json($data);
		}

		private static function checkAuth() {
			if(empty($_SESSION['login_user'])){
				header('Location: index.php');
			}
			$login_user_email = $_SESSION['login_user'];
			return User::find($login_user_email);			
		}

	}
?>
