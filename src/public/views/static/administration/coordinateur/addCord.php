<?php include_once "../layout.php"; ?>

<?php

use src\app\controllers\adminController;

require_once "../../../../../app/controllers/adminController.php";

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

    $data['nom'] = isset($_POST["nom"]) ? test_input($_POST["nom"]) : "";
    $data['prenom'] = isset($_POST["prenom"]) ? test_input($_POST["prenom"]) : "";
    $data['cin'] = isset($_POST["cin"]) ? test_input($_POST["cin"]) : "";
    $data['email'] = isset($_POST["email"]) ? test_input($_POST["email"]) : "";
    $data['departement'] = isset($_POST["departement"]) ? test_input($_POST["departement"]) : "";
    $data['filiere'] = isset($_POST["filiere"]) ? $_POST["filiere"] : "";
    $_SESSION['cord_data'] = $data;
}

$user = new adminController;

$user->registerCoordinateur($data);

?>
<?php
if (isset($_SESSION['cord_success'])) {
    // Récupérer le message de succès
    $successMessage = $_SESSION['cord_success'];
    // Afficher un script JavaScript pour afficher un modal Bootstrap
    echo "<script>
    // Attendre que le document soit chargé
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner le modal à afficher
        var modal = new bootstrap.Modal(document.getElementById('successModal'), {
            keyboard: false
        });
        // Afficher le modal avec le message de succès
        modal.show();
        // Rediriger vers prof.php après un court délai
        setTimeout(function() {
            window.location.href = './cord.php';
        }, 2000); // Délai en millisecondes (ici 3000 ms = 3 secondes)
    });
</script>";
    // Supprimer la session update_success après l'avoir affichée
    unset($_SESSION['cord_success']);
}

?>
<!-- Modal de succès -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Enregistrement réussie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Coordinateur a été enregistré avec succès.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="mt-2 text-primary  ">
    <i class="bi bi-person-add fs-4 px-2"></i>
    <span class="h6 text-primary ">Ajouter Un Coordinateur</span>
</div>
<form action="" method="POST">

    <div class="mt-2">
        <label for="cin" class="form-label">CIN</label>
        <input type="text" class="form-control" id="cin" name="cin" value="<?php echo isset($data['cin']) ?  $data['cin'] : '' ?>" required>
        <span class=" error text-danger"><?php echo isset($errors['empty_cin']) ?  $errors['empty_cin'] :  "" ?></span>
    </div>
    <div class=" mb-2">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo isset($data['nom']) ?  $data['nom'] : '' ?>" required>
        <span class=" error text-danger"><?php echo isset($errors['empty_nom']) ?  $errors['empty_nom'] :  "" ?></span>
    </div>
    <div class=" mb-2">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo isset($data['prenom']) ?  $data['prenom'] : '' ?>" required>
        <span class=" error text-danger"><?php echo isset($errors['empty_prenom']) ?  $errors['empty_prenom'] :  "" ?></span>
    </div>

    <div class=" mb-2">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : '' ?>" required>
        <span class=" error text-danger">
            <?php echo isset($errors['empty_email']) ? $errors['empty_email'] : (isset($errors['invalid_email']) ? $errors['invalid_email'] : "") ?></span>
    </div>
    <div class=" mb-2">
        <label for="departement" class="form-label">Département*</label>
        <select class="form-select" id="departement" name="departement" required>
            <option selected disabled>Sélectionner le département</option>
            <option value="Mathematique et Informatique" selected>Mathematique et Informatique</option>
            <option value="Civil et Eau">Civil et Eau</option>
            <option value="Environement et Energie">Environement et Energie</option>
        </select>
        <span class=" error text-danger"><?php echo isset($errors['empty_departement']) ?  $errors['empty_departement'] :  "" ?></span>
    </div>
    <div class="mb-2">
        <label for="filiere" class="form-label">Filieres*</label>
        <select class="form-select" id="filiere" name="filiere" required>
            <option selected disabled>Sélectionner les filières</option>
            <optgroup label="Mathématique et Informatique">
                <option value="AP">AP</option>
                <option value="GI">GI</option>
                <option value="ID">ID</option>
                <option value="TDIA">TDIA</option>
            </optgroup>
            <optgroup label="Civil et Eau">
                <option value="CE">CE</option>
            </optgroup>
            <optgroup label="Environnement et Énergie">
                <option value="EE">EE</option>
            </optgroup>
        </select>
    </div>
    <span class=" error text-danger"><?php echo isset($errors['empty_filiere']) ?  $errors['empty_filiere'] :  "" ?></span>

    <button type="submit" class="my-4 btn btn-primary">Enregistrer</button>
</form>