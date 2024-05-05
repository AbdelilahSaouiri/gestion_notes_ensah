<?php
session_start();
include_once "../../../../app/controllers/chefDepartementController.php";

use src\app\controllers\chefDepartementController;

$user = new chefDepartementController;
$Currentfiliere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$cin = isset($_SESSION['chef_cin']) ? $_SESSION['chef_cin'] : "";
$departement = $user->getDepartement($cin);
?>

<?php include "./masterPage.php" ?>

<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="m-auto col-sm-6 text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h5 class="card-title" class="col mt-0">
                                Département : <span class="text-primary"> <?= isset($departement["nom_dep"]) ? $departement["nom_dep"] : "" ?></span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-auto col-sm-6 text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title"> Filiere : <span class="text-primary"> <?= $Currentfiliere ?></span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach ([1, 2] as $semestre) : ?>
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <h4 class="btn btn-secondary">Semestre <?= $semestre ?></h4>
                </div>
            </div>
            <div class="row">
                <?php $modules = $user->getmodules($Currentfiliere, $semestre); ?>
                <?php foreach ($modules as $module) : ?>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title"><?= $module['nom_modules'] ?> </h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="./updateModule.php?module=<?= $module['nom_modules'] ?>">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</div>
</div>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>