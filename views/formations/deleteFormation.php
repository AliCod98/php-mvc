<?php 

	if(isset($_POST['id'])){
		$exitEmploye = new FormationsController();
		$exitEmploye->deleteFormation();
	}
?>