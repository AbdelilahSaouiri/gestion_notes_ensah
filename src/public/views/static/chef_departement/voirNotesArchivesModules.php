<?php
session_start();
include_once "../../../../app/controllers/chefDepartementController.php";
include_once "../../../../app/controllers/studentController.php";
include_once "../../../../app/controllers/professeurController.php";

use src\app\controllers\studentController;
use src\app\controllers\professeurController;
use src\app\controllers\chefDepartementController;

$user = new chefDepartementController;
$prof = new professeurController;
$student = new studentController;
$module = isset($_GET['module']) ? $_GET['module'] : "";
$moduleId = $prof->getModuleId($module);
$ann_univ = isset($_GET['anne']) ? $_GET['anne'] : "";
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$idfiliere = $user->getFiliereIdByCin($filiere);
$notes = $user->getArchivesNotes($idfiliere, $moduleId, $ann_univ);
?>


<?php include "./masterPage.php" ?>

<main class="mt-4">
    <div class="container">
        <table class="table table-bordered">
            <thead style="background-color: #183258;opacity:0.9;">
                <tr class="text-center">
                    <th class="text-white fs-5">CIN</th>
                    <th class="text-white fs-5">Nom</th>
                    <th class="text-white fs-5">Prenom</th>
                    <th class="text-white fs-5">Bote DS</th>
                    <th class="text-white fs-5">Note EXAM</th>
                    <th class="text-white fs-5">Note TP</th>
                    <th class="text-white fs-5">Note Final</th>
                    <th class="text-white fs-5">Résultat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $note) : ?>
                    <tr class="text-center">
                        <td><?= $note['cin_etud']  ?></td>
                        <td><?= explode(' ', $student->getNameStudentByCIn($note['cin_etud']))[0] ?></td>
                        <td><?= explode(' ', $student->getNameStudentByCIn($note['cin_etud']))[1] ?></td>
                        <td><?= $note['note_ds'] ?></td>
                        <td><?= $note['note_exam'] ?></td>
                        <td><?= $note['note_tp_projet'] ?></td>
                        <td>
                            <?= $note_value = ($note['note_ds'] * 0.3 + $note['note_exam'] * 0.6 + $note['note_tp_projet'] * 0.1) ?>
                        </td>
                        <td><?=
                            $resulat = $note_value > 12 ?
                                '<span class="text-success fs-4">V</span>' :
                                '<span class="fs-4 text-danger">R</span>'; ?>
                        </td>
                    </tr>
                <?php endforeach;  ?>
            </tbody>
        </table>
    </div>
</main>




<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>