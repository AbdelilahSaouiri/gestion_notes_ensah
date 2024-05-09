<?php
session_start();
include_once "../../../../app/controllers/professeurController.php";

use src\app\controllers\professeurController;

$user = new professeurController;
$cin_prof = isset($_SESSION['cin']) ? $_SESSION['cin'] : "";
$departement = $user->getDepartementByCinProf($cin_prof);
$filiers = $user->getFilieresForProfesseur($cin_prof);
?>

<?php include_once "./masterPage.php"; ?>

<main class="content">
    <div class="card w-50">
        <div class="card-body">
            <h4>
                <span class="font-italic">Département: </span>
                <strong class="text-primary"> <?php echo isset($departement["nom_dep"]) ? $departement["nom_dep"] : "" ?>
                </strong>
            </h4>
        </div>
    </div>
    <div class="row">
        <?php foreach ($filiers as $filiere) : ?>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title"><?php echo $filiere['nom_filiere']; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</div>
</div>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>