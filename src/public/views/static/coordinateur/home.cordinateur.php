<?php
session_start();
include_once "../../../../app/controllers/coordinateurController.php";

use src\app\controllers\coordinateurController;

$user = new coordinateurController;
$cin_cord = isset($_SESSION['cin_cord']) ? $_SESSION['cin_cord'] : "";
$departement = $user->getDepartement($cin_cord);
$filiers = $user->getfiliere($cin_cord);
?>
<?php include_once "./masterPage.php"  ?>
<main class="content">
    <div class="card w-50" style="background-color: #183258;border-radius: 10px;">
        <div class="card-body">
            <h4>
                <span class="font-italic text-white mx-2">Département : </span>
                <strong class="text-white"> <?php echo isset($departement["nom_dep"]) ? $departement["nom_dep"] : "" ?>
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
                                <h5 class="card-title text-dark"><?php echo $filiere['nom_filiere']; ?></h5>
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