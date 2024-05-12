<?php

include_once "../../../../app/controllers/studentController.php";

use src\app\controllers\studentController;

session_start();

$user = new studentController;
$cin = isset($_SESSION['cin_etud']) ?  $_SESSION['cin_etud'] : "";
$idfiliere = $user->getFiliereForStudentByCin($cin);
$filiere = $user->getFiliereNameById($idfiliere);
$departement = $user->getDepartementNameById($idfiliere);

?>

<?php include_once "./masterPage.php"; ?>
<main class="content">
    <div class="d-flex justify-content-between gap-2">
        <div class="card w-50" style="background-color:#183258;opacity:0.8;">
            <div class="text-center card-body">
                <h4 class="text-white">
                    <span class="font-italic">Département : </span>
                    <strong class="ms-1 text-success">
                        <?= $departement['nom_dep'] ?>
                    </strong>
                </h4>
            </div>
        </div>
        <div class="card w-50" style="background-color:#183258;opacity:0.8;">
            <div class="text-center card-body">
                <h4 class="text-white">
                    <span class="font-italic">Filiere : </span>
                    <strong class="ms-1 text-success">
                        <?= $filiere['nom_filiere']  ?>
                    </strong>
                </h4>
            </div>
        </div>
    </div>
</main>
</div>
</div>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>