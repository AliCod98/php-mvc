<?php

require_once './views/includes/navbar.php';

if (isset($_POST['submit'])) {
	$newFormation = new FormationsController();
	$newFormation->addFormation();
}
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-8 mx-auto">
			<div class="card">
				<div class="card-header">Ajouter un Formation</div>
				<div class="card-body bg-light">
					<a href="<?php

								if ($_SESSION['role'] == 'admin') {
									echo BASE_URL . 'listFormation';
								} else {
									echo BASE_URL . 'profilFormation';
								}

								?>" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
					<form method="post">
						<div class="form-group">
							<label for="designation">Designation*</label>
							<input type="text" name="designation" class="form-control" placeholder="designation">
						</div>
						<div class="form-group">
							<label for="prix">Prix*</label>
							<input type="text" name="prix" class="form-control" placeholder="Prix">
						</div>
						<div class="form-group">
							<label for="nombre_module">Nombre Module*</label>
							<input type="text" name="nombre_module" class="form-control" placeholder="Nombre Module">
						</div>
						<div class="form-group">
							<label for="description">Description*</label>
							<input type="text" name="description" class="form-control" placeholder="description">
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