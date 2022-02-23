<?php

class Formation
{

	static public function getAll()
	{
		$formations = DB::connect()->prepare('SELECT * FROM formations ORDER BY created_at DESC');		
		$formations->execute();
		return $formations->fetchAll();
	}

	static public function getFormation($data)
	{
		$id = $data['id'];
		try {
			$query = 'SELECT * FROM formations WHERE id=:id';
			$formationI = DB::connect()->prepare($query);
			$formationI->execute(array(":id" => $id));
			$formation = $formationI->fetch(PDO::FETCH_OBJ);
			return $formation;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function add($data)
	{
		$formation = DB::connect()->prepare('INSERT INTO formations (designation,prix,nombre_module,description)
			VALUES (:designation,:prix,:nombre_module,:description)');
		$formation->bindParam(':designation', $data['designation']);
		$formation->bindParam(':prix', $data['prix']);
		$formation->bindParam(':nombre_module', $data['nombre_module']);
		$formation->bindParam(':description', $data['description']);

		if ($formation->execute()) {
			return 'ok';
		} else {
			return 'error';
		}
	}
	static public function update($data)
	{
		$formation = DB::connect()->prepare('UPDATE formations SET designation=:designation,prix=:prix,nombre_module=:nombre_module,description=:description WHERE id=:id');
		$formation->bindParam(':id', $data['id']);
		$formation->bindParam(':designation', $data['designation']);
		$formation->bindParam(':prix', $data['prix']);
		$formation->bindParam(':nombre_module', $data['nombre_module']);
		$formation->bindParam(':description', $data['description']);

		if ($formation->execute()) {
			return 'ok';
		} else {
			return 'error';
		}
	}

	static public function delete($data)
	{
		$id = $data['id'];
		try {
			$query = 'DELETE FROM formations WHERE id=:id';
			$formation = DB::connect()->prepare($query);
			$formation->execute(array(":id" => $id));
			if ($formation->execute()) {
				return 'ok';
			}else {
				return 'error';
			}
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function searchFormation($data)
	{
		$search = $data['search'];
		try {
			$query = 'SELECT * FROM formations WHERE designation LIKE ? OR description LIKE ?';
			$formationI = DB::connect()->prepare($query);
			$formationI->execute(array('%' . $search . '%', '%' . $search . '%'));
			$formation = $formationI->fetchAll();
			return $formation;
		} catch (PDOException $ex) {
			echo 'erreur' . $ex->getMessage();
		}
	}

	static public function countFormations()
	{
		$stmt = DB::connect()->prepare('SELECT count(*) as countFormations FROM formations');
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

}
