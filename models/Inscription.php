<?php

class Inscription
{

	static public function getAll()
	{
		$inscriptions = DB::connect()->prepare('SELECT *,
		                    inscriptions.id as id,
		                    inscriptions.frais as frais,
		                    inscriptions.prix as prix,
		                    inscriptions.information as information,
		                    inscriptions.date_inscription as date_inscription,
		                    inscriptions.user_id as user_id,
		                    inscriptions.formation_id as formation_id,
		                    users.nom as nom,
		                    users.prenom as prenom,
	                    	comptes.email as email,
	                     	formations.designation as designation
	                    	FROM inscriptions 
		                    INNER JOIN users ON inscriptions.user_id = users.id
		                    INNER JOIN formations ON inscriptions.formation_id = formations.id
		                    INNER JOIN comptes ON comptes.id = users.compte_id');		
		$inscriptions->execute();
		return $inscriptions->fetchAll();
	}

	static public function getInscriptionFormationStudent($data)
	{
		$id = $data;
		try {
		    $query = 'SELECT *,
			                inscriptions.id as id,
			                inscriptions.frais as frais,
			                inscriptions.prix as prix,
			                inscriptions.information as information,
			                inscriptions.date_inscription as date_inscription,
			                inscriptions.user_id as user_id,
			                inscriptions.formation_id as formation_id,
			                users.nom as nom,
			                users.prenom as prenom,
			                comptes.email as email,
			                formations.designation as designation
			                FROM inscriptions 
			                INNER JOIN users ON inscriptions.user_id = users.id
			                INNER JOIN formations ON inscriptions.formation_id = formations.id
			                INNER JOIN comptes ON comptes.id = users.compte_id
			                WHERE users.id='.$id;

			$stmt = DB::connect()->prepare($query);
			$stmt->execute();
			$inscription = $stmt->fetchAll();
			return $inscription;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function getInscription($data)
	{
		$id = $data['id'];
		try {
			$query = 'SELECT * FROM inscriptions WHERE id=:id';
			$inscriptionI = DB::connect()->prepare($query);
			$inscriptionI->execute(array(":id" => $id));
			$inscription = $inscriptionI->fetch(PDO::FETCH_OBJ);
			return $inscription;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function getInscriptionBy_Formation($formation_id,$user_id)
	{
		try {
			$query = 'SELECT * FROM inscriptions WHERE formation_id=:formation_id and user_id=:user_id';
			$inscriptionI = DB::connect()->prepare($query);
			$inscriptionI->execute(array(":formation_id" => $formation_id, ":user_id" => $user_id));
			$inscription = $inscriptionI->fetch(PDO::FETCH_OBJ);
			return $inscription;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function add($data)
	{
		$inscription = DB::connect()->prepare('INSERT INTO inscriptions (frais,prix,formation_id,user_id,information)
			                                 VALUES (:frais,:prix,:formation_id,:user_id,:information)');
											 
		$inscription->bindParam(':frais', $data['frais']);
		$inscription->bindParam(':prix', $data['prix']);
		$inscription->bindParam(':user_id', $data['user_id']);
		$inscription->bindParam(':formation_id', $data['formation_id']);
		$inscription->bindParam(':information', $data['information']);

		if ($inscription->execute()) {
			return 'ok';
		} else {
			return 'error';
		}
	}
	static public function update($data)
	{
		$inscription = DB::connect()->prepare('UPDATE formations SET frais=:frais,prix=:prix,formation_id=:formation_id,information=:information,user_id=:user_id WHERE id=:id');
		$inscription->bindParam(':id', $data['id']);
		$inscription->bindParam(':frais', $data['frais']);
		$inscription->bindParam(':prix', $data['prix']);
		$inscription->bindParam(':user_id', $data['user_id']);
		$inscription->bindParam(':formation_id', $data['formation_id']);
		$inscription->bindParam(':information', $data['information']);

		if ($inscription->execute()) {
			return 'ok';
		} else {
			return 'error';
		}
	}

	static public function delete($data)
	{
		$id = $data['id'];
		try {
			$query = 'DELETE FROM inscriptions WHERE id=:id';
			$inscription = DB::connect()->prepare($query);
			$inscription->execute(array(":id" => $id));
			if ($inscription->execute()) {
				return 'ok';
			}else {
				return 'error';
			}
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function searchInscription($data)
	{
		$search = $data['search'];
		try {
			$query = 'SELECT * 
			            FROM inscriptions 
			            INNER JOIN users ON inscriptions.user_id = users.id
		            	INNER JOIN formations ON inscriptions.formation_id = formations.id
		                WHERE users.nom LIKE ? OR users.prenom LIKE ? OR formations.designation LIKE ? OR inscriptions.information LIKE ?';
		 	$formationI = DB::connect()->prepare($query);
			$formationI->execute(array('%' . $search . '%', '%' . $search . '%', '%' . $search . '%', '%' . $search . '%'));
			$formation = $formationI->fetchAll();
			return $formation;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function countInscriptions()
	{
		if ($_SESSION['role'] == 'admin') {
		$stmt = DB::connect()->prepare('SELECT count(*) as countInscriptions FROM inscriptions');
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}else{
		$stmt = DB::connect()->prepare('SELECT count(*) as countInscriptions FROM inscriptions WHERE user_id='.$_SESSION['id']);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}
	}
}
