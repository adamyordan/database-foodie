<?php
	require_once('model/user.php');

	class ApiController {

		public static function api_login() {
			if(isset($_POST['email']) && isset($_POST['password'])) {
				$email = $_POST['email'];
				$password = $_POST['password'];
				$user = User::find($email);
				$data = new stdClass();
				$data->status = "ok";
				$data->user   = $user;
				$_SESSION['login_user'] = $user->email;
				View::json($data);				
			} else {
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
		}

	}
?>
