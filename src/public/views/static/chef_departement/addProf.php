<?php
session_start();
include_once "../../../../app/controllers/chefDepartementController.php";

use src\app\controllers\chefDepartementController;

$user = new chefDepartementController;
$cin = isset($_SESSION['chef_cin']) ? $_SESSION['chef_cin'] : "";
$departement = $user->getDepartement($cin);
$data = [];
$errors = [];

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data['cin'] = isset($_POST["cin"]) ? test_input($_POST["cin"]) : "";
    $data['nom'] = isset($_POST["nom"]) ? test_input($_POST["nom"]) : "";
    $data['prenom'] = isset($_POST["prenom"]) ? test_input($_POST["prenom"]) : "";
    $data['email'] = isset($_POST["email"]) ? test_input($_POST["email"]) : "";
    $data['type_prof'] = isset($_POST["type_prof"]) ? test_input($_POST["type_prof"]) : "";

    $user->saveprof($data, $departement['id_departement']);
    if (isset($_SESSION['saved_success']))
        header("Location:./gestionprof.php");
    exit();
}
?>

<?php include "./masterPage.php" ?>

<div class="w-75 m-auto">
    <!-- Vérifier s'il y a un message de succès -->
    <?php if (isset($_SESSION['saved_success'])) : ?>
        <div class="card bg-success text-white text-center mb-3">
            <div class="card-body">
                <?php echo $_SESSION['saved_success']; ?>
            </div>
        </div>
        <?php unset($_SESSION['saved_success']); ?>
    <?php endif; ?>

    <!-- Vérifier s'il y a un message d'erreur -->
    <?php if (isset($_SESSION['prof_exists'])) : ?>
        <div class="card bg-danger text-white text-center mb-3">
            <div class="card-body">
                <?php echo $_SESSION['prof_exists']; ?>
            </div>
        </div>
        <?php unset($_SESSION['prof_exists']); ?>
    <?php endif; ?>
    <div class="w-75 m-auto">
        <div class="mt-2 text-primary ">
            <i class="bi bi-person-add fs-4 px-2"></i>
            <span class="h5 text-primary ">Ajouter Un Professeur</span>
        </div>

        <form action="" method="POST">
            <div class="mt-2">
                <label for="cin" class="form-label">CIN</label>
                <input type="text" class="form-control" id="cin" name="cin" required>
            </div>
            <div class=" mb-2">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo isset($data['nom']) ?  $data['nom'] : '' ?>" required>

            </div>
            <div class=" mb-2">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo isset($data['prenom']) ?  $data['prenom'] : '' ?>" required>

            </div>
            <div class=" mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : '' ?>" required>

            </div>
            <div class="mb-2">
                <label for="type_prof" class="form-label">Type de Professeur*</label>
                <select class="form-select" id="type_prof" name="type_prof" required>
                    <option selected disabled>Sélectionner le type de professeur</option>
                    <option value="Titulaire" selected>Titulaire</option>
                    <option value="Vacataire">Vacataire</option>
                    <option value="Assistant">Assistant</option>
                </select>
            </div>
            <div class="d-flex justify-content-center gap-1">
                <button type="submit" class="my-4 btn btn-success w-25">Enregistrer</button>
                <button type="reset" class="my-4 btn btn-danger w-25">Reset</button>
            </div>
        </form>
    </div>
    <script src="../../../utilities/dashboard/static/js/app.js"></script>
    </body>

    </html>