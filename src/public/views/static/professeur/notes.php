<?php
session_start();
include_once "../../../../app/controllers/professeurController.php";

use src\app\controllers\professeurController;

$user = new professeurController;
$cin_prof = isset($_SESSION['cin']) ? $_SESSION['cin'] : "";
$nomFiliere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$module = isset($_GET['module']) ? $_GET['module'] : "";
$idModule = isset($_GET['id']) ? $_GET['id'] : "";
$idFiliere = $user->getIdFiliereByName($nomFiliere);
$yearSystem = new DateTime();
$anne_univ = $yearSystem->format('Y');
$students = $user->getAllStudentsByFiliere($idFiliere['id'], $anne_univ);
$count = 0;
$errors = [];
if (isset($_POST['submit'])) {
    foreach ($students as $student) {
        $data['nom'] = isset($student['nom']) ? $student['nom'] : "";
        $data['prenom'] = isset($student['prenom']) ? $student['prenom'] : "";
        $data['cin'] = isset($student['cin']) ? $student['cin'] : "";
        $data['id_module'] = $idModule;
        $data['id_filiere'] = $idFiliere['id'];
        if (isset($_POST['ds'][$student['cin']])) {
            if ($_POST['ds'][$student['cin']] >= 0 && $_POST['ds'][$student['cin']] <= 20) {
                $data['ds'][$student['cin']] = $_POST['ds'][$student['cin']];
            } else {
                $errors[$student['cin']]['ds_error'] = "La note doit être comprise entre 0 et 20";
            }
        }

        if (isset($_POST['exam'][$student['cin']])) {
            if ($_POST['exam'][$student['cin']] >= 0 && $_POST['exam'][$student['cin']] <= 20) {
                $data['exam'][$student['cin']] = $_POST['exam'][$student['cin']];
            } else {
                $errors[$student['cin']]['exam_error'] = "La note doit être comprise entre 0 et 20";
            }
        }
        if (isset($_POST['projet'][$student['cin']])) {
            if ($_POST['projet'][$student['cin']] >= 0 && $_POST['projet'][$student['cin']] <= 20) {
                $data['projet'][$student['cin']] = $_POST['projet'][$student['cin']];
            } else {
                $errors[$student['cin']]['projet_error'] = "La note doit être comprise entre 0 et 20";
            }
        }
        if ($errors) {
            echo '<script>alert(' . $errors . ')</script>';
        }
        $stored = $user->stockerNotes($data, $student);
        if ($stored == true) {
            $count++;
        }
    }
    if ($count == count($students)) {
        echo '<script>alert("Enregistré avec succès")</script>';
    } else {
        echo '<script>alert("Déja Enregistré")</script>';
    }
}
?>

<?php include_once "./masterPage.php"; ?>

<div class="container mt-3">
    <div class="card w-75 mx-auto mb-3">
        <div class="card-header text-center">
            <i class="bi bi-journal-bookmark-fill text-primary mx-3 pt-2 fs-4"></i> <strong class="font"><?= $module ?></strong>
        </div>
    </div>
    <form action="" method="post">
        <table class="table table-bordered">
            <thead class="bg-success text-white" style="opacity: 0.8;">
                <tr>
                    <th class="text-white">CIN</th>
                    <th class="text-white">Étudiant</th>
                    <th class="text-white">Note DS</th>
                    <th class="text-white">Note Exam</th>
                    <th class="text-white">Note TP | Projet</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?= $student['cin'] ?></td>
                        <td><?= $student['nom'] . ' ' . $student['prenom'] ?></td>
                        <td>
                            <input type="number" name="ds[<?= $student['cin'] ?>]" class="form-control" min="0" max="20" required value="<?= isset($_POST['ds'][$student['cin']]) ? $_POST['ds'][$student['cin']] : '' ?>">
                        </td>
                        <td>
                            <input type="number" name="exam[<?= $student['cin'] ?>]" class="form-control" min="0" max="20" required value="<?= isset($_POST['exam'][$student['cin']]) ? $_POST['exam'][$student['cin']] : '' ?>">
                        </td>
                        <td>
                            <input type="number" name="projet[<?= $student['cin'] ?>]" class="form-control" min="0" max="20" required value="<?= isset($_POST['projet'][$student['cin']]) ? $_POST['projet'][$student['cin']] : '' ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>