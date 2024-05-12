<?php
session_start();
include_once "../../../../app/controllers/studentController.php";
include_once "../../../../app/controllers/professeurController.php";

use src\app\controllers\professeurController;
use src\app\controllers\studentController;

$prof = new professeurController;
$user = new studentController;
$date = new DateTime();
$currentdate = $date->format('m-d');
$ann_uinv = $date->format('Y');
$cin = isset($_SESSION['cin_etud']) ? $_SESSION['cin_etud'] : "";
$module = isset($_GET['module']) ? $_GET['module'] : "";
$moduleId = $prof->getModuleId($module);
$notes = $user->getNotes($cin, $moduleId, $ann_uinv);
$semestre = ($currentdate > '02-15' && $currentdate < '08-01') ? 2 : 1;

?>
<?php include_once "./masterPage.php"; ?>

<div class="container">
    <div class="mt-4">
        <div class="text-center mb-5">
            <div class="btn p-3 bg-danger text-white w-75 " style="border-radius: 10px;">
                <div class="d-flex justify-content-between">
                    <div class="fs-4 me-4 ">Module: <span><?= $module ?></span></div>
                    <div class="fs-4 ms-4 me-2 ">Semestre: <span><?= $semestre ?></span></div>
                </div>
            </div>
        </div>
        <table class=" table table-sm table-bordered w-75 mx-auto">
            <thead class="text-center" style="background-color: #183258;opacity:0.9;border-radius:10px;">
                <th class="text-white">Note Ds</th>
                <th class="text-white">Note Exam</th>
                <th class="text-white">Note Finale</th>
                <th class="text-white">Résultat</th>
            </thead>
            <tbody>
                <?php foreach ((array)$notes as $note) : ?>
                    <tr class="text-center">
                        <td><?= $note['note_ds'] ?></td>
                        <td><?= $note['note_exam'] ?></td>
                        <td>
                            <?= $note_value = ($note['note_ds'] * 0.3 + $note['note_exam'] * 0.6 + $note['note_tp_projet'] * 0.1) ?>
                        </td>
                        <td><?=
                            $resulat = $note_value > 12 ?
                                '<span class="gr fs-3">V</span>' :
                                '<span class="fs-3 text-danger">R</span>'; ?>
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