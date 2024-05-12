<?php
session_start();
include_once "../../../../app/controllers/studentController.php";

use src\app\controllers\studentController;

$user = new studentController;
$cin = isset($_SESSION['cin_etud']) ? $_SESSION['cin_etud'] : "";
$date = new DateTime();
$currentdate = $date->format('m-d');
$semestre = ($currentdate > '02-15' && $currentdate < '08-01') ? 2 : 1;
$idfiliere = $user->getFiliereForStudentByCin($cin);
$filiere = $user->getFiliereNameById($idfiliere);
$modules = ($currentdate > '02-15' && $currentdate  < '08-02') ?
    $user->getAllmodulesByFiliereName($filiere['nom_filiere'], 2) :
    $user->getAllmodulesByFiliereName($filiere['nom_filiere'], 1);


?>

<?php include_once "./masterPage.php" ?>

<div class="container">
    <div class="mt-4">
        <div class="text-center mb-4">
            <div class="btn p-2 bg-danger text-white w-75 " style="border-radius: 10px;">
                <div class="d-flex justify-content-between">
                    <div class="fs-4 me-4 "><span style="letter-spacing: 0.8px;">filière:</span> <?= $filiere['nom_filiere'] ?></div>
                    <div class="fs-4 ms-4 me-2 ">Semestre: <span><?= $semestre ?></span></div>
                </div>
            </div>
        </div>
        <table class="table  table-bordered ">
            <thead class="text-center fs-6" style="background-color: #183258;opacity:0.9;border-radius:10px;">
                <th class="text-white w-25">Modules</th>
                <th class="text-white w-25">Voir Note</th>
            </thead>
            <tbody>
                <?php foreach ($modules as $module) : ?>
                    <tr>
                        <td style=" font-size: 16px;color:blue;"><?= $module['nom_modules'] ?></td>
                        <td class="text-center">
                            <a href="./voirNotes.php?module=<?= $module['nom_modules'] ?>"> <i class="bi bi-eye-fill text-success fs-3 show"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src=" ../../../utilities/dashboard/static/js/app.js">
</script>
</body>

</html>