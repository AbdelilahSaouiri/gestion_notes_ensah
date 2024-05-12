<?php
session_start();
include_once "../../../../app/controllers/chefDepartementController.php";

use src\app\controllers\chefDepartementController;

$user = new chefDepartementController;
$ann_univ = isset($_GET['anne']) ? $_GET['anne'] : "";
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$modules1 = $user->getmodules($filiere, 1);
$modules2 = $user->getmodules($filiere, 2);
?>

<?php include "./masterPage.php" ?>
<div class="container">
    <div class="mt-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item ms-4 " role="presentation">
                <button class="nav-link active " style="font-size: 17px;" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Semsetre 1</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="profile-tab" style="font-size: 17px;" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Semestre 2</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <table class="table  table-bordered ">
                    <thead class="text-center" style="background-color: #183258;opacity:0.9;border-radius:10px;">
                        <th class="text-white w-25">Modules</th>
                        <th class="text-white w-25">Voir Note</th>
                    </thead>
                    <tbody>
                        <?php foreach ($modules1 as $module) : ?>
                            <tr>
                                <td style=" font-size: 16px;color:blue;"><?= $module['nom_modules'] ?></td>
                                <td class="text-center">
                                    <a href="./voirNotesArchivesModules.php?module=<?= $module['nom_modules'] ?>&anne=<?= $ann_univ ?>&filiere=<?= $filiere ?>&semestre=1"> <i class="bi bi-eye-fill text-success fs-3 show"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <table class="table  table-bordered ">
                    <thead class="text-center" style="background-color: #183258;opacity:0.9;border-radius:10px;">
                        <th class="text-white w-25">Modules</th>
                        <th class="text-white w-25">Voir Note</th>
                    </thead>
                    <tbody>
                        <?php foreach ($modules2 as $module) : ?>
                            <tr>
                                <td style=" font-size: 16px;color:blue;"><?= $module['nom_modules'] ?></td>
                                <td class="text-center">
                                    <a href="./voirNotesArchivesModules.php?module=<?= $module['nom_modules'] ?>&anne=<?= $ann_univ ?>&filiere=<?= $filiere ?>&semestre=2"> <i class="bi bi-eye-fill text-success fs-3 show"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </div>
        </div>
    </div>
</div>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>