<?php

class UsersController
{

	//get all users inside role panels
	public function getAllUsers()
	{
		if ($_SESSION['role'] == 'admin') {
			$users = User::getAll();
		} else {
			$users = User::getUserRoleStudent($_SESSION['email']);
		}
		return $users;
	}

	//git single user in admin panel
	public function getOneUser()
	{
		if (isset($_POST['id'])) {
			$data = array(
				'id' => $_POST['id']
			);
			$user = User::getUser($data);
			return $user;
		}
	}

	public function getProfilUser()
	{
		$user = User::getProfilUser($_SESSION['id']);
		return $user;
	}

	//find a user by search in admin panel
	public function findUsers()
	{
		if (isset($_POST['search'])) {
			$data = array('search' => $_POST['search']);
		}
		$users = User::searchUser($data);
		return $users;
	}

	//add a user in admin panel
	public function addUser()
	{
		if (isset($_POST['submit'])) {
			$data = array(
				'nom' => $_POST['nom'],
				'prenom' => $_POST['prenom'],
				'age' => $_POST['age'],
				'compte_id' => 2,
			);
			$result = User::add($data);
			if ($result === 'ok') {
				Session::set('success', 'User Ajouté');
				Redirect::to('listUser');
			} else {
				echo $result;
			}
		}
	}

	//update a user in roles panels
	public function updateUser()
	{
		if (isset($_POST['submit'])) {
			$data1 = array(
				'id' => $_POST['id'],
				'nom' => $_POST['nom'],
				'prenom' => $_POST['prenom'],
				'age' => $_POST['age'],
			);
			$result1 = User::update($data1);
			if ($_SESSION['role'] == 'admin') {
				$data2 = array(
					'id' => $result1->compte_id,
					'name' => $_POST['name'],
					'email' => $_POST['email'],
					'role' => $_POST['role'],
				);
			} else {
				$data2 = array(
					'id' => $result1->compte_id,
					'name' => $_POST['name'],
					'email' => $_POST['email'],
				);
			}
			$result2 = Compte::updateUser($data2);
			if ($result2 === 'ok') {
				Session::set('success', 'User Modifié');
				if ($_SESSION['role'] == 'admin') {
					Redirect::to('listUser');
				} else {
					Redirect::to('profilUser');
				}
			} else {
				echo $result2;
			}
		}
	}

	public function updateProfilUser()
	{
		if (isset($_POST['submit'])) {
			$data1 = array(
				'id' => $_POST['id'],
				'nom' => $_POST['nom'],
				'prenom' => $_POST['prenom'],
				'age' => $_POST['age'],
			);
			$result1 = User::update($data1);

			$data2 = array(
				'id' => $result1->compte_id,
				'name' => $_POST['name'],
				'email' => $_POST['email'],
			);

			$result2 = Compte::updateProfilUser($data2);
			if ($result2 === 'ok') {
				Session::set('success', 'User Modifié');
				Redirect::to('myProfil');
			} else {
				echo $result2;
			}
		}
	}

	//delete a user in admin panel
	public function deleteuser()
	{
		if (isset($_POST['id'])) {
			$data['id'] = $_POST['id'];
			$result = User::delete($data);
			if ($result === 'ok') {
				Session::set('success', 'User Supprimé');
				Redirect::to('listUser');
			} else {
				echo $result;
			}
		}
	}
}
