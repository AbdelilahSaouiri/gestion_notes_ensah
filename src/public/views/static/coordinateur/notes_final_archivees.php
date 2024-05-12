<?php
session_start();
include_once "../../../../app/controllers/coordinateurController.php";
include_once "../../../../app/controllers/professeurController.php";

use src\app\controllers\professeurController;
use src\app\controllers\coordinateurController;

$prof = new professeurController;
$user = new coordinateurController;
$semestre = isset($_GET['semestre']) ? $_GET['semestre'] : "";
$anne_univ = isset($_GET['anne']) ? $_GET['anne'] : "";
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$filiereId = $prof->getFiliereId($filiere);
$module = isset($_GET['module']) ? $_GET['module'] : "";
$moduleId = $prof->getModuleId($module);
$notes = $prof->getAllNotes($filiereId, $moduleId, $anne_univ);

?>
<?php include_once "./masterPage.php"  ?>
<main class="mt-4">
    <div class="container">
        <div>
            <div class="w-50 mx-auto my-4 fs-4 text-center p-1 font bg-danger" style="border-radius: 10px;">
                <div class="d-flex justify-content-between ">
                    <span class=" text-white py-2 ms-3 "> <span style="letter-spacing: 0.7px;">filière </span>:<?= $filiere ?> </span>
                    <span class=" text-white py-2 me-3"> Semestre :<?= $semestre ?> </span>
                </div>
            </div>
        </div>
        <table class="table table-bordered  mx-auto mt-3">
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
                        <td><?= $prof->getNameStudentByCIn($note['cin_etud']) ?></td>
                        <td><?= $note['note_ds'] ?></td>
                        <td><?= $note['note_exam'] ?></td>
                        <td><?= $note['note_tp_projet'] ?></td>
                        <td>
                            <?= $note_value = ($note['note_ds'] * 0.3 + $note['note_exam'] * 0.6 + $note['note_tp_projet'] * 0.1) ?>
                        </td>
                        <td><?=
                            $resulat = $note_value > 12 ?
                                '<span class="text-success">V</span>' :
                                '<span class=" text-danger">R</span>'; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</main>


<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>