<?php
	require_once('model/user.php');

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

		public static function api_purchase_insert() {
			$no_nota = $_POST['no_nota'];
			$times   = 'now()';
			$supplier = $_POST['supplier'];
			$staf = $_POST['staf?'];

			$mnames  = $_POST['mname'];
			$mprices = $_POST['mprice'];
			$munits  = $_POST['munit'];
			$mqtys   = $_POST['mqty'];
			$mtotals = $_POST['mtotal'];


		}

	}
?>
