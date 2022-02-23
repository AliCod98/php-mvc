<?php 

class FormationsController{

	//get all formations inside role panels
	public function getAllFormations(){
		$formations = Formation::getAll();
		return $formations;
	}

	//git single formation in admin panel
	public function getOneFormation(){
		if(isset($_POST['id'])){
			$data = array(
				'id' => $_POST['id']
			);
			$formation = Formation::getFormation($data);
			return $formation;
		}
	}

	//find a formation by search in admin panel and student panel
	public function findFormations(){
		if(isset($_POST['search'])){
			$data = array('search' => $_POST['search']);
		}
		$formations = Formation::searchFormation($data);
		return $formations;
	} 

	//add a formation in admin panel
	public function addFormation(){ 
		if(isset($_POST['submit'])){
			$data = array(
				'designation' => $_POST['designation'],
				'prix' => $_POST['prix'],
				'nombre_module' => $_POST['nombre_module'],
				'description' => $_POST['description'],
			);
			$result = Formation::add($data);
			if($result === 'ok'){
				Session::set('success','Formation Ajouté');
				Redirect::to('listFormation');
			}else{
				echo $result;
			}
		}
	}

	//update a formation in admin panel
	public function updateFormation(){
		if(isset($_POST['submit'])){
			$data = array(
				'id' => $_POST['id'],
				'designation' => $_POST['designation'],
				'prix' => $_POST['prix'],
				'nombre_module' => $_POST['nombre_module'],
				'description' => $_POST['description'],
			);
			$result = Formation::update($data);
			if($result === 'ok'){
				Session::set('success','Formation Modifié');
				Redirect::to('listFormation');
			}else{
				echo $result;
			}
		}
	}

	//delete a formation in admin panel
	public function deleteFormation(){
		if(isset($_POST['id'])){
			$data['id'] = $_POST['id'];
			$result = Formation::delete($data);
			if($result === 'ok'){
				Session::set('success','Formation Supprimé');
				Redirect::to('listFormation');
			}else{
				echo $result;
			}
		}
	}

}
