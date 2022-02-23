<?php
require_once './views/includes/header.php';
require_once './autoload.php';
require_once './controllers/HomeController.php';


$home = new HomeController();

$pages = ['logout', 'login', 'register', 'dashboard'];
$pagesUsers = ['myProfil', 'updatePassword', 'listUser', 'addUser', 'updateUser', 'deleteUser'];
$pagesFormations = ['listFormation', 'profilFormation', 'addFormation', 'updateFormation', 'deleteFormation'];
$pagesInscriptions = ['inscriptionFormation', 'profilInscription', 'listInscription', 'deleteInscription'];

if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {

	if (isset($_GET['page'])) {
		if (in_array($_GET['page'], $pages)) {
			$page = $_GET['page'];
			$home->index($page);
		} else if (in_array($_GET['page'], $pagesUsers)) {
			$page = $_GET['page'];
			$home->index('users/' . $page);
		} else if (in_array($_GET['page'], $pagesFormations)) {
			$page = $_GET['page'];
			$home->index('formations/' . $page);
		} else if (in_array($_GET['page'], $pagesInscriptions)) {
			$page = $_GET['page'];
			$home->index('inscriptions/' . $page);
		} else {
			include('views/includes/404.php');
		}
	} else {
		$home->index('login');
	}


	require_once './views/includes/footer.php';
} else if (isset($_GET['page']) && $_GET['page'] === 'register') {
	$home->index('register');
} else {
	$home->index('login');
}
