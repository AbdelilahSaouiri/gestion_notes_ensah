<?php include_once "../layout.php"; ?>

<?php

use src\app\controllers\adminController;
use src\app\validattor\Validator;

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

$validate = new Validator();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data['cin'] = isset($_POST["cin"]) ? test_input($_POST["cin"]) : "";
    $data['nom'] = isset($_POST["nom"]) ? test_input($_POST["nom"]) : "";
    $data['prenom'] = isset($_POST["prenom"]) ? test_input($_POST["prenom"]) : "";
    $data['cne'] = isset($_POST["prenom"]) ? test_input($_POST["prenom"]) : "";
    $data['email'] = isset($_POST["email"]) ? test_input($_POST["email"]) : "";
    $data['departement'] = isset($_POST["departement"]) ? test_input($_POST["departement"]) : "";
    $data['filiere'] = isset($_POST["filiere"]) ? $_POST["filiere"] : "";
    $errors = $validate->validateData($data);
    $_SESSION['data'] = $data;
}

var_dump($data);

$user = new adminController;
if (!array_filter((array)$errors)) {
    $user->registerStudent($data);
    //$user->storeProf_Departement($data, $nbrF);
}

?>



<span class="error text-<?php echo isset($_SESSION['error']) ? 'danger' : (isset($_SESSION['success']) ? 'success' : 'danger'); ?>" role="alert">
    <?php
    if (isset($_SESSION['success'])) {
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    } elseif (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>
</span>

<div class="mt-2 text-primary  ">
    <i class="bi bi-person-add fs-4 px-2"></i>
    <span class="h6 text-primary ">Ajouter Un Etudiant</span>
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
        <label for="cne" class="form-label">CNE</label>
        <input type="text" class="form-control" id="cne" name="cne" value="<?php echo isset($data['cne']) ?  $data['cne'] : '' ?>" required>
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
                <option value="AP1" selected>API1</option>
                <option value="AP2">API2</option>
                <option value="GI1">GI1</option>
                <option value="GI2">GI2</option>
                <option value="GI3">GI3</option>
                <option value="ID1">ID1</option>
                <option value="ID2">ID2</option>
                <option value="ID3">ID3</option>
                <option value="TDIA1">TDIA1</option>
                <option value="TDIA2">TDIA2</option>
                <option value="TDIA3">TDIA3</option>
            </optgroup>
            <optgroup label="Civil et Eau">
                <option value="CE1">CE1</option>
                <option value="CE2">CE2</option>
                <option value="CE3">CE3</option>
            </optgroup>
            <optgroup label="Environnement et Énergie">
                <option value="EE1">EE1</option>
                <option value="EE2">EE2</option>
                <option value="EE3">EE3</option>
            </optgroup>
        </select>
    </div>
    <span class=" error text-danger"><?php echo isset($errors['empty_filiere']) ?  $errors['empty_filiere'] :  "" ?></span>

    <button type="submit" class="my-4 btn btn-primary">Enregistrer</button>
</form>