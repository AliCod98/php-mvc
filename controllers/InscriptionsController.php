<?php

class InscriptionsController
{

	//get all formations inside role panels
	public function getAllInscriptions()
	{
		if ($_SESSION['role'] == 'admin') {
			$inscriptions = Inscription::getAll();
		} else {
			$inscriptions = Inscription::getInscriptionFormationStudent($_SESSION['id']);
		}
		return $inscriptions;
	}

	//git single formation in admin panel
	public function getOneInscription()
	{
		if (isset($_POST['id'])) {
			$data = array(
				'id' => $_POST['id']
			);
			$inscription = Inscription::getInscription($data);
			return $inscription;
		}
	}

	public function getInscriptionByFormation($formation_id,$user_id)
	{
		$inscription = Inscription::getInscriptionBy_Formation($formation_id,$user_id);
		return $inscription;
	}

	//find a formation by search in admin panel and student panel
	public function findInscriptions()
	{
		if (isset($_POST['search'])) {
			$data = array('search' => $_POST['search']);
		}
		$inscriptions = Inscription::searchInscription($data);
		return $inscriptions;
	}

	//add a formation in admin panel
	public function addInscriptionFormation()
	{
		if (isset($_POST['submit'])) {
			$data = array(
				'frais' => $_POST['frais'],
				'prix' => $_POST['prix'],
				'information' => $_POST['information'],
				'user_id' => $_SESSION['id'],
				'formation_id' => $_POST['id'],
			);
			$result = Inscription::add($data);
			if ($result === 'ok') {
				Session::set('success', 'Inscription Ajouté');
				if ($_SESSION['role'] == 'admin') {
					Redirect::to('listInscription');
				} else {
					Redirect::to('profilInscription');
				}
			} else {
				echo $result;
			}
		}
	}

	//update a formation in admin panel
	public function updateFormation()
	{
		if (isset($_POST['submit'])) {
			$data = array(
				'id' => $_POST['id'],
				'designation' => $_POST['designation'],
				'prix' => $_POST['prix'],
				'nombre_module' => $_POST['nombre_module'],
				'description' => $_POST['description'],
			);
			$result = Formation::update($data);
			if ($result === 'ok') {
				Session::set('success', 'Formation Modifié');
				Redirect::to('listFormation');
			} else {
				echo $result;
			}
		}
	}

	//delete a formation in admin panel
	public function deleteInscription()
	{
		if (isset($_POST['id'])) {
			$data['id'] = $_POST['id'];
			$result = Inscription::delete($data);
			if ($result === 'ok') {
				Session::set('success', 'Inscription Supprimé');
				if ($_SESSION['role'] == 'admin') {
					Redirect::to('listInscription');
				} else {
					Redirect::to('profilInscription');
				}
			} else {
				echo $result;
			}
		}
	}
}
