<?php

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController {

	public static function login(Router $router) {
		$alerts = [];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$auth = new User($_POST);
			$alerts = $auth->validateLogin();

			if (empty($alerts)) {
				// Comprobar que el usuario exista
				$user = User::where('email', $auth->email);

				if ($user) {
					// Verificar la contraseña
					if ($user->checkPassAndVer($auth->password)) {
						// Autenticar al usuario
						if (!isset($_SESSION)) {
							session_start();
						} else {
							session_unset();
						}

						$_SESSION['id'] = $user->id;
						$_SESSION['name'] = $user->name . " " . $user->surname;
						$_SESSION['email'] = $user->email;
						$_SESSION['login'] = true;

						// Redireccionar
						if ($user->admin == "1") {
							$_SESSION['admin'] = $user->admin ?? null;
							header('Location: /admin');
						} else {
							header('Location: /quote');
						}
					}

				} else {
					User::setAlert('error', 'Usuario no encontrado');
				}
			}
		}

		$alerts = User::getalerts();

		$router->render('auth/login', [
			'alerts' => $alerts,
		]);

	}

	public static function logout() {

		session_start();
		session_unset();
		$_SESSION = [];

		header('Location: /');

	}

	public static function forgot(Router $router) {

		$auth = new User();
		$alerts = [];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$auth->syncUp($_POST);
			$alerts = $auth->validateEmail();

			if (empty($alerts)) {
				$user = User::where('email', $auth->email);

				if ($user && $user->confirmed == "1") {

					// Generar un token
					$user->createToken();
					$user->save();

					// Enviar un email
					$mail = new Email($user->email, $user->name, $user->token);
					$mail->sendInstructions();

					// Enviar alerta de éxito
					User::setAlert('success', 'Revisa tu email');

				} else {
					User::setAlert('error', 'El usuario no existe o no está confirmado');
				}
			}
		}

		$alerts = User::getalerts();

		$router->render('auth/forgot', [
			'alerts' => $alerts,
		]);
	}

	public static function recover(Router $router) {

		$alerts = [];

		// Variable de error por si el token no es válido que no muestre el formulario.
		$error = false;

		// Obtiene y sanitiza el token enviado por GET
		$token = s($_GET['token']);

		// Buscar al usuario por su token
		$user = User::where('token', $token);

		if (empty($user)) {
			User::setAlert('error', 'Token no válido');
			$error = true;
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// Leer la nueva contraseña y guardarla
			$password = new User($_POST);
			$alerts = $password->validatePassword();

			if (empty($alerts)) {

				$user->password = null;
				$user->password = $password->password;
				$user->hashPassword();
				$user->token = null;
				$result = $user->save();

				if ($result) {
					header('Location: /');
				}

			}
		}

		$alerts = User::getalerts();

		$router->render('auth/recover-password', [
			'alerts' => $alerts,
			'error' => $error,
		]);
	}

	public static function create(Router $router) {

		$user = new User();

		// Alertas vacias
		$alerts = [];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$user->syncUp($_POST);
			$alerts = $user->validateNewAccount();

			// Revisar que alerts este vacio
			if (empty($alerts)) {

				// Verificar que el usuario no exista
				$result = $user->userExists();

				if ($result->num_rows) {
					$alerts = User::getalerts();
				} else {

					// Hashear la contraseña
					$user->hashPassword();

					// Generar un token único
					$user->createToken();

					// Crear el usuario
					$result = $user->save();

					if ($result) {
						header('Location: /');
					}

				}

			}

		}

		$router->render('auth/create-account', [
			'user' => $user,
			'alerts' => $alerts,
		]);
	}

	public static function message(Router $router) {
		$router->render('auth/message');
	}

	public static function confirm(Router $router) {

		$alerts = [];

		$token = s($_GET['token']);
		$user = User::where('token', $token);

		if (empty($user)) {
			User::setAlert('error', 'Token no válido');
		} else {
			$user->confirmed = "1";
			$user->token = null;
			$user->save();
			User::setAlert('success', 'Cuenta comprobada correctamente');
		}

		$alerts = User::getalerts();
		$router->render('auth/confirm-account', [
			'alerts' => $alerts,
		]);
	}

}

?>