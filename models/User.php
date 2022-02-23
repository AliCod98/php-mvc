<?php

class User
{

	static public function getAll()
	{
		$stmt = DB::connect()->prepare('SELECT *,
		                users.id as id,
		                users.nom as nom,
		                users.prenom as prenom,
		                users.age as age,
		                comptes.name as name,
		                comptes.role as role,
		                comptes.email as email,
		                comptes.created_at as created_at
	                    FROM users
		                INNER JOIN comptes
		                ON comptes.id = users.compte_id
		                ORDER BY comptes.created_at DESC');
						
		$stmt->execute();
		return $stmt->fetchAll();
	}

	static public function getUserRoleStudent($data)
	{
		$email = $data;
		try {
		    $query = 'SELECT *,
			            users.id as id,
			            users.nom as nom,
			            users.prenom as prenom,
			            users.age as age,
			            comptes.name as name,
			            comptes.role as role,
			            comptes.email as email,
			            comptes.created_at as created_at
			            FROM users
			            INNER JOIN comptes
			            ON comptes.id = users.compte_id
			            WHERE comptes.email=:email';

			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array(":email" => $email));
			$user = $stmt->fetch(PDO::FETCH_OBJ);
			return $user;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function getUser($data)
	{
		$id = $data['id'];
		try {
			$query = 'SELECT *,
			            users.id as id,
			            users.nom as nom,
			            users.prenom as prenom,
			            users.age as age,
			            comptes.name as name,
			            comptes.role as role,
			            comptes.email as email,
			            comptes.created_at as created_at
			            FROM users
			            INNER JOIN comptes
			            ON comptes.id = users.compte_id
			            WHERE users.id=:id';

			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array(":id" => $id));
			$user = $stmt->fetch(PDO::FETCH_OBJ);
			return $user;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function getProfilUser($data)
	{
		$id = $data;
		try {
			$query = 'SELECT *,
			            users.id as id,
			            users.nom as nom,
			            users.prenom as prenom,
			            users.age as age,
			            comptes.name as name,
			            comptes.role as role,
			            comptes.email as email,
			            comptes.created_at as created_at
			            FROM users
			            INNER JOIN comptes
			            ON comptes.id = users.compte_id
			            WHERE users.id=:id';

			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array(":id" => $id));
			$user = $stmt->fetch(PDO::FETCH_OBJ);
			return $user;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function add($data)
	{
		$stmt = DB::connect()->prepare('INSERT INTO users (nom,prenom,age,compte_id)
			VALUES (:nom,:prenom,:age,:compte_id)');
		$stmt->bindParam(':nom', $data['nom']);
		$stmt->bindParam(':prenom', $data['prenom']);
		$stmt->bindParam(':age', $data['age']);
		$stmt->bindParam(':compte_id', $data['compte_id']);

		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}
	}
	static public function update($data)
	{
		$stmt = DB::connect()->prepare('UPDATE users SET nom=:nom,prenom=:prenom,age=:age WHERE id=:id');
		$stmt->bindParam(':id', $data['id']);
		$stmt->bindParam(':nom', $data['nom']);
		$stmt->bindParam(':prenom', $data['prenom']);
		$stmt->bindParam(':age', $data['age']);
		// $stmt->bindParam(':avatar', $data['avatar']);

		if ($stmt->execute()) {

			$id = $data['id'];
			$query = 'SELECT * FROM users WHERE id=:id';
			$str = DB::connect()->prepare($query);
			$str->execute(array(":id" => $id));
			$user = $str->fetch(PDO::FETCH_OBJ);
			return $user;

		} else {
			return 'error';
		}
	}

	static public function delete($data)
	{
		$id = $data['id'];
		try {
			$query = 'DELETE FROM users WHERE id=:id';
			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array(":id" => $id));
			if ($stmt->execute()) {
				return 'ok';
			}
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function searchUser($data)
	{
		$search = $data['search'];
		try {
			$query = 'SELECT * FROM users INNER JOIN comptes ON comptes.id = users.compte_id WHERE users.nom LIKE ? OR users.prenom LIKE ?';
			$stmt = DB::connect()->prepare($query);
			$stmt->execute(array('%' . $search . '%', '%' . $search . '%'));
			$users = $stmt->fetchAll();
			return $users;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function countUsers()
	{
		$stmt = DB::connect()->prepare('SELECT count(*) as countUsers FROM users');
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}
}
