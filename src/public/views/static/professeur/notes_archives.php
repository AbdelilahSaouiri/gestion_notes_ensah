<?php
session_start();
include_once "../../../../app/controllers/professeurController.php";
include_once "../../../../app/controllers/coordinateurController.php";

use src\app\controllers\coordinateurController;
use src\app\controllers\professeurController;

$user = new professeurController;
$cord = new coordinateurController;
$anne_univ = isset($_GET['anne']) ? $_GET['anne'] : "";
$module = isset($_GET['module']) ? $_GET['module'] : "";
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$cin_prof = isset($_SESSION['module']) ? $_SESSION['module'] : "";
$moduleId = $user->getModuleId($module);
$filiereId = $user->getFiliereId($filiere);
$semestre = $user->getSemsetre($module);
$notes = $user->getAllNotes($filiereId, $moduleId, $anne_univ);
?>
<?php include_once "./masterPage.php"; ?>

<div class="mt-4">
    <div class="card mx-auto w-75">
        <div class="card-header pb-2">
            <div class="d-flex justify-content-between">
                <div> <i class="bi bi-calendar me-2 text-success"></i>Année Universitaire : <span class="text-success fs-4"> <?= isset($year) ? $year : $anne_univ  ?> </span></div>
                <div><i class="bi bi-backpack2 fs-4 me-2 text-success"><span class="font ms-2">Semestre :</span></i> <span class="me-2 text-success"><?= isset($semestre['semestre']) ? $semestre['semestre'] : ""  ?></span></div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div><i class="bi bi-clipboard2-fill me-2 text-success"></i> <?= isset($filiere) ? $filiere : "" ?></div>
                <div><i class="bi bi-journal-bookmark-fill me-2 text-success"></i><?= isset($module) ? $module : "" ?></div>
            </div>
        </div>
    </div>
    <table class="table table-bordered w-75 mx-auto mt-3">
        <thead class="fs-5" style="background-color: #183258;">
            <tr>
                <th class="text-white">CIN</th>
                <th class="text-white">NOM</th>
                <th class="text-white">Pénom</th>
                <th class="text-white">Note DS</th>
                <th class="text-white">Note Exam</th>
                <th class="text-white">Note TP_Projet</th>
                <th class="text-white">Note Finale</th>
                <th class="text-white">Résultat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notes as $note) : ?>
                <tr class="text-center">
                    <td><?= $note['cin_etud']  ?></td>
                    <td><?= explode(' ', $user->getNameStudentByCIn($note['cin_etud']))[0] ?></td>
                    <td><?= explode(' ', $user->getNameStudentByCIn($note['cin_etud']))[1] ?></td>
                    <td><?= $note['note_ds'] ?></td>
                    <td><?= $note['note_exam'] ?></td>
                    <td><?= $note['note_tp_projet'] ?></td>
                    <td>
                        <?= $note_value = ($note['note_ds'] * 0.3 + $note['note_exam'] * 0.6 + $note['note_tp_projet'] * 0.1) ?>
                    </td>
                    <td><?=
                        $resulat = $note_value > 12 ?
                            '<span class="text-success ">V</span>' :
                            '<span class="text-danger">R</span>'; ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>