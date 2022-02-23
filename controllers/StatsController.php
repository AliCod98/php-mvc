<?php

class StatsController
{

	//get all users inside role panels
	public function countUser()
	{
		$users = User::countUsers();
		return $users;
	}

	public function countFormation()
	{
		$formations = Formation::countFormations();
		return $formations;
	}

	public function countInscription()
	{
		$inscriptions = Inscription::countInscriptions();
		return $inscriptions;
	}
}
