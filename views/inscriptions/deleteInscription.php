<?php 

	if(isset($_POST['id'])){
		$exitInscription = new InscriptionsController();
		$exitInscription->deleteInscription();
	}
?>