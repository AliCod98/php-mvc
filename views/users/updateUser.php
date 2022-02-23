<?php

require_once './views/includes/navbar.php';

if (isset($_POST['id'])) {
	$exitUser = new UsersController();
	$user = $exitUser->getOneUser();
} else {
	Redirect::to('listUser');
}
if (isset($_POST['submit'])) {
	$newUser = new UsersController();
	$newUser->updateUser();
}
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-8 mx-auto">
			<div class="card">
				<div class="card-header">Modifier a user</div>
				<div class="card-body bg-light">
					<a href="<?php

								if ($_SESSION['role'] == 'admin') {
									echo BASE_URL . 'listUser';
								} else {
									echo BASE_URL . 'profilUser';
								}

								?>" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
					<form method="post">
						<?php
						if ($_SESSION['role'] == 'admin') {
						?>
							<div class="form-group">
								<select name="role" class="form-control">
									<option disabled selected>-- Select a role --</option>
									<option value="admin" <?php echo $user->role ? 'selected' : ''; ?>>Admin</option>
									<option value="student" <?php echo $user->role ? 'selected' : ''; ?>>Student</option>
								</select>
							</div>
						<?php
						}
						?>
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
							<input type="hidden" name="id" value="<?php echo $user->id; ?>">
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