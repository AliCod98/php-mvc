<?php

require_once './views/includes/navbar.php';

if (isset($_POST['submit'])) {
	$newUser = new ComptesController();
	$newUser->register();
}
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-8 mx-auto">
			<div class="card">
				<div class="card-header">Ajouter un User</div>
				<div class="card-body bg-light">
					<a href="<?php

								if ($_SESSION['role'] == 'admin') {
									echo BASE_URL.'listUser';
								} else {
									echo BASE_URL.'profilUser';
								}

								?>" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
					<form method="post">
						<div class="form-group">
							<select name="role" class="form-control">
								<option disabled selected>-- Select a role --</option>
								<option value="admin">Admin</option>
								<option value="student">Student</option>
							</select>
						</div>
						<div class="form-group">
							<label for="nom">Nom*</label>
							<input type="text" name="nom" class="form-control" placeholder="Nom">
						</div>
						<div class="form-group">
							<label for="prenom">Prénom*</label>
							<input type="text" name="prenom" class="form-control" placeholder="Prénom">
						</div>
						<div class="form-group">
							<label for="mat">Age*</label>
							<input type="text" name="age" class="form-control" placeholder="Age">
						</div>
						<div class="form-group">
							<label for="depart">UserName*</label>
							<input type="text" name="name" class="form-control" placeholder="UserName">
						</div>
						<div class="form-group">
							<label for="poste">Email*</label>
							<input type="text" name="email" class="form-control" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="poste">Password*</label>
							<input type="password" name="password" class="form-control" placeholder="Password">
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