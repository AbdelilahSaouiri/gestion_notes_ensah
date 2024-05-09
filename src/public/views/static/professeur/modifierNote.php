<?php
session_start();
include_once "../../../../app/controllers/professeurController.php";

use src\app\controllers\professeurController;

$user = new professeurController;
$module = isset($_GET['module']) ? $_GET['module'] : "";
$nom = isset($_GET['nom']) ? $_GET['nom'] : "";
$cin = isset($_GET['cin']) ? $_GET['cin'] : "";
$semestre = isset($_GET['semestre']) ? $_GET['semestre'] : "";
$filiere = isset($_GET['filiere']) ? $_GET['filiere'] : "";
$note_ds = isset($_GET['noteds']) ? $_GET['noteds'] : "";
$note_exam = isset($_GET['notexam']) ? $_GET['notexam'] : "";
$note_tp_projet = isset($_GET['notetp']) ? $_GET['notetp'] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cin_etud = $_POST['cin_etud'];
    $note_ds = $_POST['note_ds'];
    $note_exam = $_POST['note_exam'];
    $note_tp_projet = $_POST['note_tp_projet'];

    $data['cin'] = $cin_etud;
    $data['note_ds'] = $note_ds;
    $data['note_exam'] = $note_exam;
    $data['note_tp'] = $note_tp_projet;
    $updated = $user->updateNote($data);
    if ($updated === true) {
        echo "<script>alert('Modifié avec succès')</script>";
        echo '<script>window.location="./consulterNotes.php"</script>';
        exit;
    }
}

?>
<?php include_once "./masterPage.php"; ?>


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center fs-4" style="background-color: #183258; color: #FFFFFF;">
                    Modifier La Note
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nom_etud" class="form-label">Nom et Prénom de l'étudiant</label>
                            <input type="text" class="form-control" id="nom_etud" name="nom_etud" value="<?= $nom ?>" readonly style="background-color: #183258; color: #FFFFFF; font-size:16px">
                        </div>
                        <div class="mb-3">
                            <label for="cin_etud" class="form-label">CIN de l'étudiant</label>
                            <input type="text" class="form-control" id="cin_etud" name="cin_etud" value="<?= $cin ?>" readonly style="background-color: #183258; color: #FFFFFF;">
                        </div>
                        <div class="mb-3">
                            <label for="note_ds" class="form-label">Note DS</label>
                            <input type="number" class="form-control" id="note_ds" name="note_ds" value="<?= $note_ds ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="note_exam" class="form-label">Note Exam</label>
                            <input type="number" class="form-control" id="note_exam" name="note_exam" value="<?= $note_exam ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="note_tp_projet" class="form-label">Note TP / Projet</label>
                            <input type="number" class="form-control" id="note_tp_projet" name="note_tp_projet" value="<?= $note_tp_projet ?>" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>