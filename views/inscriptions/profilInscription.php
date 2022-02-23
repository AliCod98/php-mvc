<?php

require_once './views/includes/navbar.php';

if (isset($_POST['find'])) {
	$data = new InscriptionsController();
	$inscriptions = $data->findInscriptions();
} else {
	$data = new InscriptionsController();
	$inscriptions = $data->getAllInscriptions();
}
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-10 mx-auto">
			<?php include('./views/includes/alerts.php'); ?>
			<div class="card">
				<div class="card-body bg-light">
					<a href="<?php echo BASE_URL . 'profilInscription'; ?>" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
					
					<form method="post" class="float-right mb-2 d-flex flex-row">
						<input type="text" class="form-control" name="search" placeholder="Recherche">
						<button class="btn btn-info btn-sm" name="find" type="submit"><i class="fas fa-search"></i></button>
					</form>
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">Inscription N°</th>
								<th scope="col">Formation</th>
								<th scope="col">Prix</th>
								<th scope="col">Frais</th>
								<th scope="col">Informations</th>
								<th scope="col">Date d'Inscription</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($inscriptions as $inscription) : ?>
								<tr>
									<th scope="row"><?php echo $inscription['id']; ?></th>
									<th scope="row"><?php echo $inscription['designation']; ?></th>
									<th scope="row"><?php echo $inscription['prix']; ?></th>
									<td><?php echo $inscription['frais']; ?></td>
									<td><?php echo $inscription['information']; ?></td>
									<td><?php echo $inscription['date_inscription']; ?></td>
									<td class="d-flex flex-row">
										<form method="post" class="mr-1" action="deleteInscription">
											<input type="hidden" name="id" value="<?php echo $inscription['id']; ?>">
											<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>