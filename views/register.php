<?php
if (isset($_POST['submit'])) {
	$createUser = new ComptesController();
	$createUser->register();
}
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-6 mx-auto">
			<?php include('./views/includes/alerts.php'); ?>
			<div class="card">
				<div class="card-header">
					<h3 class="text-center">Inscription</h3>
				</div>
				<div class="card-body bg-light">
					<form method="post" class="mr-1" enctype='multipart/form-data'>
						<!-- <div class="form-group">
							<input type="file" name="file">
						</div> -->
						<div class="form-group">
							<select name="role" class="form-control">
								<option disabled selected>-- Select a role --</option>
								<option value="admin">Admin</option>
								<option value="student">Student</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="nom" placeholder="Nom" class="form-control">
						</div>
						<div class="form-group">
							<input type="text" name="prenom" placeholder="Prénom" class="form-control">
						</div>
						<div class="form-group">
							<input type="text" name="age" placeholder="Age" class="form-control">
						</div>
						<div class="form-group">
							<input type="text" name="name" placeholder="UserName" class="form-control">
						</div>
						<div class="form-group">
							<input type="text" name="email" placeholder="Email" class="form-control">
						</div>
						<div class="form-group">
							<input type="password" name="password" placeholder="Mot de passe" class="form-control">
						</div>
						<button name="submit" class="btn btn-sm btn-primary">Inscription</button>
					</form>
				</div>
				<div class="card-footer">
					<a href="<?php echo BASE_URL; ?>login" class="btn btn-link">Connexion</a>
				</div>
			</div>
		</div>
	</div>
</div>