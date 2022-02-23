<?php

require_once './views/includes/navbar.php';

if (isset($_POST['find'])) {
	$data = new FormationsController();
	$formations = $data->findFormations();
} else {
	$data = new FormationsController();
	$formations = $data->getAllFormations();
}
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-10 mx-auto">
			<?php include('./views/includes/alerts.php'); ?>
			<div class="card">
				<div class="card-body bg-light">
					<a href="<?php echo BASE_URL; ?>addFormation" class="btn btn-sm btn-primary mr-2 mb-2">
						<i class="fas fa-plus"></i>
					</a>
					<a href="<?php echo BASE_URL . 'listFormation'; ?>" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
					
					<form method="post" class="float-right mb-2 d-flex flex-row">
						<input type="text" class="form-control" name="search" placeholder="Recherche">
						<button class="btn btn-info btn-sm" name="find" type="submit"><i class="fas fa-search"></i></button>
					</form>
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">Désignation</th>
								<th scope="col">Prix</th>
								<th scope="col">Nombre module</th>
								<th scope="col">description</th>
								<th scope="col">Date de Création</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($formations as $formation) : ?>
								<tr>
									<th scope="row"><?php echo $formation['designation']; ?></th>
									<th scope="row"><?php echo $formation['prix']; ?></th>
									<td><?php echo $formation['nombre_module']; ?></td>
									<td><?php echo $formation['description']; ?></td>
									<td><?php echo $formation['created_at']; ?></td>
									<td class="d-flex flex-row">
										<form method="post" class="mr-1" action="updateFormation">
											<input type="hidden" name="id" value="<?php echo $formation['id']; ?>">
											<button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
										</form>
										<form method="post" class="mr-1" action="deleteFormation">
											<input type="hidden" name="id" value="<?php echo $formation['id']; ?>">
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