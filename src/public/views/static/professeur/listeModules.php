<?php
session_start();
include_once "../../../../app/controllers/professeurController.php";
include_once "../../../../app/controllers/coordinateurController.php";

use src\app\controllers\coordinateurController;
use src\app\controllers\professeurController;

$user = new professeurController;
$cord = new coordinateurController;
$cin_prof = isset($_SESSION['cin']) ? $_SESSION['cin'] : "";
$departement = $user->getDepartementByCinProf($cin_prof);
$nomProf = isset($_SESSION['nom']) ? $_SESSION['nom'] : "";
$prenomProf = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : "";
$filiers = $user->getFilieresForProfesseur($cin_prof);
$modules = $cord->getModulesForeachProfesseur($cin_prof);
?>

<?php include_once "./masterPage.php"; ?>

<main class="container ">
    <div class="w-50 mx-auto my-5 fs-4 text-center text-white bg-danger p-2 " style="border-radius: 10px;">La Liste Des Modules</div>
    <div class=" mt-4 mx-auto w-50">
        <?php foreach ($filiers as $filiere) : ?>
            <?php
            $modulesFiliere = array_filter($modules, function ($module) use ($filiere) {
                return $module['nom_filiere'] === $filiere['nom_filiere'];
            });
            ?>
            <details>
                <summary class=" mt-3 p-3 text-white" style="background-color:#183258;border-radius:19px 19px 0 0"><?= $filiere['nom_filiere'] ?></summary>
                <div class=" accordion-content bg-info text-danger fs-4">
                    <?php foreach ($modulesFiliere as $module) : ?>
                        <div class="font py-3" style="background:radial-gradient(788px at 0.7% 3.4%, rgb(164, 231, 192) 0%, rgb(255, 255, 255) 90%);"><i class="bi bi-journal-bookmark-fill mx-2"></i><?= $module['nom_modules'] ?></div>
                    <?php endforeach; ?>
                </div>
            </details>
        <?php endforeach; ?>
    </div>
</main>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>