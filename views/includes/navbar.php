<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
	<div class="container">
		<button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">

				<?php
				if ($_SESSION['role'] == 'admin') {
				?>

					<li class="nav-item">
						<a class="nav-link text-light" href="http://localhost/php-mvc/dashboard">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="http://localhost/php-mvc/listUser">Users</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="http://localhost/php-mvc/listFormation">Formations</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="http://localhost/php-mvc/listInscription">Inscriptions</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="http://localhost/php-mvc/myProfil">My Profil</a>
					</li>

				<?php
				} else {
				?>

					<li class="nav-item">
						<a class="nav-link text-light" href="http://localhost/php-mvc/dashboard">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="http://localhost/php-mvc/profilFormation">Formations</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="http://localhost/php-mvc/profilInscription">Inscriptions</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="http://localhost/php-mvc/myProfil">My Profil</a>
					</li>
				<?php
				}
				?>

				<li class="nav-item">
					<a href="<?php echo BASE_URL; ?>logout" title="Déconnexion" class="btn btn-link px-0 mr-2 mb-2">
						<i class="fas fa-user mr-2"> <?php echo $_SESSION['name'] . ' (' . $_SESSION['role'] . ')'; ?></i>
					</a>
				</li>

			</ul>
		</div>
	</div>
</nav>