<?php

require_once './views/includes/navbar.php';

$data = new StatsController();
$countUsers = $data->countUser();
$countFormations = $data->countFormation();
$countInscriptions = $data->countInscription();

?>

<body class="fixed-nav sticky-footer" id="page-top">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="col">
                <?php
                if ($_SESSION['role'] == 'admin') {
                ?>
                    <div class="col-xl-3 col-sm-6 mb-3 mx-auto">
                        <div class="card text-white bg-warning o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon mb-2">
                                    <i class="fa fa-2x fa-fw fa-user"></i>
                                </div>
                                <div class="mr-5"><?php echo $countUsers->countUsers; ?> New Users!</div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="<?php echo BASE_URL . 'listUser'; ?>">
                                <span class="float-left">View Details</span>
                                <span class="float-right">
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="col-xl-3 col-sm-6 mb-3 mx-auto">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon mb-2">
                                <i class="fa fa-2x fa-fw fa-book"></i>
                            </div>
                            <div class="mr-5"><?php echo $countFormations->countFormations; ?> New Formation!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="<?php

                                                                                    if ($_SESSION['role'] == 'admin') {
                                                                                        echo BASE_URL . 'listFormation';
                                                                                    } else {
                                                                                        echo BASE_URL . 'profilFormation';
                                                                                    }

                                                                                    ?>">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3 mx-auto">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon mb-2">
                                <i class="fa fa-2x fa-fw fa-graduation-cap"></i>
                            </div>
                            <div class="mr-5"><?php echo $countInscriptions->countInscriptions; ?> New Inscriptions!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="<?php

                                                                                    if ($_SESSION['role'] == 'admin') {
                                                                                        echo BASE_URL . 'listInscription';
                                                                                    } else {
                                                                                        echo BASE_URL . 'profilInscription';
                                                                                    }

                                                                                    ?>">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>