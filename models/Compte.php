<?php

class Compte
{

	private $db;
	public function __construct()
	{
		$this->db = new DB;
	}

	static public function login($data)
	{
		$email = $data['email'];
		try {
			$query = 'SELECT * FROM comptes WHERE email=:email';
			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array(":email" => $email));
			$user = $stmt->fetch(PDO::FETCH_OBJ);
			return $user;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function createUser($data)
	{
		$stmt = DB::connect()->prepare('INSERT INTO comptes (name,email,password,role)
			VALUES (:name,:email,:password,:role)');
		$stmt->bindParam(':name', $data['name']);
		$stmt->bindParam(':email', $data['email']);
		$stmt->bindParam(':password', $data['password']);
		$stmt->bindParam(':role', $data['role']);

		if ($stmt->execute()) {
			$email = $data['email'];
			$query = 'SELECT * FROM comptes WHERE email=:email';
			$id = DB::connect()->prepare($query);
			$id->execute(array(":email" => $email));
			$user = $id->fetch(PDO::FETCH_OBJ);
			return $user;
		} else {
			return 'error';
		}
	}

	static public function updateUser($data)
	{
		if ($_SESSION['role'] == 'admin') {
			$stmt = DB::connect()->prepare('UPDATE comptes SET name= :name,email=:email,role=:role WHERE id=:id');
			$stmt->bindParam(':id', $data['id']);
			$stmt->bindParam(':name', $data['name']);
			$stmt->bindParam(':email', $data['email']);
			$stmt->bindParam(':role', $data['role']);
		} else {
			$stmt = DB::connect()->prepare('UPDATE comptes SET name= :name,email=:email WHERE id=:id');
			$stmt->bindParam(':id', $data['id']);
			$stmt->bindParam(':name', $data['name']);
			$stmt->bindParam(':email', $data['email']);
		}
		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}
	}

	static public function updateProfilUser($data)
	{
		$stmt = DB::connect()->prepare('UPDATE comptes SET name= :name,email=:email WHERE id=:id');
		$stmt->bindParam(':id', $data['id']);
		$stmt->bindParam(':name', $data['name']);
		$stmt->bindParam(':email', $data['email']);
		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}
	}

	static public function getUserProfil()
	{
		try {
			$query = 'SELECT *,
			            comptes.name as name,
			            comptes.role as role,
			            comptes.email as email,
						comptes.password as password,
			            comptes.created_at as created_at
			            FROM users
			            INNER JOIN comptes
			            ON comptes.id = users.compte_id
			            WHERE users.id=:id';
			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array(":id" => $_SESSION['id']));
			$user = $stmt->fetch(PDO::FETCH_OBJ);
			return $user;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function updatePassword($data)
	{
		$query = 'SELECT * FROM users WHERE id=:id';
		$pass = DB::connect()->prepare($query);
		$pass->execute(array(":id" => $data['id']));
		$user = $pass->fetch(PDO::FETCH_OBJ);

		$stmt = DB::connect()->prepare('UPDATE comptes SET password= :password WHERE id=:id');
		$stmt->bindParam(':id', $user->compte_id);
		$stmt->bindParam(':password', $data['password']);

		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}
	}
}
