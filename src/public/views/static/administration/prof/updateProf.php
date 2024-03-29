<?php
include_once "../layout.php"; ?>

<?php

use src\app\controllers\adminController;
use src\app\validattor\Validator;

require_once "../../../../../app/controllers/adminController.php";

$errors = [];
$data = [];
if (isset($_GET['cin']))
    $cin = $_GET['cin'];
$user = new adminController;
$user->findProfByCin($cin);
$validate = new Validator;

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
    // $data['departement'] = isset($_POST["departement"]) ? test_input($_POST["departement"]) : "";
    $data['type_prof'] = isset($_POST["type_prof"]) ? test_input($_POST["type_prof"]) : "";
    // $data['filiere'] = isset($_POST["filiere"]) ? $_POST["filiere"] : [];
    // $nbrF = count($data['filiere']);
    $errors = $validate->validateData($data);
}



if (!array_filter($errors)) {
    $user->update($data, $cin);
}

?>

<div class="mt-2 text-primary  ">
    <i class="bi bi-person fs-4 px-2"></i>
    <span class="h6 text-primary ">Modifier Un Professeur</span>
</div>
<form action="" method="POST">
    <div class="mt-2">
        <label for="cin" class="form-label">CIN</label>
        <input type="text" class="form-control" id="cin" name="cin" value="<?php echo isset($_SESSION['infos']['cin']) ? $_SESSION['infos']['cin'] : '' ?>" required>
        <span class=" error text-danger"><?php echo isset($errors['empty_cin']) ?  $errors['empty_cin'] :  "" ?></span>
    </div>
    <div class=" mb-2">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo isset($_SESSION['infos']['nom']) ?  $_SESSION['infos']['nom'] : '' ?>" required>
        <span class=" error text-danger"><?php echo isset($errors['empty_nom']) ?  $errors['empty_nom'] :  "" ?></span>
    </div>
    <div class=" mb-2">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo isset($_SESSION['infos']['prenom']) ?  $_SESSION['infos']['prenom'] : '' ?>" required>
        <span class=" error text-danger"><?php echo isset($errors['empty_prenom']) ?  $errors['empty_prenom'] :  "" ?></span>
    </div>
    <div class=" mb-2">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_SESSION['infos']['email_isntitutionnel']) ? $_SESSION['infos']['email_isntitutionnel'] : '' ?>" required>
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