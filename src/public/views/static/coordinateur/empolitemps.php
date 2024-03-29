<?php $title = "Emploi du Temps";

require_once "../../../../app/controllers/coordinateurController.php";

use src\app\controllers\coordinateurController;

?>
<?php include_once "../header.php"; ?>
<div class="container">
    <div class="row">
        <?php
        $user = new coordinateurController;

        $user->getfiliere();
        if (isset($_SESSION['filieres'])) {
            $filieres = $_SESSION['filieres'];
            if (!empty($filieres)) {
                foreach ($filieres as $filiere) {
        ?>
                    <div class="d-flex justify-content-center">
                        <div class=" col-md-3">
                            <div class="btn btn-success mb-2 w-100"><?= $filiere['nom_filiere'] ?></a></div>
                        </div>
                    </div>
        <?php
                }
            }
        }
        ?>
    </div>
</div>

<?php include_once "../footer.php" ?>