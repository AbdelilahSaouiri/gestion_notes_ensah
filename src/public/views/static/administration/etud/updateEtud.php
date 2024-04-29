<?php
// Inclusion des fichiers nécessaires

use src\app\controllers\adminController;

require_once "../../../../../app/controllers/adminController.php";
include_once "../layout.php";

// Instanciation de l'objet adminController
$user = new adminController;

// Initialisation des variables
$data = [];
$errors = [];

// Fonction pour nettoyer les données
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$cin = isset($_GET['cin']) ? $_GET['cin'] : "";

$user->findStudentByCin($cin);

$etudiant = isset($_SESSION['etudiant']) ? $_SESSION['etudiant'] : [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data['cin'] = isset($_POST["cin"]) ? test_input($_POST["cin"]) : "";
    $data['nom'] = isset($_POST["nom"]) ? test_input($_POST["nom"]) : "";
    $data['cne'] = isset($_POST["cne"]) ? test_input($_POST["cne"]) : "";
    $data['prenom'] = isset($_POST["prenom"]) ? test_input($_POST["prenom"]) : "";
    $data['email'] = isset($_POST["email"]) ? test_input($_POST["email"]) : "";

    // Appel de la méthode updateStudent de adminController pour mettre à jour l'étudiant
    $user->updateStudent($data, $cin);
}

// Suppression de la variable de session une fois le formulaire soumis
unset($_SESSION['data_etud']);
?>

<!-- Affichage du modal de succès après la mise à jour -->
<?php if (isset($_SESSION['update_etud_success'])) : ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('successModal'), {
                keyboard: false
            });
            modal.show();
            setTimeout(function() {
                window.location.href = './etud.php';
            }, 3000);
        });
    </script>
<?php unset($_SESSION['update_etud_success']);
endif; ?>

<!-- Modal de succès -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Mise à jour réussie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Votre mise à jour a été effectuée avec succès.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="mt-2 text-primary">
    <i class="bi bi-person fs-4 px-2"></i>
    <span class="h6 text-primary">Modifier un Etudiant</span>
</div>
<form action="" method="POST">
    <div class="mt-2">
        <label for="cin" class="form-label">CIN</label>
        <input type="text" class="form-control" id="cin" name="cin" value="<?php echo isset($etudiant['cin']) ? $etudiant['cin'] : ''; ?>" required>
        <span class="error text-danger"><?php echo isset($errors['empty_cin']) ? $errors['empty_cin'] : ''; ?></span>
    </div>
    <div class=" mb-2">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo isset($data['nom']) ?  $data['nom'] : $etudiant['nom'] ?>" required>
        <span class=" error text-danger"><?php echo isset($errors['empty_nom']) ?  $errors['empty_nom'] :  "" ?></span>
    </div>
    <div class=" mb-2">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo isset($data['prenom']) ?  $data['prenom'] : $etudiant['prenom'] ?>" required>
        <span class=" error text-danger"><?php echo isset($errors['empty_prenom']) ?  $errors['empty_prenom'] :  "" ?></span>
    </div>
    <div class=" mb-2">
        <label for="cne" class="form-label">CNE</label>
        <input type="text" class="form-control" id="cne" name="cne" value="<?php echo isset($data['cne']) ?  $data['cne'] : $etudiant['cne'] ?>" required>
        <span class=" error text-danger"><?php echo isset($errors['empty_cne']) ?  $errors['empty_cne'] :  "" ?></span>
    </div>
    <div class=" mb-2">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($data['email']) ? $data['email'] : $etudiant['email_institutionnel'] ?>" required>
        <span class=" error text-danger">
            <?php echo isset($errors['empty_email']) ? $errors['empty_email'] : (isset($errors['invalid_email']) ? $errors['invalid_email'] : "") ?></span>
    </div>
    <span class=" error text-danger"><?php echo isset($errors['empty_filiere']) ?  $errors['empty_filiere'] :  "" ?></span>

    <button type="submit" class="my-4 btn btn-primary">Modifier</button>
</form>

<?php
unset($_SESSION['data_etud']);
?>