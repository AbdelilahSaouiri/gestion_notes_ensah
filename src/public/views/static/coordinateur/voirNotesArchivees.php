<?php
session_start();
include_once "../../../../app/controllers/coordinateurController.php";

use src\app\controllers\coordinateurController;

$user = new coordinateurController;
$cin_cord = isset($_SESSION['cin_cord']) ? $_SESSION['cin_cord'] : "";
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$semestre = isset($_GET['semestre']) ? $_GET['semestre'] : "";
$anne_univ = isset($_GET['anne']) ? $_GET['anne'] : "";
$modules = $user->getModulesByFiliere($filiere, $semestre);
?>
<?php include_once "./masterPage.php"  ?>

<main class="mt-2">
    <div class="container">
        <div>
            <div class="w-50 mx-auto my-4 fs-4 text-center p-1 font bg-danger" style="border-radius: 10px;">
                <div class="d-flex justify-content-between ">
                    <span class=" text-white py-2 ms-3 "> <span style="letter-spacing: 0.7px;">filière </span>:<?= $filiere ?> </span>
                    <span class=" text-white py-2 me-3"> Semestre :<?= $semestre ?> </span>
                </div>
            </div>
        </div>
        <table class="table  table-bordered ">
            <thead class="text-center" style="background-color: #183258;opacity:0.9;border-radius:10px;">
                <th class="text-white w-25">Modules</th>
                <th class="text-white w-25">Voir Note</th>
            </thead>
            <tbody>
                <?php foreach ($modules as $module) : ?>
                    <tr>
                        <td style=" font-size: 16px;color:blue;"><?= $module['nom_modules'] ?></td>
                        <td class="text-center">
                            <a href="./notes_final_archivees.php?module=<?= $module['nom_modules'] ?>&semestre=<?= $semestre ?>&filiere=<?= $filiere ?>&anne=<?= $anne_univ ?>"> <i class="bi bi-eye-fill text-success fs-3 show"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>