<?php

require_once './views/includes/navbar.php';

if (isset($_POST['id'])) {
	$exitFormation = new FormationsController();
	$formation = $exitFormation->getOneFormation();
} else {
	Redirect::to('listFormation');
}
if (isset($_POST['submit'])) {
	$newInscription = new InscriptionsController();
	$newInscription->addInscriptionFormation();
}
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-8 mx-auto">
			<div class="card">
				<div class="card-header">Ajouter un Inscription</div>
				<div class="card-body bg-light">
					<a href="<?php
								if ($_SESSION['role'] == 'admin') {
									echo BASE_URL . 'listInscription';
								} else {
									echo BASE_URL . 'profilInscription';
								}

								?>" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
					<form method="post">
						<div class="form-group">
							<label for="designation">Designation*</label>
							<input type="text" name="designation" class="form-control" placeholder="Designation" value="<?php echo $formation->designation; ?>">
						</div>
						<div class="form-group">
							<label for="prix">Prix*</label>
							<input type="text" name="prix" class="form-control" placeholder="Prix" value="<?php echo $formation->prix; ?>">
						</div>
						<div class="form-group">
							<label for="frais">Frais*</label>
							<input type="text" name="frais" class="form-control" placeholder="Frais">
						</div>
						<div class="form-group">
							<label for="information">Information*</label>
							<input type="text" name="information" class="form-control" placeholder="information">
							<input type="hidden" name="id" value="<?php echo $formation->id; ?>">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="submit">Valider</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>