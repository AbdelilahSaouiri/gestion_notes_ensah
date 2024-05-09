<?php
session_start();
include_once "../../../../app/controllers/professeurController.php";

use src\app\controllers\professeurController;

$user = new professeurController;
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$module = isset($_GET['module']) ? $_GET['module'] : "";
$moduleId = $user->getModuleId($module);
$filiereId = $user->getFiliereId($filiere);
$notes = $user->getAllNotes($filiereId, $moduleId);
$semestre = $user->getSemsetre($module);
$yearSystem = new DateTime();
$anne_univ = $yearSystem->format('Y');

//stocker les notes sous forme de csv
if (isset($_POST['export'])) {
    $sem = $semestre['semestre'];
    $mod = trim($module, ' ');
    $md = explode(' ', $mod)[0];
    $filename = "C:/xampp/htdocs/gestion_notes_ensah/src/storage/notes-$filiere-$md-$sem-$anne_univ.csv";

    // Ouvrir le fichier en écriture
    $file = fopen($filename, 'w');
    if ($file === false) {
        echo '<script>alert(`Impossible d\'ouvrir le fichier CSV`)</script>';
    }

    if (!fputcsv($file, array(
        'CIN', 'Etudiant', 'Note DS', 'Note Exam', 'Note TP/Projet'
    ))) {
        die('Erreur lors de l\'écriture des en-têtes CSV.');
    }

    foreach ($notes as $note) {
        if (!fputcsv($file, array($note['cin_etud'], $user->getNameStudentByCIn($note['cin_etud']), $note['note_ds'], $note['note_exam'], $note['note_tp_projet']))) {
            die('Erreur lors de l\'écriture des données dans le fichier CSV.');
        }
    }

    fclose($file);

    if (file_exists($filename)) {
        echo "<script>alert(`Le fichier CSV a été créé avec succès`)</script>";
    } else {
        echo "<script>alert(`Une erreur s'est produite lors de la création du fichier CSV`)</script>";
    }
}

?>

<?php include_once "./masterPage.php"; ?>

<div class="mt-4 container">
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
        <thead style="background-color: #183258;">
            <tr>
                <th class="text-white">CIN</th>
                <th class="text-white">Etudiant</th>
                <th class="text-white">Note DS</th>
                <th class="text-white">Note Exam</th>
                <th class="text-white">Note TP_Projet</th>
                <th class="text-white">Modifier Note</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notes as $note) : ?>
                <tr>
                    <td><?= $note['cin_etud']  ?></td>
                    <td><?= $user->getNameStudentByCIn($note['cin_etud']) ?></td>
                    <td><?= $note['note_ds'] ?></td>
                    <td><?= $note['note_exam'] ?></td>
                    <td><?= $note['note_tp_projet'] ?></td>
                    <td class="text-center"><a href="./modifierNote.php?cin=<?= $note['cin_etud'] ?>&nom=<?= $user->getNameStudentByCIn($note['cin_etud']) ?>&noteds=<?= $note['note_ds'] ?>&notexam=<?= $note['note_exam'] ?>&notetp=<?= $note['note_tp_projet'] ?>&module=<?= $module ?>&semestre=<?= $semestre['semestre'] ?>&filiere=<?= $filiere ?>"><button class="btn btn-success">Modifier</button></a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<div class="mt-5 mx-auto parent">
    <form method="post" action="">
        <button type="submit" name="export" class="btn py-1 file"><i class="bi bi-filetype-csv mx-2 fs-2 text-white"></i><span style="font-size: 16.3px;">Exporter les Notes</span></button>
    </form>
</div>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>