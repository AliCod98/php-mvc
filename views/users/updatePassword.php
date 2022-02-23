<?php
require_once './views/includes/navbar.php';
?>
<div class="container">
	<div class="row my-4">
		<div class="col-md-8 mx-auto">
			<div class="card">
				<div class="card-header">Modifier a password user</div>
				<div class="card-body bg-light">
					<a href="<?php echo BASE_URL . 'myProfil';?>" class="btn btn-sm btn-secondary mr-2 mb-2">
						<i class="fas fa-home"></i>
					</a>
					<form method="post">
						<div class="form-group">
							<label for="currentPassword">CurrentPassword*</label>
							<input type="password" name="currentPassword" class="form-control">
							<input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
						</div>
						<div class="form-group">
							<label for="newPassword">NewPassword*</label>
							<input type="password" name="newPassword" class="form-control">
						</div>
						<div class="form-group">
							<label for="confPassword">ConfirmationPassword*</label>
							<input type="password" name="confPassword" class="form-control">
						</div>
						<p>
						<?php
						if (isset($_POST['submit'])) {
							$newUser = new ComptesController();
							$newUser->updatePassword();
						}
						?> 
						</p>
						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="submit">Valider</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>