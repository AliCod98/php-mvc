<?php

require_once './views/includes/navbar.php';

$exitUser = new UsersController();
$user = $exitUser->getProfilUser();

if (isset($_POST['submit'])) {
	$newUser = new UsersController();
	$newUser->updateProfilUser();
}
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-10 mx-auto">
			<?php include('./views/includes/alerts.php'); ?>
			<div class="card">
				<div class="card-body bg-light">
					<a href="<?php echo BASE_URL . 'dashboard'; ?>" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
					<a href="<?php echo BASE_URL . 'updatePassword'; ?>" class="btn btn-sm btn-secondary mr-2 mb-2">
						<!-- <i class="fas fa-home"></i> -->
						<span>Update password</span>
					</a>
					<form method="post">
						<div class="form-group">
							<label for="nom">Nom*</label>
							<input type="text" name="nom" class="form-control" placeholder="Nom" value="<?php echo $user->nom; ?>">
						</div>
						<div class="form-group">
							<label for="prenom">Prénom*</label>
							<input type="text" name="prenom" class="form-control" placeholder="Prénom" value="<?php echo $user->prenom; ?>">
						</div>
						<div class="form-group">
							<label for="age">Age*</label>
							<input type="text" name="age" class="form-control" placeholder="Age" value="<?php echo $user->age; ?>">
						</div>
						<div class="form-group">
							<label for="name">UserName*</label>
							<input type="text" name="name" class="form-control" placeholder="UserName" value="<?php echo $user->name; ?>">
							<input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
						</div>
						<div class="form-group">
							<label for="email">Email*</label>
							<input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $user->email; ?>">
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