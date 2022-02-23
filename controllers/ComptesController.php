<?php

class ComptesController
{

	public function auth()
	{
		if (isset($_POST['submit'])) {
			$data['email'] = $_POST['email'];
			$result = Compte::login($data);
			if ($result->email == $_POST['email'] && password_verify($_POST['password'], $result->password)) {

				$_SESSION['logged'] = true;
				$_SESSION['email'] = $result->email;
				$_SESSION['name'] = $result->name;
				$_SESSION['role'] = $result->role;
				$_SESSION['id'] = $result->id;
				Redirect::to('dashboard');
			} else {
				Session::set('error', 'email ou mot de passe est incorrect');
				Redirect::to('login');
			}
		}
	}

	public function register()
	{
		if (isset($_POST['submit'])) {

			// //image

			// $name = $_FILES['file']['name'];
			// $target_file = basename($_FILES["file"]["name"]);

			// // Select file type
			// $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			// // Valid file extensions
			// $extensions_arr = array("jpg", "jpeg", "png", "gif");

			// // Check extension
			// if (in_array($imageFileType, $extensions_arr)) {
			// 	// Upload file
			// 	if (move_uploaded_file($_FILES['file']['tmp_name'], $name)) {

			$options = [
				'cost' => 12
			];
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
			$data1 = array(
				'name' => $_POST['name'],
				'email' => $_POST['email'],
				'password' => $password,
				'role' => $_POST['role'],
			);
			$result1 = Compte::createUser($data1);
			$data2 = array(
				'nom' => $_POST['nom'],
				'prenom' => $_POST['prenom'],
				'age' => 23,
				// 'avatar' => $name,
				'compte_id' => $result1->id,
			);
			$result2 = User::add($data2);
			if ($result2 === 'ok') {
				Session::set('success', 'Compte crée');
				Redirect::to('login');
				// }else{
				echo $result2;
			}
			// }
			// }
		}
	}

	static public function getResetPassword()
	{
		$user = Compte::getUserProfil();
		return $user;
	}

	static public function updatePassword()
	{
		if (isset($_POST['submit'])) {
			$options = [
				'cost' => 12
			];

			$oldPassword = Compte::getUserProfil();

			$currentPassword = $_POST['currentPassword'];
			$newPassword = $_POST['newPassword'];
			$confPassword = $_POST['confPassword'];

			// if($newPassword != $confPassword){
			// 	return 'the new and confirmation password not match';
			// }

			if (password_verify($currentPassword, $oldPassword->password) && $newPassword == $confPassword) {

				$password = password_hash($_POST['newPassword'], PASSWORD_BCRYPT, $options);
				$data1 = array(
					'id' => $_POST['id'],
					'password' => $password,
				);

				$result1 = Compte::updatePassword($data1);

				if ($result1 === 'ok') {
					Session::set('success', 'Compte crée');

					if ($_SESSION['role'] == 'admin') {
						Redirect::to('listUser');
					} else {
						Redirect::to('profilUser');
					}

					echo $result1;
				}
			} else if (!password_verify($currentPassword, $oldPassword->password) && $newPassword == $confPassword) {
				echo 'old and current password not match';
			} else if (password_verify($currentPassword, $oldPassword->password) && $newPassword != $confPassword) {
				echo 'new and confirmation password not match';
			} else {
				echo 'all passwords Incorrect';
			}
		}
	}

	static public function logout()
	{
		session_destroy();
	}
}
