<?php
session_start();

include_once "../../../../app/controllers/coordinateurController.php";

use src\app\controllers\coordinateurController;

$cord = new coordinateurController;
$cin_cord = isset($_SESSION['cin_cord']) ? $_SESSION['cin_cord'] : "";
$departement = $cord->getDepartement($cin_cord);
$filiers = $cord->getfiliere($cin_cord);
?>

<?php include "./masterPage.php" ?>
<main class="content">
    <div class="container-fluid p-0">
        <div class="card w-50" style="background-color: #183258;border-radius: 10px;">
            <div class="card-body">
                <h4>
                    <span class="font-italic text-white mx-2">Département : </span>
                    <strong class="text-white"> <?php echo isset($departement["nom_dep"]) ? $departement["nom_dep"] : "" ?>
                    </strong>
                </h4>
            </div>
        </div>
        <div class="row">
            <?php foreach ($filiers as $filiere) : ?>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <a href="./affectation_prof_modules.php?filiere=<?= $filiere['nom_filiere'] ?>" class="card-title text-dark"><?php echo $filiere['nom_filiere']; ?></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</main>
</div>
</div>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>