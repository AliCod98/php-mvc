<?php 
	if(isset($_POST['id'])){
		$exitEmploye = new UsersController();
		$exitEmploye->deleteUser();
	}
?>