<?php
session_start();
include_once "../../../../app/controllers/coordinateurController.php";
include_once "../../../../app/controllers/chefDepartementController.php";

use src\app\controllers\chefDepartementController;
use src\app\controllers\coordinateurController;

$user = new chefDepartementController;
$cord = new coordinateurController;
$cin_cord = isset($_SESSION['cin_cord']) ? $_SESSION['cin_cord'] : "";
$departement = $cord->getDepartement($cin_cord);
$filiers = $cord->getfiliere($cin_cord);
$profsDepartement = $user->getProfsSelonDepartement($departement['id_departement']);
?>
<?php include_once "./masterPage.php"  ?>
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
    <div class="row mt-5">
        <div class="col-md-6">
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <th class="bg-warning" col">Emploi du Professeur</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($profsDepartement  as $prof) : ?>
                            <td class="bg-primary text-white text-center">
                                <?= $prof['nom']  ?>
                                <?= $prof['prenom']  ?>
                            </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="bg-warning" scope="col">Emploi du Filière</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($filiers as $f) : ?>
                            <td class="bg-primary text-center ">
                                <h4 class="text-white mb-2"><?= $f['nom_filiere'] ?></h4>
                                <div class="d-flex justify-content-around">
                                    <a href="emploiFiliere.php?filiere=<?= $f['nom_filiere'] ?>&semestre=1" class="btn btn-outline-light">S1</a>
                                    <a href="emploiFiliere.php?filiere=<?= $f['nom_filiere'] ?>&semestre=2" class="btn btn-outline-light">S2</a>
                                </div>
                            </td>
        </div>
        </tr>
    <?php endforeach ?>
    </tbody>
    </table>
    </div>
    </div>
</main>
</div>
</div>
<script src="../../../utilities/dashboard/static/js/app.js"></script>
</body>

</html>