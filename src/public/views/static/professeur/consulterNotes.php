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
    <div class="w-50 mx-auto mt-5 fs-4 text-center p-3 font " style="background:radial-gradient(788px at 0.7% 3.4%, rgb(164, 231, 192) 0%, rgb(255, 255, 255) 90%);">Consulter Notes :
        <span class="d-block text-danger">Choisir la filiere </span>
    </div>
    <div class=" mt-4 mx-auto w-50">
        <?php foreach ($filiers as $filiere) : ?>
            <?php
            $modulesFiliere = array_filter($modules, function ($module) use ($filiere) {
                return $module['nom_filiere'] === $filiere['nom_filiere'];
            });
            ?>
            <details>
                <summary class=" mt-3 p-3 text-white" style="background:radial-gradient(circle at 10% 20%, rgb(59, 149, 237) 0%, rgb(7, 91, 173) 90%);"><?= $filiere['nom_filiere'] ?></summary>
                <div class=" accordion-content bg-info text-danger fs-4">
                    <?php foreach ($modulesFiliere as $module) : ?>

                        <div class="font py-3" style="background:radial-gradient(788px at 0.7% 3.4%, rgb(164, 231, 192) 0%, rgb(255, 255, 255) 90%);">
                            <i class="bi bi-journal-bookmark-fill mx-2">
                            </i>
                            <?= $module['nom_modules'] ?>
                            <span class="ms-4 ">Consulter</span>
                            <a href="./getNotes.php?filiere=<?= $filiere['nom_filiere'] ?>&module=<?= $module['nom_modules'] ?>"><strong class="text-danger">(ici)</strong></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </details>
        <?php endforeach; ?>
    </div>
</main>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>