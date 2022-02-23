<?php

require_once './views/includes/navbar.php';

if (isset($_POST['find'])) {
	$data = new UsersController();
	$users = $data->findUsers();
} else {
	$data = new UsersController();
	$users = $data->getAllUsers();
}
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-10 mx-auto">
			<?php include('./views/includes/alerts.php'); ?>
			<div class="card">
				<div class="card-body bg-light">
					<a href="<?php echo BASE_URL; ?>addUser" class="btn btn-sm btn-primary mr-2 mb-2">
						<i class="fas fa-plus"></i>
					</a>
					<a href="<?php echo BASE_URL . 'listUser'; ?>" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
					
					<form method="post" class="float-right mb-2 d-flex flex-row">
						<input type="text" class="form-control" name="search" placeholder="Recherche">
						<button class="btn btn-info btn-sm" name="find" type="submit"><i class="fas fa-search"></i></button>
					</form>
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">Nom</th>
								<th scope="col">Prénom</th>
								<th scope="col">Age</th>
								<th scope="col">UserName</th>
								<th scope="col">Email</th>
								<th scope="col">Role</th>
								<th scope="col">Date de Création</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($users as $user) : ?>
								<tr>
									<th scope="row"><?php echo $user['nom']; ?></th>
									<th scope="row"><?php echo $user['prenom']; ?></th>
									<td><?php echo $user['age']; ?></td>
									<td><?php echo $user['name']; ?></td>
									<td><?php echo $user['email']; ?></td>
									<td><?php echo $user['role']; ?></td>
									<td><?php echo $user['created_at']; ?></td>
									<td class="d-flex flex-row">
										<form method="post" class="mr-1" action="updateUser">
											<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
											<button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
										</form>
										<form method="post" class="mr-1" action="deleteUser">
											<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
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