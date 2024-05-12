<?php
session_start();
include_once "../../../../app/controllers/professeurController.php";
include_once "../../../../app/controllers/coordinateurController.php";

use src\app\controllers\coordinateurController;
use src\app\controllers\professeurController;

$user = new professeurController;
$cord = new coordinateurController;
$anne_univ = isset($_GET['anne']) ? $_GET['anne'] : "";
$cin_prof = isset($_SESSION['cin']) ? $_SESSION['cin'] : "";
$filiers = $user->getFilieresForProfesseur($cin_prof);
$modules = $cord->getModulesForeachProfesseur($cin_prof);
?>

<?php include_once "./masterPage.php"; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h3 class="text-center mt-4 mb-5 py-3 fs-4 w-50 mx-auto text-dark" style="background-color:burlywood;border-radius:7px;opacity:0.8;">Archive des notes de l'année universitaire :
                <span class="ms-1" style="font-style: italic;color:#2D6D06"><?= $anne_univ ?></span>
            </h3>
            <table class="table table table-striped table-bordered ">
                <thead style="background-color: #183258;">
                    <tr class="border border-dark">
                        <th class="text-white text-center" style="font-weight: 500;letter-spacing:0.9px;" scope="col">Filière(s)</th>
                        <th class="text-white text-center" style="font-weight: 500;letter-spacing:0.9px;" scope="col">Module(s)</th>
                        <th class="text-white text-center" style="font-weight: 500;letter-spacing:0.9px;" scope="col">Explorer les Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($filiers as $filiere) : ?>
                        <?php
                        $modulesFiliere = array_filter($modules, function ($module) use ($filiere) {
                            return $module['nom_filiere'] === $filiere['nom_filiere'];
                        });
                        ?>
                        <?php $firstModule = true; ?>
                        <?php foreach ($modulesFiliere as $module) : ?>
                            <tr class="text-center fs-4">
                                <?php if ($firstModule) : ?>
                                    <td rowspan="<?= count($modulesFiliere) ?>"><?= $filiere['nom_filiere'] ?></td>
                                    <?php $firstModule = false; ?>
                                <?php endif; ?>
                                <td><?= $module['nom_modules'] ?></td>
                                <td class="text-center">
                                    <a href="./notes_archives.php?anne=<?= $anne_univ ?>&filiere=<?= $filiere['nom_filiere'] ?>&module=<?= $module['nom_modules'] ?>" class="text-danger">
                                        <i class="bi bi-eye-fill fs-3 eye-color"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
        </div>
        </tbody>
        </table>
    </div>
</div>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>