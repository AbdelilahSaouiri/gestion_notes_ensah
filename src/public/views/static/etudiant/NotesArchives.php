<?php
session_start();
include_once "../../../../app/controllers/studentController.php";
include_once "../../../../app/controllers/professeurController.php";
include_once "../../../../app/controllers/professeurController.php";

use src\app\controllers\studentController;
use src\app\controllers\professeurController;

$prof = new professeurController;
$user = new studentController;
$cin = isset($_SESSION['cin_etud']) ? $_SESSION['cin_etud'] : "";
$semestre = isset($_GET['semestre']) ? $_GET['semestre'] : "";
$module = isset($_GET['module']) ? $_GET['module'] : "";
$moduleId = $prof->getModuleId($module);
$ann_univ = isset($_GET['anne']) ? $_GET['anne'] : "";
$idfiliere = $user->getFiliereForStudentByCin($cin);
$filiere = $user->getFiliereNameById($idfiliere);
$notes = $user->getArchivesNotes($idfiliere, $moduleId, $ann_univ);
?>

<?php include_once "./masterPage.php"; ?>

<div class="container">
    <div class="mt-4 mx-auto">
        <div>
            <div class="d-flex justify-content-between w-75 mx-auto mt-5 fs-4 text-center p-1 font bg-danger" style="border-radius: 10px;">
                <span class=" text-white py-2 ms-4">Année universitaire : <?= $ann_univ ?></span>
                <span class=" text-white py-2 me-4">Semestre: <?= $semestre ?></span>
            </div>
            <table class="table fs-5 table-bordered w-75 mx-auto mt-3">
                <thead style="background-color: #183258;">
                    <tr class="text-center">
                        <th class="text-white">CIN</th>
                        <th class="text-white">Etudiant</th>
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
                            <td><?= $user->getNameStudentByCIn($note['cin_etud']) ?></td>
                            <td><?= $note['note_ds'] ?></td>
                            <td><?= $note['note_exam'] ?></td>
                            <td><?= $note['note_tp_projet'] ?></td>
                            <td>
                                <?= $note_value = ($note['note_ds'] * 0.3 + $note['note_exam'] * 0.6 + $note['note_tp_projet'] * 0.1) ?>
                            </td>
                            <td><?=
                                $resulat = $note_value > 12 ?
                                    '<span class="gr fs-4">V</span>' :
                                    '<span class="fs-4 text-danger">R</span>'; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../../../utilities/dashboard/static/js/app.js"></script>
    </body>

    </html>