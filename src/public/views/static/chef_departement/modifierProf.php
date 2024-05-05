<?php
session_start();
include_once "../../../../app/controllers/chefDepartementController.php";

use src\app\controllers\chefDepartementController;

$user = new chefDepartementController;
$cin = isset($_SESSION['chef_cin']) ? $_SESSION['chef_cin'] : "";
$departement = $user->getDepartement($cin);
// $data = isset($_SESSION['data']) ? $_SESSION['data'] : [];
$errors = [];

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$cin = isset($_GET['cin']) ? $_GET['cin'] : "";

$prof = $user->findProfByCin($cin);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data['cin'] = isset($_POST["cin"]) ? test_input($_POST["cin"]) : $data['cin'];
    $data['nom'] = isset($_POST["nom"]) ? test_input($_POST["nom"]) : $data['nom'];
    $data['prenom'] = isset($_POST["prenom"]) ? test_input($_POST["prenom"]) : $data['prenom'];
    $data['email'] = isset($_POST["email"]) ? test_input($_POST["email"]) : $data['email'];
    $data['type_prof'] = isset($_POST["type_prof"]) ? test_input($_POST["type_prof"]) : "";

    $updated = $user->updateProfesseur($data, $cin);
    if ($updated == true) {
        echo '
            <script>
            alert("le professeur a modifié avec succès");
            window.location.href = "./gestionprof.php";
            </script>';
        exit();
    }
}
?>
<?php include "./masterPage.php" ?>

<div class="container w-75">
    <div class="mt-4 text-primary">
        <i class="bi bi-person fs-4 px-2"></i>
        <span class="h6 text-primary">Modifier un Professeur</span>
    </div>
    <form action="" method="POST">
        <div class="mt-2">
            <label for="cin" class="form-label">CIN</label>
            <input type="text" class="form-control" id="cin" name="cin" value="<?php echo isset($data['cin']) ?  $data['cin'] : $prof['cin'] ?>" required>
            <span class=" error text-danger"><?php echo isset($errors['empty_cin']) ?  $errors['empty_cin'] :  "" ?></span>
        </div>
        <div class=" mb-2">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo isset($data['nom']) ?  $data['nom'] : $prof['nom'] ?>" required>
            <span class=" error text-danger"><?php echo isset($errors['empty_nom']) ?  $errors['empty_nom'] :  "" ?></span>
        </div>
        <div class=" mb-2">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo isset($data['prenom']) ?  $data['prenom'] : $prof['prenom'] ?>" required>
            <span class=" error text-danger"><?php echo isset($errors['empty_prenom']) ?  $errors['empty_prenom'] :  "" ?></span>
        </div>
        <div class=" mb-2">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : $prof['email_isntitutionnel'] ?>" required>
            <span class=" error text-danger">
                <?php echo isset($errors['empty_email']) ? $errors['empty_email'] : (isset($errors['invalid_email']) ? $errors['invalid_email'] : "") ?></span>
        </div>

        <div class="mb-2">
            <label for="type_prof" class="form-label">Type de Professeur*</label>
            <select class="form-select" id="type_prof" name="type_prof" required>
                <option selected disabled>Sélectionner le type de professeur</option>
                <option value="Titulaire" selected>Titulaire</option>
                <option value="Vacataire">Vacataire</option>
                <option value="Assistant">Assistant</option>
            </select>
            <span class=" error text-danger"><?php echo isset($errors['empty_type_prof']) ?  $errors['empty_type_prof'] :  "" ?></span>
        </div>

        <button type="submit" class="my-4 btn btn-primary">Modifier</button>
    </form>
</div>

<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>